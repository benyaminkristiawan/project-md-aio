<?php
// File: app/Models/ProgramSelloutModel.php
namespace App\Models;

use CodeIgniter\Model;

class ProgramSelloutModel extends Model
{
    protected $table = 'program_sellout';
    protected $primaryKey = 'id';
    protected $allowedFields = ['program_name', 'start_date', 'end_date', 'reward_id', 'reward_amount', 'moq', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}
