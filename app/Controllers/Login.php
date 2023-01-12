<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $loginModel;
    public function __construct(){
        $this->loginModel = new UserModel();
    }

    //fungsi untuk menampilkan view login
    public function index()
    {
        $data = [
            'title' => 'Login | MS'
        ];

        return view('auth/login', $data);
    }

    //fungsi untuk cek saat login
    public function checkLogin(){
        $username = $this->request->getPost('username');
        $password = sha1($this->request->getPost('password'));

        $row = $this->loginModel->check($username, $password);//mengambil parameter method check di UserModel

        if (isset($row['username'], $row['password'])) {
            if (($row['username'] == $username) && ($row['password'] == $password)) {
                if(($row['status'] == "Aktif") && ($row['level'] == "1")) {
                    session()->set('username', $row['username']);
                    session()->set('namaUser', $row['namaUser']);
                    session()->set('jabatan', $row['jabatan']);
                    session()->set('level', $row['level']);
                    session()->setFlashdata('berhasil', 'Selamat Anda Telah Login');
                    return redirect()->to(base_url('admin'));
                } else 
                if (($row['status'] == "Aktif") && ($row['level'] == "2")) {
                    session()->set('username', $row['username']);
                    session()->set('namaUser', $row['namaUser']);
                    session()->set('jabatan', $row['jabatan']);
                    session()->set('level', $row['level']);
                    session()->setFlashdata('berhasil', 'Selamat Anda Berhasil Login');
                    return redirect()->to(base_url('kepsek'));
                } else 
                if (($row['status'] == "Aktif") && ($row['level'] == "3")) {
                    session()->set('username', $row['username']);
                    session()->set('namaUser', $row['namaUser']);
                    session()->set('jabatan', $row['jabatan']);
                    session()->set('level', $row['level']);
                    session()->setFlashdata('berhasil', 'Selamat Anda Berhasil Login');
                    return redirect()->to(base_url('guru'));
                } else {
                    session()->setFlashdata('tidakAktif', 'Akun anda belum aktif');
                    return redirect()->to(base_url('login'))->withInput();
                }
            }
        } else {
            session()->setFlashdata('gagal', 'Username atau Password salah !');
            return redirect()->to(base_url('login'))->withInput();
        }
    }

    //fungsi untuk logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
