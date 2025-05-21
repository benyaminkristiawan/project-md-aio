<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketplaceModel extends Model
{
    protected $table = 'marketplaces';
    protected $primaryKey = 'id';
    protected $allowedFields = ['location', 'phone'];
}
