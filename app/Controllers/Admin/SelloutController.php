<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SelloutModel;
use App\Models\MarketplaceModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CampaignModel;

class SelloutController extends BaseController
{
    public function index()
    {
        $selloutModel = new SelloutModel();
        $data['sellouts'] = $selloutModel
            ->select('sellout.*, marketplaces.location AS marketplace_name, brands.name AS brand_name, categories.name AS category_name, jenis_campaign.nama_campaign AS campaign_name')
            ->join('marketplaces', 'sellout.marketplace_id = marketplaces.id')
            ->join('brands', 'sellout.brand_id = brands.id')
            ->join('categories', 'sellout.category_id = categories.id')
            ->join('jenis_campaign', 'sellout.campaign_id = jenis_campaign.id')
            ->findAll();

        $data['marketplaces'] = (new MarketplaceModel())->findAll();
        $data['brands'] = (new BrandModel())->findAll();
        $data['categories'] = (new CategoryModel())->findAll();
        $data['jenis_campaign'] = (new CampaignModel())->findAll();

        return view('sellout/sellout', $data);
    }

    public function save()
    {
        $selloutModel = new SelloutModel();
        $data = [
            'marketplace_id' => $this->request->getPost('marketplace_id'),
            'brand_id'       => $this->request->getPost('brand_id'),
            'category_id'    => $this->request->getPost('category_id'),
            'campaign_id'    => $this->request->getPost('campaign_id'),
            'qty_terjual'    => $this->request->getPost('qty_terjual'),
            'nominal_support' => $this->request->getPost('nominal_support'),
        ];
        $selloutModel->insert($data);

        return redirect()->to('admin/sellout')->with('success', 'Sellout berhasil ditambahkan.');
    }

    public function update($id)
    {
        $selloutModel = new SelloutModel();
        $data = [
            'marketplace_id' => $this->request->getPost('marketplace_id'),
            'brand_id'       => $this->request->getPost('brand_id'),
            'category_id'    => $this->request->getPost('category_id'),
            'campaign_id'    => $this->request->getPost('campaign_id'),
            'qty_terjual'    => $this->request->getPost('qty_terjual'),
            'nominal_support' => $this->request->getPost('nominal_support'),
        ];
        $selloutModel->update($id, $data);

        return redirect()->to('admin/sellout')->with('success', 'Sellout berhasil diperbarui.');
    }

    public function delete($id)
    {
        (new SelloutModel())->delete($id);
        return redirect()->to('admin/sellout')->with('success', 'Sellout berhasil dihapus.');
    }
}
