<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brands';
    protected $allowedFields = ['code', 'name'];

    public function getBrandNameByProgramId($programId)
    {
        return $this->db->table('programs')
            ->select('brands.name AS brand_name')
            ->join('brands', 'brands.id = programs.brand_id')
            ->where('programs.id', $programId)
            ->get()
            ->getRowArray();
    }
}
