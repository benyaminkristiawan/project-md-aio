<?php

namespace App\Models;

use CodeIgniter\Model;

class SellInDetailModel extends Model
{
    protected $table = 'program_sellin_details';
    protected $allowedFields = [
        'program_sellin_id',
        'no_sj',
        'product_id',
        'quantity',
        'unit_price',
        'harga_dpp',
        'harga_dasar',
        'reward',
        'total_reward'
    ];
}
