<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObatModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use CodeIgniter\Validation\Validation;

class ObatController extends BaseController
{


    private $obat;

    public function __construct()
    {
        $this->obat = new ObatModel();
    }

    public function index()
    {
        $obats = $this->obat->findAll();
        $data['obats'] = $obats;
        $header['title'] = 'Dashboard';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('obat/index', $data);
    }


    public function delete($id)
    {
        try {
            //code...
            $this->obat->delete($id);
            return redirect()->back()->withInput()->with('success', 'berhasil menghapus obat');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withInput()->with('errors', [$th->getMessage()]);
        }
    }


    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_obat' => 'required|is_unique[obat.kode_obat]',
            'dosis' => 'required',
            'satuan' => 'required',
            'nama_obat' => 'required',
            'harga' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'dosis' => $this->request->getPost('dosis'),
            'satuan' => $this->request->getPost('satuan'),
            'kode_obat' => $this->request->getPost('kode_obat'),
            'nama_obat' => $this->request->getPost('nama_obat'),
            'harga' => $this->request->getPost('harga'),
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ];


        $this->obat->insert($data);
        return redirect()->back()->withInput()->with('success', 'berhasil menambahkan obat');
    }


    public function update()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_obat' => 'required',
            'dosis' => 'required',
            'satuan' => 'required',
            'nama_obat' => 'required',
            'harga' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        try {
            $data = [
                'dosis' => $this->request->getPost('dosis'),
                'satuan' => $this->request->getPost('satuan'),
                'kode_obat' => $this->request->getPost('kode_obat'),
                'nama_obat' => $this->request->getPost('nama_obat'),
                'harga' => $this->request->getPost('harga'),
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];

            // Update data berdasarkan ID yang ditemukan
            $this->obat->update($this->request->getPost('id'), $data);

            return redirect()->back()->with('success', 'obat berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', [
                $th->getMessage()
            ]);
        }
    }
}
