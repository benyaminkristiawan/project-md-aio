<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramProductModel extends Model
{
    protected $table = 'program_products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'program_id',
        'product_name',
        'reward_value',
        'max_qty_claim',
        'moq'
    ];
    protected $useTimestamps = true;

    public function getProgram($programId)
    {
        return $this->db->table('programs')
            ->where('id', $programId)
            ->get()
            ->getRowArray();
    }
}
