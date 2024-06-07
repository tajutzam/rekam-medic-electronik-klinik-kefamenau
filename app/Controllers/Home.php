<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;
use App\Models\PasienModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        // content
        $header['title'] = 'Dashboard';

        $userModel = new  UserModel();
        $pasienModel = new  PasienModel();
        $diagnosaModel = new  DiagnosaModel();

        $data['user'] = sizeof($userModel->findAll());
        $data['pasien'] = sizeof($pasienModel->findAll());
        $data['diagnosa'] = sizeof($diagnosaModel->findAll());


        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('dashboard', $data);
    }
}
