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
use App\Models\PelayananModel;
use App\Models\TindakanModel;
use App\Models\TindakanPelayananModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class AssesmenController extends BaseController
{



    protected $assesmen;
    protected $assesmenApotik;

    protected $assesmenDetail;
    protected $pasien;

    protected $pelayanan;
    protected $obat;




    public function __construct()
    {
        $this->assesmen = new AssesmeModel();
        $this->assesmenApotik = new AssesmenApotikModel();
        $this->assesmenDetail = new AssessmenApotikDetailModel();
        $this->pasien = new PasienModel();
        $this->pelayanan = new PelayananModel();
        $this->obat = new ObatModel();
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
        $session = session();
        try {
            $diagnosaPelayanan = new DiagnosaPelayananModel();
            $tindakanPelayanan = new TindakanPelayananModel();

            $validation = \Config\Services::validation();

            // Define validation rules
            $validation->setRules([
                'diagnosa' => 'required',
                'tindakan' => 'required',
                'jenis_diagnosa' => 'required'
            ]);

            // Get the data from the request
            $data = $this->request->getPost();

            // Run the validation
            if (!$validation->run($data)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Initialize arrays to store diagnosa and tindakan data
            $dataDiagnosa = [];
            $dataTindakan = [];

            foreach ($data['diagnosa'] as $key => $value) {
                $jenis = $data['jenis_diagnosa'][$key];

                if ($value != 'Pilih Kode Icd Dan Diagnosa') {
                    $temp['diagnosa_id'] = $value;
                    $temp['pelayanan_id'] = $segment2;
                    $temp['jenis'] = $jenis;
                    array_push($dataDiagnosa, $temp);
                }
            }

            foreach ($data['tindakan'] as $key => $value) {
                if ($value != 'Pilih Kode tindakan dan tindakan') {
                    $tempTindakan['tindakan_id'] = $value;
                    $tempTindakan['pelayanan_id'] = $segment2;
                    array_push($dataTindakan, $tempTindakan);
                }
            }

            // Insert data into the database
            $diagnosaPelayanan->insertBatch($dataDiagnosa);
            $tindakanPelayanan->insertBatch($dataTindakan);

            return redirect()->to(base_url('/rekam-medis/obat/' . $segment1 . '/' . $segment2))->with('message', 'Assessment berhasil data stored successfully!');
        } catch (\Throwable $th) {
            // Handle the exception
            return redirect()->back()->with('message', $th->getMessage());
        }
    }


    public function delete_pelayanan($segment1 = null, $segment2 = null)
    {
        $this->assesmen->delete($segment2);
        return redirect()->back()->with('success', 'Data deleted successfully!');
    }


    public function obat_edit($segment1, $segment2)
    {
        $pasien = $this->pasien->where('nomor_rm', $segment1)->first();

        $obatData = $this->obat->findAll();
        $data['pasien'] = $pasien;

        $obatList = $this->assesmenApotik->getObatByPelayananId($segment2);

        $data['obats'] = $obatList;
        $data['obatData'] = $obatData;
        $data['segment1'] = $segment1;
        $data['segment2'] = $segment2;


        $header['title'] = 'edit obat';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/edit_obat', $data);
    }


    public function addObat($segment1, $segment2)
    {
        $assesmenApotik = new AssesmenApotikModel();
        $assemenApotikData = $assesmenApotik->where('assesmen_id', $segment2)->first();
        $data = $this->request->getPost();
        if (isset($assemenApotikData)) {
            $total = $assemenApotikData['total'];
            $totalObatHaga = $this->obat->where('id', $data['obat_id'])->select('harga')->first();

            $this->assesmenDetail->insert(
                [
                    'assesmen_apotik_id' => $assemenApotikData['id'],
                    'obat_id' => $data['obat_id'],
                    'jumlah' => $data['jumlah'],
                    'total' => $data['jumlah'] * $totalObatHaga['harga'],
                    'catatan' => $data['catatan']
                ]
            );
            return redirect()->back();
        } else {
            $total = $this->obat->where('id', $data['obat_id'])->select('harga')->first();
            $assemenApotekId = $this->assesmenApotik->insert(
                [
                    'assesmen_id'   => $segment2, 'total' => $total
                ],
                true
            );
            $this->assesmenDetail->insert(
                [
                    'assesmen_apotik_id' => $assemenApotekId,
                    'obat_id' => $data['obat_id'],
                    'jumlah' => 1,
                    'total' => 1 * $total['harga'],
                    'catatan' => $data['catatan']

                ]
            );
            return redirect()->back();
        }
    }





    public function obat_updates()
    {
        $data = $this->request->getPost();
        $detail = $this->assesmenDetail->where('id', $data['id'])->first();
        $idAssessmenApotik = $detail['assesmen_apotik_id'];
        $this->assesmenDetail->update($data['id'], [
            'catatan' => $data['catatan'],
            'jumlah' => $data['jumlah'],
            'total' => $data['total']
        ]);
        return redirect()->back()->with('success', 'berhasil update obat');
    }

    public function update_total($segment1, $segment2)
    {
        $data = $this->request->getPost();
        if ($data['id'] != '') {
            $obatList = $this->assesmenApotik->getObatByPelayananId($segment2);
            $total = 0;
            foreach ($obatList as $key => $value) {
                # code...
                $total += $value['total'];
            }
            $this->assesmenApotik->update($data['id'], [
                'total' => $total
            ]);
            return redirect()->to('/rekam-medis/authentikasi/' . $segment1 . '/' . $segment2 . '')->with('success', 'berhasil update obat silahkan masukan authentikasi');
        }
    }


    public function authentikasi($segment1, $segment2)
    {
        $header['title'] = 'Rekam-medic';
        $diagnosa = new DiagnosaModel();
        $tindakan = new TindakanModel();

        $data['rm'] = $segment1;
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('rekam-medis/authentikasi', $data);
    }


    public function authentikasi_add($segment1, $segment2)
    {
        $data = $this->request->getPost();
        $data = $this->request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'signature' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $signatureData = $data['signature'];
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = base64_decode($signatureData);

        try {
            // Insert the data into the database
            $this->pelayanan->update($segment2, [
                'signature' => $signatureData
            ]);
            // Redirect or return a response
            return redirect()->to('/rekam-medis/pelayanan/' . $segment1)->with('success', 'Berhasil menambahkan signature');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to add data: ' . $e->getMessage());
        }
    }



    public function generate_pdf($segment1)
    {
        // Data medis untuk diisi dalam template PDF
        $data = $this->pelayanan->getPelayananByAssesmenId($segment1)[0];
        $anamnesa = $this->pelayanan->getAnamnesa($segment1);
        $data['anamnesa'] = $anamnesa[0]['anamnesa'] ?? "no anamnesa";
        // Load view dan passing data
        $html = view('/rekam-medis/pdf', $data);
        // Inisialisasi DOMPDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("resume_medis.pdf", array("Attachment" => 0));
    }


    public function getPelayananDetails($segment1)
    {
        $data = $this->pelayanan->getPelayananDetails($segment1)[0];
        return response()->setJSON([
            'data' => $data
        ]);
    }
}
