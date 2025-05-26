<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramMarketplaces extends Model
{
    protected $table      = 'program_marketplaces';  // Nama tabel
    protected $primaryKey = 'id';                     // Primary key tabel

    protected $useTimestamps = true;                  // Otomatis kelola created_at dan updated_at
    protected $createdField  = 'created_at';          // Nama kolom created_at
    protected $updatedField  = '';                      // Jika tidak ada updated_at, bisa dikosongkan

    protected $allowedFields = [
        'program_id',
        'marketplace_id',
        'created_at', // opsional, biasanya diisi otomatis oleh CI jika useTimestamps true
    ];
    public function getMarketplacesByProgramId(int $programId)
    {
        return $this->select('marketplaces.location as marketplace_name')
            ->join('marketplaces', 'marketplaces.id = program_marketplaces.marketplace_id')
            ->where('program_marketplaces.program_id', $programId)
            ->findAll();
    }
}
