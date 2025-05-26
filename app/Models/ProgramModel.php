<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'programs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'start_date',
        'end_date',
        'reward_id',
        'brand_id'
    ];
    protected $useTimestamps = true;

    public function getBrand()
    {
        return $this->db->table('brands')
            ->where('id', $this->brand_id)
            ->get()
            ->getRowArray();
    }

    public function getReward()
    {
        return $this->db->table('rewards')
            ->where('id', $this->reward_id)
            ->get()
            ->getRowArray();
    }

    public function getMarketplaces()
    {
        return $this->db->table('program_marketplaces')
            ->where('program_id', $this->id)
            ->join('marketplaces', 'marketplaces.id = program_marketplaces.marketplace_id')
            ->get()
            ->getResultArray();
    }

    public function getSalesTeams()
    {
        return $this->db->table('program_sales_teams')
            ->where('program_id', $this->id)
            ->join('sales_team', 'sales_team.id = program_sales_teams.sales_team_id')
            ->get()
            ->getResultArray();
    }

    public function getProducts()
    {
        return $this->db->table('program_products')
            ->where('program_id', $this->id)
            ->get()
            ->getResultArray();
    }
}
