<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\PelayananModel;
use App\Models\PendaftaranModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Session;

class RekamMedisController extends BaseController
{


    protected $pendaftaran;
    protected $user;
    protected $pasien;

    protected $pelayanan;
    protected $obats;



    public function __construct()
    {
        $this->pendaftaran = new PendaftaranModel();
        $this->pasien = new PasienModel();
        $this->user = new UserModel();
        $this->pelayanan = new PelayananModel();
        $this->obats = new ObatModel();
    }



    public function index()
    {
        //
        $pasiens = $this->pendaftaran
            ->select('pendaftaran.*, pasien.*, users.username')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('users', 'users.id = pendaftaran.user_id')
            ->findAll();
        $header['title'] = 'Rekam-medic';
        $data['pasiens'] = $pasiens;
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/index', $data);
    }


    public function pelayanan($id)
    {


        $pasien = $this->pasien->where('nomor_rm', $id)->first();


        $pelayanan = $this->pelayanan
            ->select('pelayanan.*, pasien.*, petugas.nama_lengkap as nama_petugas, dokter.nama_lengkap as nama_dokter')
            ->join('pasien', 'pasien.id = pelayanan.pasien_id')
            ->join('users as petugas', 'petugas.id = pelayanan.petugas_id')
            ->join('users as dokter', 'dokter.id = pelayanan.dokter_id')
            ->where('pelayanan.pasien_id', $pasien['id'])
            ->findAll();

        $header['title'] = 'Rekam-medic';
        $data['pasien'] = $pasien;
        $data['pelayanan'] = $pelayanan;

        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/pelayanan', $data);
    }


    public function pelayanan_create($id)
    {

        $pasien = $this->pasien->where('nomor_rm', $id)->first();
        $dokters = $this->user->where('role', 'dokter')->findAll();
        $header['title'] = 'Rekam-medic';
        $data['pasien'] = $pasien;
        $data['dokters'] = $dokters;

        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/create_pelayanan', $data);
    }


    public function pelayanan_store($id)
    {


        $sesion = new Session();


        $pasien = $this->pasien->where('nomor_rm', $id)->first();

        // Get POST data
        $data = [
            'tgl_pelayanan' => $this->request->getPost('tgl_pelayanan'),
            'dokter_id' => $this->request->getPost('dokter_id'),
            'petugas_id' => session()->get('user_id'),
            'pasien_id' => $pasien['id']
        ];

        // Validate the data
        if (!$this->validate([
            'tgl_pelayanan' => 'required|valid_date',
            'dokter_id' => 'required|integer',
        ])) {
            // If validation fails, return back with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Insert data into database
        $idPelayanan = $this->pelayanan->insert($data, true);

        return redirect()->to(base_url('/rekam-medis/anamnesa/' . $id . '/' . $idPelayanan))->with('message', 'Pelayanan data stored successfully!');
    }


    public function anamnesa_create($segment1, $segment2)
    {
        $pasien = $this->pasien->where('nomor_rm', $segment1)->first();
        $dokters = $this->user->where('role', 'dokter')->findAll();
        $obats = $this->obats->findAll();
        $header['title'] = 'Rekam-medic';
        $data['pasien'] = $pasien;
        $data['dokters'] = $dokters;
        $data['obats'] = $obats;

        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/create_anamnesa', $data);
    }
}
