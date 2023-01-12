<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;

class Guru extends BaseController
{
    protected $guruModel;
    public function __construct(){
        $this->guruModel = new GuruModel();
    }

    public function index()
    {
        $guru = $this->guruModel->findAll();
        $data = [
            'title' => 'Data Guru | Admin',
            'guru' => $guru,
            'validation' => \Config\Services::validation(),

        ];

        return view('admin/guru/guru', $data);
    }

    //create Guru
    public function create(){
        if (!$this->validate(
            [
                'namaGuru' => [
                    'rules' => 'required|is_unique[guru.namaGuru]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ]
            ]
        )) {

            return redirect()->to(base_url('guru/create'))->withInput();
        }

        $data = array(

            'idGuru'       => $this->request->getVar('idGuru'),
            'nip'     => $this->request->getVar('nip'),
            'namaGuru'        => $this->request->getVar('namaGuru'),
            'jk'       => $this->request->getVar('jk'),
            'mapel'       => $this->request->getVar('mapel'),
        );

        $this->guruModel->createGuru($data);
        session()->setFlashdata('userSimpan', 'Data Guru Disimpan');
        return redirect()->to(base_url('guru/create'));
    }

    //fungsi untuk menghapus data
    public function delete($idGuru){
        $this->guruModel->delete($idGuru);  
        session()->setFlashdata('userHapus', 'Data Guru Terhapus');
        return redirect()->to(base_url('guru'));
    }

    //menampilkan halaman setelah melakukan update di model
    public function edit()
    {

        $idGuru = $this->request->getPost('idGuru');
        $data = array(
            'nip' => $this->request->getPost('nip'),
            'namaGuru'    => $this->request->getPost('namaGuru'),
            'jk'   => $this->request->getPost('jk'),
            'mapel'   => $this->request->getPost('mapel'),

        );
        $this->guruModel->update($data, $idGuru);
        session()->setFlashdata('userEdit', 'Data guru berhasil diubah');
        return redirect()->to(base_url('guru'));
    }
}
