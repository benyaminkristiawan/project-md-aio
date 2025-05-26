<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketplaceModel extends Model
{
    protected $table = 'marketplaces';
    protected $primaryKey = 'id';
    protected $allowedFields = ['location', 'phone'];
    public function getProgramMarketplaces($programId)
    {
        return $this->db->table('program_marketplaces')
            ->where('program_id', $programId)
            ->join('marketplaces', 'marketplaces.id = program_marketplaces.marketplace_id')
            ->get()
            ->getResultArray();
    }
}
