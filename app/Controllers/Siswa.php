<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Siswa extends BaseController
{
    public function index()
    {
        return view('siswa/create');
    }
    public function pcreate(){
        return view('admin/siswa/create');
    }
}
