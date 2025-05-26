<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesTeamModel extends Model
{
    protected $table = 'sales_team';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sales_team'];
    protected $useTimestamps = true;

    public function getProgramSalesTeams($programId)
    {
        return $this->db->table('program_sales_teams')
            ->where('program_id', $programId)
            ->join('sales_team', 'sales_team.id = program_sales_teams.sales_team_id')
            ->get()
            ->getResultArray();
    }
}
