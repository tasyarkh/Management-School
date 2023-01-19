<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'idUser';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["namaUser", "username", "password", "level", "jabatan", "status"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    //method cek untuk proses login
    public function check($username, $password){
        return $this->db->table('user')->where(
            array(
                'username' => $username,
                'password' => $password,
            )
        )
        ->get()->getRowArray();
    }

    //method untuk create user/regist
    public function createUser($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function countUser(){
        $builder = $this->db->table('user');
        $query = $builder->countAllResults();
        return $query;
    }
}
