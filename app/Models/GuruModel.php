<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'guru';
    protected $primaryKey       = 'idGuru';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["nip", "namaGuru", "jk", "mapel"];

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


    //query untuk mengeksekusi create data
    public function createGuru($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function getGuru($idGuru = false){
        if($idBuku === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['idGuru' => $idGuru]);
        }
    }

    //query untuk merubah data
    public function updateGuru($data, $idGuru){
        $query = $this->db->table($this->table)->update($data, array('idGuru' => $idGuru));
        return $query;
    }

    public function countGuru(){
        $builder = $this->db->table('guru');
        $query = $builder->countAllResults();
        return $query;
    }
}
