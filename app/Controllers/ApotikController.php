<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelayananModel;
use CodeIgniter\HTTP\ResponseInterface;

class ApotikController extends BaseController
{


    protected $pelayanan;

    public function __construct()
    {
        $this->pelayanan = new PelayananModel();
    }

    public function index()
    {
        //

        $pelayanan = $this->pelayanan
            ->select('pelayanan.*, pasien.*, petugas.nama_lengkap as nama_petugas, dokter.nama_lengkap as nama_dokter , pendaftaran.jenis_pasien')
            ->join('pasien', 'pasien.id = pelayanan.pasien_id')
            ->join('pendaftaran', 'pendaftaran.pasien_id = pasien.id')
            ->join('users as petugas', 'petugas.id = pelayanan.petugas_id')
            ->join('users as dokter', 'dokter.id = pelayanan.dokter_id')
            ->findAll();

        $header['title'] = 'Rekam-medic';
        $data['pelayanan'] = $pelayanan;
        $header['title'] = 'Apotik';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('apotik', $data);
    }
}
