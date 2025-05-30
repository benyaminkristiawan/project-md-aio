<?php

namespace App\Models;

use CodeIgniter\Model;

class RewardModel extends Model
{
    protected $table = 'rewards';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenis_reward'];
    protected $useTimestamps = true;

    public function getPrograms($rewardId)
    {
        return $this->db->table('programs')
            ->where('reward_id', $rewardId)
            ->get()
            ->getResultArray();
    }
    public function getRewardByProgramId($programId)
    {
        return $this->db->table('programs')
            ->select('rewards.jenis_reward')
            ->join('rewards', 'rewards.id = programs.reward_id')
            ->where('programs.id', $programId)
            ->get()
            ->getRowArray();
    }
}
