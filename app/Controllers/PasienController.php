<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PasienModel;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Fpdf\Fpdf;

class PasienController extends BaseController
{
    protected $pasien;

    public function __construct()
    {
        $this->pasien = new PasienModel();
    }

    public function index()
    {
        $pasiens = $this->pasien->findAll();
        $data['pasiens'] = $pasiens;
        $header['title'] = 'Daftar Pasien';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('pasien/index', $data);
    }

    public function create()
    {
        $header['title'] = 'Tambah Pasien';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('pasien/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            // 'nomor_rm' => 'required',
            'nama_lengkap' => 'required',
            // Add other validation rules as necessary
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = $this->request->getPost();

        $this->pasien->insert($data);

        return redirect()->to('/pasien')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pasien = $this->pasien->find($id);
        if (!$pasien) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pasien dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data['pasien'] = $pasien;
        $header['title'] = 'Edit Pasien';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('pasien/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nomor_rm' => 'required',
            'nama_lengkap' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = $this->request->getPost();
        $this->pasien->update($id, $data);

        return redirect()->to('/pasien')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function delete($id)
    {
        if ($this->pasien->delete($id)) {
            return redirect()->to('/pasien')->with('success', 'Pasien berhasil dihapus.');
        } else {
            return redirect()->back()->with('errors', ['Pasien gagal dihapus.']);
        }
    }


    public function generatePdf($id)
    {
    }
}
