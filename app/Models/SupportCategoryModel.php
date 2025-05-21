<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportCategoryModel extends Model
{
    protected $table      = 'support_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['campaign_type', 'description', 'explanation'];

    // Jika perlu, tambahkan fungsi query khusus di sini
}
