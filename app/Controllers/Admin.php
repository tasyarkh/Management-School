<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GuruModel;

class Admin extends BaseController
{

    protected $userModel;
    public function __construct(){
         $this->userModel = new UserModel();
         $this->guruModel = new GuruModel();
    }

    public function index()
    {
        if (session('level') != '1') {
            session()->setFlashdata('belum', "Anda Belum Login");
            return redirect()->to(base_url('login'));
        }

        $guru = $this->guruModel->countGuru();
        $user = $this->userModel->countUser();
        $data = [
            'title' => 'Dashboard | MS',
            'active' => 'admin',
            'guru' => $guru,
            'user' => $user
        ];

        return view('admin/index', $data);
    }
}
