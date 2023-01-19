<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;
    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $user = $this->userModel->countUser();
        $data = [
            'user' => $user
        ];
        return view('admin/user/ctusr', $data);
    }

    public function create(){
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ]
            ]
        )) {
            return redirect()->to(base_ur('login'))->withInput();
        }

        $data = array(
            'idUser' => $this->request->getVar('idUser'),
            'namaUser' => $this->request->getVar('namaUser'),
            'username' => $this->request->getVar('username'),
            'password' => sha1($this->request->getVar('password')),
            'status' => "Aktif",
        );

        $this->userModel->createUser($data);
        session()->setFlashdata('userSimpan', 'Data Berhasil Disimpan, Silahkan Login Kembali !');
        return redirect()->to(base_url('admin'));
    }
}
