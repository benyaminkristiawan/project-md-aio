<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\CampaignTypeModel;
use App\Models\BranchModel;
use App\Models\CampaignModel;
use App\Models\CategoryModel;
use App\Models\MarketplaceModel;
use App\Models\ProductModel;
use App\Models\SellInProgramModel;
use App\Models\SellInDetailModel;
use App\Models\SubcategoryModel;
use App\Models\SupportCategoryModel;

class SellinController extends BaseController
{
    public function index()
    {
        $data = [
            'brands' => (new BrandModel())->findAll(),
            'campaign_types' => (new CampaignModel())->findAll(),
            'branches' => (new MarketplaceModel())->findAll(),
            'categories' => (new CategoryModel())->findAll(),
            'support_categories' => (new SupportCategoryModel())->findAll(),
            'subcategories' => (new SubcategoryModel())->findAll(),

        ];

        return view('sellin/sellin', $data);
    }

    public function create()
    {
        $model = new SellInProgramModel();
        $id = $model->insert([
            'campaign_name'       => $this->request->getPost('campaign_name'),
            'brand_id'            => $this->request->getPost('brand_id'),
            'jenis_campaign_id'   => $this->request->getPost('jenis_campaign_id'),
            'branch_id'           => $this->request->getPost('branch_id'),
            'ppn'                 => $this->request->getPost('ppn'),
            'pph'                 => $this->request->getPost('pph'),
            'category_id'         => $this->request->getPost('category_id'),
            'support_category_id' => $this->request->getPost('support_category_id'),
            'subcategory_id'      => $this->request->getPost('subcategory_id'),
            'start_date'          => $this->request->getPost('start_date'),
            'end_date'            => $this->request->getPost('end_date'),
        ]);

        return redirect()->to('admin/sellin')->with('program_id', $id);
    }

    public function addDetail()
    {
        $model = new SellInDetailModel();
        $programId = $this->request->getPost('program_id');
        $qty = $this->request->getPost('quantity');
        $reward = $this->request->getPost('reward');

        $model->insert([
            'program_sellin_id' => $programId,
            'no_sj'             => $this->request->getPost('no_sj'),
            'product_id'        => $this->request->getPost('product_id'),
            'quantity'          => $qty,
            'unit_price'        => $this->request->getPost('unit_price'),
            'harga_dpp'         => $this->request->getPost('harga_dpp'),
            'harga_dasar'       => $this->request->getPost('harga_dasar'),
            'reward'            => $reward,
            'total_reward'      => $qty * $reward,
        ]);

        return redirect()->to('admin/sellin');
    }

    public function deleteDetail($id)
    {
        (new SellInDetailModel())->delete($id);
        return redirect()->to('admin/sellin');
    }

    public function submit()
    {
        // bisa update status, simpan final, atau trigger cetak surat
        return redirect()->to('admin/sellin')->with('success', 'Program telah disimpan.');
    }
}
