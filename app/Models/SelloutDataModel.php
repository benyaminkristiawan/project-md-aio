<?php

namespace App\Models;

use CodeIgniter\Model;

class SelloutDataModel extends Model
{
    protected $table = 'sellout_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['program_id', 'date', 'brand_id', 'type', 'quantity', 'branch_id', 'sales_team_id', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}
