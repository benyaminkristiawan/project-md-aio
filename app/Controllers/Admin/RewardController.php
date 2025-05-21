<?php

namespace App\Controllers\Admin;

use App\Models\RewardModel;
use App\Controllers\BaseController;

class RewardController extends BaseController
{
    public function index()
    {
        $rewardModel = new RewardModel();
        // Ambil semua data dari tabel reward
        $data['rewards'] = $rewardModel->findAll();

        return view('reward/reward', $data);
    }

    public function saveReward()
    {
        $rewardModel = new RewardModel();

        $data = [
            'jenis_reward' => $this->request->getPost('jenis_reward'),
        ];

        // Validasi input
        if (empty($data['jenis_reward'])) {
            return redirect()->back()->with('error', 'Jenis reward harus diisi.');
        }

        if (!$rewardModel->save($data)) {
            return redirect()->back()->with('error', 'Gagal menambahkan reward.');
        }

        return redirect()->to('/admin/reward')->with('success', 'Reward berhasil ditambahkan.');
    }

    public function deleteReward($id)
    {
        $rewardModel = new RewardModel();

        if (!$rewardModel->find($id)) {
            return redirect()->to('/admin/reward')->with('error', 'Reward tidak ditemukan.');
        }

        $rewardModel->delete($id);

        return redirect()->to('/admin/reward')->with('success', 'Reward berhasil dihapus.');
    }
}
