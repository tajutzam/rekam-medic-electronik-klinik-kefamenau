<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PasienModel;
use App\Models\PendaftaranModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Session;

class PendaftaranController extends BaseController
{


    protected $pendaftaran;
    protected $pasien;



    public function __construct()
    {
        $this->pendaftaran = new PendaftaranModel();
        $this->pasien = new PasienModel();
    }

    public function index()
    {
        //
        $pasiens = $this->pendaftaran
            ->select('pendaftaran.*, pasien.*, users.username')
            ->join('pasien', 'pasien.id = pendaftaran.pasien_id')
            ->join('users', 'users.id = pendaftaran.user_id')
            ->findAll();
        $data['pendaftaran'] = $pasiens;
        $header['title'] = 'Daftar Pasien';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('pendaftaran/index', $data);
    }


    public function create()
    {
        $pasiens = $this->pendaftaran->findAll();

        $header['title'] = 'Daftar Pasien';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('pendaftaran/create_baru');
    }

    public function store()
    {
      
        $session = session();
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nomor_ktp' => 'required|max_length[20]',
            'no_bpjs' => 'max_length[20]',
            'nama_lengkap' => 'required|max_length[100]',
            'tempat_lahir' => 'max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'usia' => 'required',
            'jenis_kelamin' => 'required',
            'jenis_pasien' => 'required|in_list[UMUM,BPJS]',
            'alamat' => 'required|max_length[255]',
            'nomor_hp' => 'required|max_length[20]',
            'agama' => 'max_length[50]',
            'gol_dar' => 'max_length[5]',
            'pekerjaan' => 'max_length[100]',
            'pendidikan' => 'max_length[100]',
            'desa' => 'max_length[100]',
            'kecamatan' => 'max_length[100]',
            'kabupaten' => 'max_length[100]',
            'provinsi' => 'max_length[100]',
            'nama_ibu' => 'max_length[100]',
            'wali_pasien' => 'max_length[100]',
            'no_hp_wali' => 'max_length[20]',
            'riwayat_penyakit' => 'max_length[255]',
            'riwayat_penyakit_keluarga' => 'max_length[255]',
            'riwayat_alergi' => 'max_length[255]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $session->setFlashdata('error', $validation->getErrors()[0]);
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = $this->request->getPost();
        $data['user_id'] = session()->get('user_id');

        $pasienId = $this->pasien->insert($data,  true);

        $data['pasien_id'] = $pasienId;

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'tanggal_pendaftaran' => 'required|valid_date',
            'cara_bayar' => 'required|max_length[11]',
            'jenis_pasien' => 'required|max_length[22]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        if ($this->pendaftaran->save($data)) {
            return redirect()->to('/pendaftaran')->with('success', 'Pendaftaran berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan pendaftaran.');
        }
    }
}
