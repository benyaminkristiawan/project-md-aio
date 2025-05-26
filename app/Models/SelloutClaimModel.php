<?php

namespace App\Models;

use CodeIgniter\Model;

class SelloutClaimModel extends Model
{
    protected $table = 'sellout_claims';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'program_id',
        'transaction_date',
        'brand_id',
        'product_name',
        'quantity',
        'marketplace_id',
        'sales_team_id',
        'claim_value'
    ];
    protected $useTimestamps = true;

    public function getReportData($programId)
    {
        return $this->select('product_name, SUM(quantity) as total_quantity, claim_value, SUM(quantity * claim_value) as total_claim')
            ->where('program_id', $programId)
            ->groupBy('product_name, claim_value')
            ->findAll();
    }
}
