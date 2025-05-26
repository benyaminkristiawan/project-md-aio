<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SelloutClaimModel;
use App\Models\ProgramModel;
use App\Models\ProgramProductModel;
use App\Models\ProgramMarketplaceModel;
use App\Models\ProgramSalesTeamModel;
use App\Models\BrandModel;
use App\Models\RewardModel;
use App\Models\MarketplaceModel;
use App\Models\SalesTeamModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Config\Database;

class SelloutClaimController extends BaseController
{
    protected $helpers = ['form'];
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function import($programId)
    {
        $program = (new ProgramModel())->find($programId);

        if (!$program) {
            return redirect()->to(route_to('admin.programs'))
                ->with('error', 'Program tidak ditemukan');
        }

        // Ambil data relasi
        $marketplaces = (new \App\Models\ProgramMarketplaces())
            ->getMarketplacesByProgramId($programId);

        $salesTeams = (new \App\Models\ProgramSalesTeams())
            ->getSalesTeamsByProgramId($programId);

        // $brands = (new BrandModel())
        //     ->where('program_id', $programId) // Sesuaikan dengan struktur tabel brand
        //     ->findAll();

        // $rewards = (new RewardModel())
        //     ->where('program_id', $programId) // Sesuaikan dengan struktur tabel reward
        //     ->findAll();

        $data = [
            'program'      => $program,
            'products'     => (new ProgramProductModel())->where('program_id', $programId)->findAll(),
            'marketplaces' => $marketplaces,
            'salesTeams'   => $salesTeams,
            'brands'       => $brands,
            'rewards'      => $rewards
        ];


        return view('admin/sellout/import', $data);
    }

    public function processImport($programId)
    {
        $validation = $this->validate([
            'sellout_file' => 'uploaded[sellout_file]|ext_in[sellout_file,xlsx,xls]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->db->transStart();

        try {
            $program = (new ProgramModel())->find($programId);
            $file = $this->request->getFile('sellout_file');

            $spreadsheet = IOFactory::load($file->getTempName());
            $rows = $spreadsheet->getActiveSheet()->toArray();

            $selloutModel = new SelloutClaimModel();
            $importedData = [];

            foreach ($rows as $index => $row) {
                if ($index === 0) continue; // Skip header

                // Validasi row
                $validatedRow = $this->validateRow($programId, $row);

                // Simpan data
                $selloutModel->insert([
                    'program_id' => $programId,
                    'transaction_date' => $validatedRow['date'],
                    'brand_id' => $program->brand_id,
                    'product_name' => $validatedRow['product'],
                    'quantity' => $validatedRow['quantity'],
                    'marketplace_id' => $validatedRow['marketplace_id'],
                    'sales_team_id' => $validatedRow['sales_team_id'],
                    'claim_value' => $validatedRow['claim_value']
                ]);

                $importedData[] = $validatedRow;
            }

            $this->db->transComplete();

            return redirect()->to(route_to('admin.sellout.report', $programId))
                ->with('success', 'Data berhasil diimport')
                ->with('importedData', $importedData);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function validateRow($programId, $row)
    {
        // Validasi Marketplace
        $marketplace = (new MarketplaceModel())->where('name', $row[4])->first();
        if (!$marketplace) {
            throw new \Exception("Marketplace {$row[4]} tidak valid");
        }

        // Validasi Sales Team
        $salesTeam = (new SalesTeamModel())->where('sales_team', $row[5])->first();
        if (!$salesTeam) {
            throw new \Exception("Sales Team {$row[5]} tidak valid");
        }

        // Validasi Produk
        $product = (new ProgramProductModel())
            ->where('program_id', $programId)
            ->where('product_name', $row[2])
            ->first();

        if (!$product) {
            throw new \Exception("Produk {$row[2]} tidak terdaftar dalam program ini");
        }

        return [
            'date' => $row[0],
            'product' => $row[2],
            'quantity' => $row[3],
            'marketplace_id' => $marketplace->id,
            'sales_team_id' => $salesTeam->id,
            'claim_value' => $product->reward_value
        ];
    }

    public function report($programId)
    {
        $program = (new ProgramModel())->find($programId);
        $claims = (new SelloutClaimModel())
            ->select('product_name, SUM(quantity) as total_quantity, claim_value, SUM(quantity * claim_value) as total_claim')
            ->where('program_id', $programId)
            ->groupBy('product_name, claim_value')
            ->findAll();

        $data = [
            'program' => $program,
            'claims' => $claims
        ];

        return view('admin/sellout/report', $data);
    }
}
