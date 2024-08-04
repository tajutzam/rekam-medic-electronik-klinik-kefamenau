<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TindakanModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class TindakanController extends BaseController
{
    protected $tindakan;


    public function __construct()
    {
        $this->tindakan = new TindakanModel();
    }

    public function index()
    {
        //
        $tindakans = $this->tindakan->findAll();
        $data['tindakans'] = $tindakans;
        $header['title'] = 'Dashboard';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('tindakan/index', $data);
    }


    public function store()
    {
        try {
            //code...
            $validation = \Config\Services::validation();

            $validation->setRules([
                'kode_tindakan' => 'required|is_unique[tindakan.kode_tindakan]',
                'tindakan' => 'required',

            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }


            $data = [
                'kode_tindakan' => $this->request->getPost('kode_tindakan'),
                'tindakan' => $this->request->getPost('tindakan'),
                'tarif' => $this->request->getPost('tarif'),
            ];


            $this->tindakan->insert($data);
            return redirect()->back()->withInput()->with('success', 'berhasil menambahkan data tindakan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', [$th->getMessage()]);
            //throw $th;
        }
    }


    public function update()
    {
        try {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'kode_tindakan' => 'required',
                'tindakan' => 'required',
                'id' => 'required'
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $data = [
                'kode_tindakan' => $this->request->getPost('kode_tindakan'),
                'tindakan' => $this->request->getPost('tindakan'),
                'tarif' => $this->request->getPost('tarif'),
            ];
            $this->tindakan->update($this->request->getPost('id'), $data);
            return redirect()->back()->with('success', 'tindakan berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('errors', [
                $th->getMessage()
            ]);
        }
    }


    public function delete($id)
    {
        $isDelete = $this->tindakan->delete($id);
        if ($isDelete) {
            return redirect()->back()->with('success', 'tindakan berhasil dhapus!');
        } else {
            return redirect()->back()->withInput()->with('errors', [
                'tindakan gagal dihapus'
            ]);
        }
    }
}
