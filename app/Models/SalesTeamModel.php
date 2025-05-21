<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesTeamModel extends Model
{
    protected $table            = 'sales_team';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['sales_team'];
    protected $useTimestamps    = true;
}
