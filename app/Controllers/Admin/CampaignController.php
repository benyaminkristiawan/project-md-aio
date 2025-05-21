<?php

namespace App\Controllers\Admin;

use App\Models\CampaignModel;
use App\Controllers\BaseController;

class CampaignController extends BaseController
{
    public function index()
    {
        $campaignModel = new CampaignModel();
        $data['campaigns'] = $campaignModel->findAll();

        return view('campaign/campaign', $data);
    }

    public function saveCampaign()
    {
        $campaignModel = new CampaignModel();

        $data = [
            'nama_campaign' => $this->request->getPost('nama_campaign'), // Menggunakan nama_campaign saja
        ];

        // Validasi input (jika diperlukan)
        if (empty($data['nama_campaign'])) {
            return redirect()->back()->with('error', 'Nama campaign harus diisi.');
        }

        if (!$campaignModel->save($data)) {
            return redirect()->back()->with('error', 'Gagal menambahkan campaign.');
        }

        return redirect()->to('/campaign')->with('success', 'Campaign berhasil ditambahkan.');
    }

    public function updateCampaign($id)
    {
        $campaignModel = new CampaignModel();

        $data = [
            'nama_campaign' => $this->request->getPost('nama_campaign'), // Menggunakan nama_campaign saja
        ];

        // Validasi input (jika diperlukan)
        if (empty($data['nama_campaign'])) {
            return redirect()->back()->with('error', 'Nama campaign harus diisi.');
        }

        if (!$campaignModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Gagal memperbarui campaign.');
        }

        return redirect()->to('/campaign')->with('success', 'Campaign berhasil diperbarui.');
    }

    public function deleteCampaign($id)
    {
        $campaignModel = new CampaignModel();

        if (!$campaignModel->find($id)) {
            return redirect()->to('/campaign')->with('error', 'Campaign tidak ditemukan.');
        }

        $campaignModel->delete($id);

        return redirect()->to('/campaign')->with('success', 'Campaign berhasil dihapus.');
    }
}
