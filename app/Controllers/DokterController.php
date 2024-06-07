<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DokterController extends BaseController
{
    public function index()
    {
        //

        $user = new UserModel();
        $users = $user->getUsersByRole('dokter');
        $data['users'] = $users;
        $header['title'] = 'Dashboard';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('dokter/index', $data);
    }
}
