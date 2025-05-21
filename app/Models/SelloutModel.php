<?php

namespace App\Models;

use CodeIgniter\Model;

class SelloutModel extends Model
{
    protected $table = 'sellout';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'marketplace_id',
        'brand_id',
        'category_id',
        'campaign_id',
        'qty_terjual',
        'nominal_support',
    ];
}
