<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Admin extends BaseController
{

    protected $userModel;
    public function __construct(){
         $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session('level') != '1') {
            session()->setFlashdata('belum', "Anda Belum Login");
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Dashboard | MS',
            'active' => 'admin'
        ];

        return view('admin/index', $data);
    }
}
