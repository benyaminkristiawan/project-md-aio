<?php

namespace App\Models;

use CodeIgniter\Model;

class SellInProgramModel extends Model
{
    protected $table = 'program_sellin';
    protected $allowedFields = [
        'campaign_name',
        'brand_id',
        'jenis_campaign_id',
        'branch_id',
        'ppn',
        'pph',
        'category_id',
        'support_category_id',
        'subcategory_id',
        'start_date',
        'end_date'
    ];
}
