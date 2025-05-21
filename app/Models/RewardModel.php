<?php

namespace App\Models;

use CodeIgniter\Model;

class RewardModel extends Model
{
    protected $table      = 'rewards';
    protected $primaryKey = 'id';

    protected $allowedFields = ['jenis_reward']; // Kolom yang bisa diisi

    // Jika diperlukan, kita bisa menambahkan validasi atau query lainnya
}
