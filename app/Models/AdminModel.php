<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'administrators';
    protected $primaryKey = 'admin_id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['login', 'password'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected $validationRules = [
        'login'        => 'required',
        'password'     => 'required|max_length[255]|min_length[5]',
    ];

    /**
     * Hashing password method after creatign administrator
     * @param array $data
     * @return array 
     */
    protected function hashPassword(array $data): array
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        unset($data['data']['password']);

        return $data;
    }
}