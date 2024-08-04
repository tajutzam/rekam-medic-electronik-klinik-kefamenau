<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;
use App\Models\DiagnosaPelayananModel;
use App\Models\PasienModel;
use App\Models\PelayananModel;
use App\Models\PendaftaranModel;
use App\Models\TindakanModel;
use App\Models\TindakanPelayananModel;
use App\Models\UserModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Home extends BaseController
{

    protected $diagnosaPelayanan;
    protected $tindakanPelayanan;
    protected $pelayananModel;

    public function __construct()
    {
        $this->diagnosaPelayanan = new DiagnosaPelayananModel();
        $this->tindakanPelayanan = new TindakanPelayananModel();
        $this->pelayananModel = new PelayananModel();
    }

    public function index(): string
    {
        // content
        $header['title'] = 'Dashboard';

        $diagnosas = $this->diagnosaPelayanan->getPopularDiagnosa();
        $tindakans = $this->tindakanPelayanan->getPopularDiagnosa();


        $data['diagnosa_populer'] = $diagnosas;
        $data['tindakan_populer'] = $tindakans;


        $userModel = new  UserModel();
        $pasienModel = new  PasienModel();
        $diagnosaModel = new  DiagnosaModel();
        $pelayananModel = new  PendaftaranModel();


        $data['user'] = sizeof($userModel->findAll());
        $data['pasien'] = sizeof($pasienModel->findAll());
        $data['diagnosa'] = sizeof($diagnosaModel->findAll());
        $pendaftaranBulanan = $pelayananModel->getPendaftaranBulanan();
        $pendaftaranLabels = [];
        $pendaftaranData = [];

        foreach ($pendaftaranBulanan as $bulan => $jumlah) {
            $pendaftaranLabels[] = $bulan;
            $pendaftaranData[] = $jumlah;
        }

        $data['pendaftaranLabels'] = json_encode($pendaftaranLabels);
        $data['pendaftaranData'] = json_encode($pendaftaranData);


        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('dashboard', $data);
    }



    public function filter(): string
    {
        // content
        $header['title'] = 'Dashboard';

        $diagnosas = $this->diagnosaPelayanan->getPopularDiagnosa();
        $tindakans = $this->tindakanPelayanan->getPopularDiagnosa();

        $data['diagnosa_populer'] = $diagnosas;
        $data['tindakan_populer'] = $tindakans;

        $userModel = new UserModel();
        $pasienModel = new PasienModel();
        $diagnosaModel = new DiagnosaModel();
        $pelayananModel = new PendaftaranModel();

        $data['user'] = sizeof($userModel->findAll());
        $data['pasien'] = sizeof($pasienModel->findAll());
        $data['diagnosa'] = sizeof($diagnosaModel->findAll());

        // Get start_date and end_date from form or use default values
        $start_date = $this->request->getPost('start_date') ?? '2023-01-01';
        $end_date = $this->request->getPost('end_date') ?? date('Y-m-d');

        $pendaftaranBulanan = $pelayananModel->getPendaftaranBulananFilter($start_date, $end_date);
        $pendaftaranLabels = [];
        $pendaftaranData = [];

        foreach ($pendaftaranBulanan as $bulan => $jumlah) {
            $pendaftaranLabels[] = $bulan;
            $pendaftaranData[] = $jumlah;
        }

        $data['pendaftaranLabels'] = json_encode($pendaftaranLabels);
        $data['pendaftaranData'] = json_encode($pendaftaranData);

        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('partial/footer');
        return view('dashboard', $data);
    }


    public function cetak()
    {
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');

        // Panggil model untuk mendapatkan data pendaftaran berdasarkan rentang tanggal
        $pelayananModel = new PendaftaranModel();
        $pendaftaranBulanan = $pelayananModel->cetak($start_date, $end_date);
        $pendaftaranBulanan['start_date'] = $start_date;
        $pendaftaranBulanan['end_date'] = $end_date;

        // Buat objek DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $data['pendaftaranBulanan'] = $pendaftaranBulanan;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $html = view('pendaftaran_pdf', $data);
        $dompdf->loadHtml($html);

        // Render PDF (optional: atur ukuran dan orientasi)
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Simpan atau kirim PDF sebagai response
        $dompdf->stream('laporan.pdf', ['Attachment' => false]);
    }





    public function laporan()
    {

        $popularDiagnosa = $this->diagnosaPelayanan->getPopularDiagnosa();
        $popularTindakan = $this->tindakanPelayanan->getPopularDiagnosa();


        $diagnosaLabel = [];
        $diagnosaData = [];

        $tindakanLabel = [];
        $tindakanData = [];

        foreach ($popularDiagnosa as $diagnosa) {
            $diagnosaLabel[] = $diagnosa['diagnosa']; // Menggunakan 'nama' sebagai label diagnosa
            $diagnosaData[] = $diagnosa['total_diagnosa']; // Menggunakan 'total_diagnosa' sebagai data jumlah diagnosa
        }

        foreach ($popularTindakan as $diagnosa) {
            $tindakanLabel[] = $diagnosa['tindakan']; // Menggunakan 'nama' sebagai label diagnosa
            $tindakanData[] = $diagnosa['total_tindakan']; // Menggunakan 'total_diagnosa' sebagai data jumlah diagnosa
        }

        // Data yang akan dilewatkan ke view
        $viewData = [
            'labels_diagnosa' => json_encode($diagnosaLabel),
            'data_diagnosa' => json_encode($diagnosaData),
            'labels_tindakan' => json_encode($tindakanLabel),
            'data_tindakan' => json_encode($tindakanData)
        ];



        // Tampilkan view dengan data
        $header['title'] = 'Dashboard';
        echo view('partial/header', $header);
        echo view('partial/topmenu');
        echo view('partial/sidebar');
        echo view('laporan/index', $viewData);
        echo view('partial/footer');
    }


    public function cetakLaporanKunjungan()
    {
        // Ambil bulan dari inputan POST
        $bulan = $this->request->getPost('month');
        $bulan = substr($bulan, 5, 2);

        $tahun = date('Y'); // Ambil tahun saat ini, atau sesuaikan dengan kebutuhan aplikasi Anda
        // Panggil model untuk mendapatkan data laporan kunjungan berdasarkan jenis pasien dan kabupaten
        $data['data'] = $this->pelayananModel->getCountPelayananByJenisPasienAndKabupaten($bulan, $tahun);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        if (sizeof($data['data']) > 0) {
            // Load view untuk cetak laporan dengan data yang sudah diambil
            echo view('laporan/cetak', $data);
        } else {
            return redirect('laporan');
        }
    }


    public function cetakLaporanDiagnosa()
    {
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $diagsnoaModel = new DiagnosaModel();

        $data['topDiagnosa'] = $diagsnoaModel->getTopDiagnosa($startDate, $endDate);
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        return view('laporan/cetak_diagnosa', $data);
    }

    public function cetakLaporanTindakan()
    {
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $tindakanModel = new TindakanModel();

        $data['topTindakan'] = $tindakanModel->getTopTindakan($startDate, $endDate);
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        return view('laporan/cetak_tindakan', $data);
    }
}
