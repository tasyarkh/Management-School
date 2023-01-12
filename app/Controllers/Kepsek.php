<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kepsek extends BaseController
{
    public function index()
    {
        if (session('level') != '2') {
            session()->setFlashdata('belum', "Anda Belum Login");
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Kepala Sekolah | MS',
            'active' => 'kepsek',
        ];

        return view('kepsek/index', $data);
    }
}
