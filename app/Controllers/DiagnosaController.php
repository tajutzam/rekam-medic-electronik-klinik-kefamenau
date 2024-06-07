<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiagnosaModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class DiagnosaController extends BaseController
{


    protected $diagnosa;

    public function __construct()
    {
        $this->diagnosa = new DiagnosaModel();
    }

    public function index()
    {
        //
        $diagnosas = $this->diagnosa->findAll();
        $data['diagnosas'] = $diagnosas;
        $header['title'] = 'Dashboard';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('diagnosa/index', $data);
    }

    public function store()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_icd' => 'required|is_unique[diagnosa.kode_diagnosa]',
            'diagnosa' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'kode_diagnosa' => $this->request->getPost('kode_icd'),
            'diagnosa' => $this->request->getPost('diagnosa'),
            'created_at' => Time::now(),
            'updated-at' => Time::now()
        ];

        $this->diagnosa->insert($data, true);
        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data Diagnosa berhasil ditambahkan!');
    }

    public function delete($id)
    {
        $isDelete = $this->diagnosa->delete($id);
        if ($isDelete) {
            return redirect()->back()->with('success', 'diagnosa berhasil dihapus!');
        } else {
            return redirect()->back()->with('errors', [
                'Gagal menghapus diagnosa'
            ]);
        }
    }


    public function update()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_icd' => 'required',
            'diagnosa' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        try {
            // Ambil data dari form
            $kode_icd = $this->request->getPost('kode_icd');
            $diagnosaResult = $this->request->getPost('diagnosa');
            $id = $this->request->getPost('id');
            // Cari catatan berdasarkan kode_icd
            $existingRecord = $this->diagnosa->where('id', $id)->first();

            if (!$existingRecord) {
                return redirect()->back()->with('errors', ['Kode ICD tidak ditemukan.']);
            }

            // Persiapkan data untuk update
            $data = [
                'kode_diagnosa' => $kode_icd,
                'diagnosa' => $diagnosaResult
            ];

            // Update data berdasarkan ID yang ditemukan
            $this->diagnosa->update($id, $data);

            return redirect()->back()->with('success', 'Diagnosa berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', [
                $th->getMessage()
            ]);
        }
    }
}
