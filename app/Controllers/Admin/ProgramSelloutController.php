<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\ProgramSelloutModel;
use App\Models\MarketplaceModel;
use App\Models\SalesTeamModel;
use App\Models\RewardModel;
use App\Models\SelloutDataModel;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProgramSelloutController extends BaseController
{
    public function index()
    {
        $programModel = new ProgramSelloutModel();
        $programs = $programModel->findAll();


        return view('program_sellout/index', ['programs' => $programs]);
    }

    public function create()
    {
        $rewardModel = new RewardModel();
        $brandModel = new BrandModel();
        $marketModel = new MarketplaceModel();
        $salesTeamModel = new SalesTeamModel();

        return view('program_sellout/create', [
            'rewards' => $rewardModel->findAll(),
            'brands' => $brandModel->findAll(),
            'branches' => $marketModel->findAll(),
            'salesTeams' => $salesTeamModel->findAll(),
        ]);
    }

    public function store()
    {
        $programModel = new ProgramSelloutModel();

        $data = [
            'program_name' => $this->request->getPost('program_name'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'reward_id' => $this->request->getPost('reward_id'),
            'reward_amount' => $this->request->getPost('reward_amount'),
            'moq' => $this->request->getPost('moq'),
        ];

        if ($programModel->save($data)) {
            $programId = $programModel->getInsertID();
            return redirect()->to(base_url('admin/program-sellout/detail/' . $programId));
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan program.');
    }

    public function detail($id)
    {
        $programModel = new ProgramSelloutModel();
        $selloutModel = new SelloutDataModel();
        $brandModel = new BrandModel();
        $marketModel = new MarketplaceModel();
        $salesTeamModel = new SalesTeamModel();

        $program = $programModel->find($id);
        $sellouts = $selloutModel->where('program_id', $id)->findAll();
        $brands = $brandModel->findAll();
        $branches = $marketModel->findAll();
        $salesTeams = $salesTeamModel->findAll();

        $totalQty = $selloutModel->where('program_id', $id)->selectSum('quantity')->first()['quantity'] ?? 0;
        $isMoqMet = $totalQty >= $program['moq'];

        return view('program_sellout/detail', [
            'program' => $program,
            'sellouts' => $sellouts,
            'brands' => $brands,
            'branches' => $branches,
            'salesTeams' => $salesTeams,
            'totalQty' => $totalQty,
            'isMoqMet' => $isMoqMet
        ]);
    }

    public function storeSellout($programId)
    {
        $selloutModel = new SelloutDataModel();

        $selloutModel->save([
            'program_id' => $programId,
            'date' => $this->request->getPost('date'),
            'brand_id' => $this->request->getPost('brand_id'),
            'type' => $this->request->getPost('type'),
            'quantity' => $this->request->getPost('quantity'),
            'branch_id' => $this->request->getPost('branch_id'),
            'sales_team_id' => $this->request->getPost('sales_team_id'),
        ]);

        return redirect()->to(base_url('admin/program-sellout/detail/' . $programId));
    }

    public function delete($id)
    {
        $programModel = new ProgramSelloutModel();
        $programModel->delete($id);

        return redirect()->to('/admin/program-sellout');
    }

    public function importExcel($programId)
    {
        $file = $this->request->getFile('excel_file');
        if ($file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            $brandModel = new BrandModel();
            $branchModel = new MarketplaceModel();
            $salesTeamModel = new SalesTeamModel();
            $selloutModel = new SelloutDataModel();

            foreach (array_slice($sheet, 1) as $row) {
                [$date, $brandName, $type, $quantity, $branchName, $salesTeamName] = $row;

                $brand = $brandModel->where('name', $brandName)->first();
                $branch = $branchModel->where('location', $branchName)->first();
                $sales = $salesTeamModel->where('sales_team', $salesTeamName)->first();

                if ($brand && $branch && $sales) {
                    $selloutModel->insert([
                        'program_id' => $programId,
                        'date' => date('Y-m-d', strtotime($date)),
                        'brand_id' => $brand['id'],
                        'type' => $type,
                        'quantity' => $quantity,
                        'branch_id' => $branch['id'],
                        'sales_team_id' => $sales['id'],
                    ]);
                }
            }

            return redirect()->to('/admin/program-sellout/detail/' . $programId)->with('message', 'Import berhasil!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    }

    public function exportExcel($programId)
    {
        $selloutModel = new SelloutDataModel();
        $brandModel = new BrandModel();
        $branchModel = new MarketplaceModel();
        $salesTeamModel = new SalesTeamModel();

        $data = $selloutModel->where('program_id', $programId)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(['Date', 'Brand', 'Type', 'Quantity', 'Branch', 'Sales Team'], NULL, 'A1');

        $rowNum = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $rowNum, $item['date']);
            $sheet->setCellValue('B' . $rowNum, $brandModel->find($item['brand_id'])['name'] ?? '');
            $sheet->setCellValue('C' . $rowNum, $item['type']);
            $sheet->setCellValue('D' . $rowNum, $item['quantity']);
            $sheet->setCellValue('E' . $rowNum, $branchModel->find($item['branch_id'])['location'] ?? '');
            $sheet->setCellValue('F' . $rowNum, $salesTeamModel->find($item['sales_team_id'])['sales_team'] ?? '');
            $rowNum++;
        }

        $filename = 'sellout_program_' . $programId . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
