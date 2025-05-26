<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramSalesTeams extends Model
{
    protected $table      = 'program_sales_teams';  // Nama tabel
    protected $primaryKey = 'id';                    // Primary key

    protected $useTimestamps = true;                 // Otomatis kelola created_at
    protected $createdField  = 'created_at';
    protected $updatedField  = '';                    // Jika tidak ada updated_at

    protected $allowedFields = [
        'program_id',
        'sales_team_id',
        'created_at',
    ];

    /**
     * Ambil daftar sales team (nama) berdasarkan program_id
     *
     * @param int $programId
     * @return array
     */
    public function getSalesTeamsByProgramId(int $programId)
    {
        return $this->select('sales_team.sales_team as sales_team_name')
            ->join('sales_team', 'sales_team.id = program_sales_teams.sales_team_id')
            ->where('program_sales_teams.program_id', $programId)
            ->findAll();
    }
}
