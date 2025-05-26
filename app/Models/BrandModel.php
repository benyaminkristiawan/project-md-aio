<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brands';
    protected $allowedFields = ['code', 'name'];
    public function getPrograms($brandId)
    {
        return $this->db->table('programs')
            ->where('brand_id', $brandId)
            ->get()
            ->getResultArray();
    }
}
