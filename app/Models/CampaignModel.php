<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaignModel extends Model
{
    protected $table = 'jenis_campaign';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_campaign'];
    protected $useTimestamps = false; // Kalau tidak ada created_at / updated_at

    protected $validationRules = [
        'nama_campaign' => 'required|min_length[3]|max_length[50]',
    ];

    protected $validationMessages = [
        'nama_campaign' => [
            'required' => 'Nama campaign wajib diisi.',
            'min_length' => 'Nama campaign minimal 3 karakter.',
            'max_length' => 'Nama campaign maksimal 50 karakter.',
        ],
    ];
}
