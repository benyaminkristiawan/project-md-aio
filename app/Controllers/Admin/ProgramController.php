<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\BrandModel;
use App\Models\RewardModel;
use App\Models\MarketplaceModel;
use App\Models\SalesTeamModel;
use App\Models\ProgramProductModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Config\Database;

class ProgramController extends BaseController
{
    protected $helpers = ['form'];
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect(); // Inisialisasi koneksi DB
    }
    public function index()
    {
        $model = new ProgramModel();
        $programs = $model->orderBy('created_at', 'DESC')->findAll();

        // Load semua relasi
        foreach ($programs as &$program) {
            $program['marketplaces'] = $this->getProgramMarketplaces($program['id']);
            $program['sales_teams'] = $this->getProgramSalesTeams($program['id']);
            $program['brand_name'] = $this->getBrandName($program['brand_id']);
            $program['reward_name'] = $this->getRewardName($program['reward_id']);
        }

        $data = [
            'programs' => $programs,
            'pager' => $model->pager
        ];

        return view('admin/programs/index', $data);
    }

    private function getProgramMarketplaces($programId)
    {
        return $this->db->table('program_marketplaces')
            ->join('marketplaces', 'marketplaces.id = program_marketplaces.marketplace_id')
            ->where('program_id', $programId)
            ->get()
            ->getResultArray();
    }

    private function getProgramSalesTeams($programId)
    {
        return $this->db->table('program_sales_teams')
            ->join('sales_team', 'sales_team.id = program_sales_teams.sales_team_id')
            ->where('program_id', $programId)
            ->get()
            ->getResultArray();
    }

    private function getBrandName($brandId)
    {
        $brand = $this->db->table('brands')
            ->select('name')
            ->where('id', $brandId)
            ->get()
            ->getRowArray();

        return $brand['name'] ?? '-';
    }

    private function getRewardName($rewardId)
    {
        $reward = $this->db->table('rewards')
            ->select('jenis_reward')
            ->where('id', $rewardId)
            ->get()
            ->getRowArray();

        return $reward['jenis_reward'] ?? '-';
    }

    public function create()
    {
        $data = [
            'brands' => (new BrandModel())->findAll(),
            'rewards' => (new RewardModel())->findAll(),
            'marketplaces' => (new MarketplaceModel())->findAll(),
            'salesTeams' => (new SalesTeamModel())->findAll(),
        ];
        return view('admin/programs/create', $data);
    }

    // public function store()
    // {
    //     $validation = $this->validate([
    //         'name' => 'required|max_length[100]',
    //         'brand_id' => 'required|is_not_unique[brands.id]',
    //         'reward_id' => 'required|is_not_unique[rewards.id]',
    //         'start_date' => 'required|valid_date',
    //         'end_date' => 'required|valid_date',
    //         'marketplaces' => 'required',
    //         'sales_teams' => 'required',
    //         'products_file' => 'uploaded[products_file]|ext_in[products_file,xlsx,xls]'
    //     ]);

    //     if (!$validation) {
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     // Simpan program
    //     $programModel = new ProgramModel();
    //     $programId = $programModel->insert([
    //         'name' => $this->request->getPost('name'),
    //         'brand_id' => $this->request->getPost('brand_id'),
    //         'reward_id' => $this->request->getPost('reward_id'),
    //         'start_date' => $this->request->getPost('start_date'),
    //         'end_date' => $this->request->getPost('end_date'),
    //     ]);

    //     // Simpan relasi marketplaces
    //     $this->saveMarketplaces($programId, $this->request->getPost('marketplaces'));

    //     // Simpan relasi sales teams
    //     $this->saveSalesTeams($programId, $this->request->getPost('sales_teams'));

    //     // Import produk
    //     $this->importProducts($programId, $this->request->getFile('products_file'));

    //     return redirect()->to(route_to('admin.sellout.import', $programId))
    //         ->with('success', 'Program created successfully');
    // }

    public function store()
    {
        $validation = $this->validate([
            'name' => 'required|max_length[100]',
            'brand_id' => 'required|is_not_unique[brands.id]',
            'reward_id' => 'required|is_not_unique[rewards.id]',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date|',
            'marketplaces' => 'required',
            'sales_teams' => 'required',
            'products_file' => 'uploaded[products_file]|ext_in[products_file,xlsx,xls]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->db->transStart();

        try {
            $programModel = new ProgramModel();
            $programId = $programModel->insert([
                'name' => $this->request->getPost('name'),
                'brand_id' => $this->request->getPost('brand_id'),
                'reward_id' => $this->request->getPost('reward_id'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
            ]);

            // Save Marketplaces
            $this->saveMarketplaces($programId, $this->request->getPost('marketplaces'));

            // Save Sales Teams
            $this->saveSalesTeams($programId, $this->request->getPost('sales_teams'));

            // Import Products
            $this->importProducts($programId, $this->request->getFile('products_file'));

            $this->db->transComplete();

            return redirect()->to(route_to('admin.sellout.import', $programId))
                ->with('success', 'Program created. Please import sellout data');
        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function saveMarketplaces($programId, $marketplaceIds)
    {
        $data = [];
        foreach ($marketplaceIds as $id) {
            $data[] = [
                'program_id' => $programId,
                'marketplace_id' => $id,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->db->table('program_marketplaces')->insertBatch($data);
    }

    private function saveSalesTeams($programId, $salesTeamIds)
    {
        $data = [];
        foreach ($salesTeamIds as $id) {
            $data[] = [
                'program_id' => $programId,
                'sales_team_id' => $id,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->db->table('program_sales_teams')->insertBatch($data);
    }

    private function importProducts($programId, $file)
    {
        $spreadsheet = IOFactory::load($file->getTempName());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $model = new ProgramProductModel();
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Skip header

            $model->insert([
                'program_id' => $programId,
                'product_name' => $row[0],
                'reward_value' => (float) str_replace(['Rp', '.', ','], '', $row[1]),
                'max_qty_claim' => $row[2] ?: null,
                'moq' => $row[3] ?: null
            ]);
        }
    }

    public function edit($id)
    {
        $model = new ProgramModel();
        $program = $model->find($id);

        $data = [
            'program' => $program,
            'brands' => (new BrandModel())->findAll(),
            'rewards' => (new RewardModel())->findAll(),
            'marketplaces' => (new MarketplaceModel())->findAll(),
            'salesTeams' => (new SalesTeamModel())->findAll(),
            'selectedMarketplaces' => array_column(
                $this->db->table('program_marketplaces')
                    ->where('program_id', $id)
                    ->get()->getResultArray(),
                'marketplace_id'
            ),
            'selectedSalesTeams' => array_column(
                $this->db->table('program_sales_teams')
                    ->where('program_id', $id)
                    ->get()->getResultArray(),
                'sales_team_id'
            )
        ];

        return view('admin/programs/edit', $data);
    }

    public function update($id)
    {
        // Validasi dan update logic similar to store()
        // ... 
    }

    public function delete($id)
    {
        $model = new ProgramModel();
        $model->delete($id);
        return redirect()->to('/admin/programs')->with('success', 'Program deleted');
    }
}
