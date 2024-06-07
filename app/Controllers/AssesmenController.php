<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\AssessmenApotikDetail;
use App\Models\AssesmeModel;
use App\Models\AssesmenApotikModel;
use App\Models\AssessmenApotikDetailModel;
use App\Models\DiagnosaModel;
use App\Models\DiagnosaPelayananModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\TindakanModel;
use CodeIgniter\HTTP\ResponseInterface;

class AssesmenController extends BaseController
{



    protected $assesmen;
    protected $assesmenApotik;

    protected $assesmenDetail;
    protected $pasien;




    public function __construct()
    {
        $this->assesmen = new AssesmeModel();
        $this->assesmenApotik = new AssesmenApotikModel();
        $this->assesmenDetail = new AssessmenApotikDetailModel();
        $this->pasien = new PasienModel();
    }



    public function index()
    {
        //

    }

    public function store($segment1, $segment2)
    {

        $obatIds = $this->request->getPost('obat_selected');
        $obat = new ObatModel();

        try {
            //code...
            $isValid  = $this->validate([
                'tinggi_badan' => 'required',
                'berat_badan' => 'required',
                'status_gizi' => 'required',
                'Sistole' => 'required',
                'Diastole' => 'required',
                'denyut_jantung' => 'required',
                'respirate_rate' => 'required',
                'Ket' => 'required',
                'spo2' => 'required',
                'alergi_obat' => 'required',
                'Anamnesa' => 'required'
            ]);

            if (!$isValid) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $dataAssesmenModel = [
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'berat_badan' => $this->request->getPost('berat_badan'),
                'status_gizi' => $this->request->getPost('status_gizi'),
                'Sistole' => $this->request->getPost('Sistole'),
                'Diastole' => $this->request->getPost('Diastole'),
                'denyut_jantung' => $this->request->getPost('denyut_jantung'),
                'respirate_rate' => $this->request->getPost('respirate_rate'),
                'Ket' => $this->request->getPost('Ket'),
                'spo2' => $this->request->getPost('spo2'),
                'alergi_obat' => $this->request->getPost('alergi_obat'),
                'Anamnesa' => $this->request->getPost('Anamnesa'),
                'id_pelayanan' => session()->get('user_id')
            ];
            $idAssemen = $this->assesmen->insert($dataAssesmenModel, true);

            if ($dataAssesmenModel['alergi_obat'] == '1') {
                if (isset($obatIds) && sizeof($obatIds) > 0) {
                    $totalHarga = $obat->whereIn('id', $obatIds)->selectSum('harga')->first();
                    $obats = $obat->whereIn('id', $obatIds)->findAll();

                    $assemenApotek = $this->assesmenApotik->insert(
                        [
                            'assesmen_id'   => $idAssemen, 'total' => $totalHarga
                        ],
                        true
                    );
                    if (isset($assemenApotek)) {
                        foreach ($obats as $key => $value) {
                            # code...
                            $this->assesmenDetail->insert(
                                [
                                    'assesmen_apotik_id' => $assemenApotek,
                                    'obat_id' => $value['id'],
                                    'jumlah' => 1,
                                    'total' => 1 * $value['harga']
                                ]
                            );
                        }
                    }
                }
            }
            return redirect()->to(base_url('/rekam-medis/diagnosa/' . $segment1 . '/' . $segment2))->with('message', 'assesment berhasil data stored successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            var_dump($th->getMessage(), $th->getLine());
        }
    }


    public function diagnosa_create($segment1, $segment2)
    {
        $header['title'] = 'Rekam-medic';
        $diagnosa = new DiagnosaModel();
        $tindakan = new TindakanModel();

        $diagnosas = $diagnosa->findAll();
        $tindakans = $tindakan->findAll();

        $data['diagnosas'] = $diagnosas;
        $data['tindakans'] = $tindakans;

        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/create_diagnosa_tindakan', $data);
    }


    public function diagnosa_store($segment1, $segment2)
    {
        try {
            //code...
            $diagnosaPelayanan = new DiagnosaPelayananModel();
            $tindakanPelayanan = new TindakanModel();

            $data = $this->request->getPost();
            $dataDiagnosa = [];
            $dataTindakan = [];
            foreach ($data['diagnosa'] as $key => $value) {
                $jenis = $data['jenis_diagnosa'][$key];
                # code...       
                if ($value != 'Pilih Kode Icd Dan Diagnosa') {
                    $temp['diagnosa_id'] = $value;
                    $temp['pelayanan_id'] = $segment2;
                    $temp['jenis'] = $jenis;
                    array_push($dataDiagnosa, $temp);
                }
            }
            foreach ($data['tindakan'] as $key => $value) {
                # code...       
                if ($value != 'Pilih Kode tindakan dan tindakan') {
                    $temp['tindakan_id'] = $value;
                    $temp['pelayanan_id'] = $segment2;
                    array_push($dataTindakan, $temp);
                }
            };
            $diagnosaPelayanan->insertBatch($dataDiagnosa);
            $tindakanPelayanan->insertBatch($dataTindakan);
            return redirect()->to(base_url('/rekam-medis/obat/' . $segment1 . '/' . $segment2))->with('message', 'assesment berhasil data stored successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('message', $th->getMessage());
        }
    }


    public function obat_edit($segment1, $segment2)
    {
        $pasien = $this->pasien->where('nomor_rm', $segment1)->first();

        $data['pasien'] = $pasien;

        $obatList = $this->assesmenApotik->getObatByPelayananId($segment2);

        $data['obats'] = $obatList;
        $header['title'] = 'edit obat';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/edit_obat', $data);
    }


    public function obat_update()
    {
        $data = $this->request->getPost();
    }
}
