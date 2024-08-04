<?php

namespace App\Models;

use CodeIgniter\Model;

class PelayananModel extends Model
{
    protected $table = 'pelayanan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'tgl_pelayanan',
        'dokter_id',
        'petugas_id',
        'pasien_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'signature'
    ];


    public function getPelayananByAssesmenId($assesmenId) {
        return $this->db->table('assesmen')
            ->select('
                pasien.*, 
                petugas.nama_lengkap as nama_petugas, 
                dokter.nama_lengkap as nama_dokter, 
                pelayanan.*, 
                assesmen.*, 
                assesmen.id as id_assesmen,
                pelayanan.id as id_pelayanan,
                GROUP_CONCAT(diagnosa_pelayanan.id) as diagnosa_pelayanan_ids,
                GROUP_CONCAT(diagnosa.kode_diagnosa, " - ", diagnosa.diagnosa) as diagnosa_ids,
                GROUP_CONCAT(tindakan_pelayanan.id) as tindakan_pelayanan_ids,
                GROUP_CONCAT(tindakan.kode_tindakan, " - ", tindakan.tindakan) as tindakan_ids,
                GROUP_CONCAT(assesmen_apotik.id) as assesmen_apotik_ids,
                GROUP_CONCAT(assesmen_apotik_detail.id) as assesmen_apotik_detail_ids,
                GROUP_CONCAT(assesmen_apotik_detail.jumlah, " ", obat.satuan, " ", obat.nama_obat, " (", assesmen_apotik_detail.catatan, ")") as obat_ids
            ')
            ->join('pelayanan', 'assesmen.id_pelayanan = pelayanan.id')
            ->join('pasien', 'pasien.id = pelayanan.pasien_id')
            ->join('users as petugas', 'petugas.id = pelayanan.petugas_id')
            ->join('users as dokter', 'dokter.id = pelayanan.dokter_id')
            ->join('diagnosa_pelayanan', 'diagnosa_pelayanan.pelayanan_id = pelayanan.id', 'left')
            ->join('diagnosa', 'diagnosa.id = diagnosa_pelayanan.diagnosa_id', 'left')
            ->join('tindakan_pelayanan', 'tindakan_pelayanan.pelayanan_id = pelayanan.id', 'left')
            ->join('tindakan', 'tindakan.id = tindakan_pelayanan.tindakan_id', 'left')
            ->join('assesmen_apotik', 'assesmen_apotik.assesmen_id = assesmen.id', 'left')
            ->join('assesmen_apotik_detail', 'assesmen_apotik_detail.assesmen_apotik_id = assesmen_apotik.id', 'left')
            ->join('obat', 'obat.id = assesmen_apotik_detail.obat_id', 'left')
            ->where('assesmen.id', $assesmenId)
            ->groupBy('assesmen.id') // Grouping to avoid duplicate rows
            ->get()
            ->getResultArray();
    }
    

    public function getAssessmentApotikDetails($pelayananId)
    {

        return $this->db->table('pelayanan')
            ->select('
                pelayanan.id as pelayanan_id, 
                pelayanan.tgl_pelayanan, 
                pelayanan.signature, 
                (SELECT GROUP_CONCAT(assesmen.id) FROM assesmen WHERE assesmen.id_pelayanan = pelayanan.id LIMIT 1) as assesmen_ids,
                (SELECT GROUP_CONCAT(diagnosa_pelayanan.id) FROM diagnosa_pelayanan WHERE diagnosa_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as diagnosa_pelayanan_ids,
                (SELECT GROUP_CONCAT(CONCAT(diagnosa.kode_diagnosa, " - ", diagnosa.diagnosa)) FROM diagnosa_pelayanan INNER JOIN diagnosa ON diagnosa.id = diagnosa_pelayanan.diagnosa_id WHERE diagnosa_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as diagnosa_ids,
                (SELECT GROUP_CONCAT(tindakan_pelayanan.id) FROM tindakan_pelayanan WHERE tindakan_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as tindakan_pelayanan_ids,
                (SELECT GROUP_CONCAT(CONCAT(tindakan.kode_tindakan, " - ", tindakan.tindakan)) FROM tindakan_pelayanan INNER JOIN tindakan ON tindakan.id = tindakan_pelayanan.tindakan_id WHERE tindakan_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as tindakan_ids,
                (SELECT GROUP_CONCAT(assesmen_apotik.id) FROM assesmen_apotik WHERE assesmen_apotik.assesmen_id IN (SELECT id FROM assesmen WHERE id_pelayanan = pelayanan.id) LIMIT 1) as assesmen_apotik_ids,
                (SELECT GROUP_CONCAT(assesmen_apotik_detail.id) FROM assesmen_apotik_detail INNER JOIN assesmen_apotik ON assesmen_apotik.id = assesmen_apotik_detail.assesmen_apotik_id INNER JOIN assesmen ON assesmen.id = assesmen_apotik.assesmen_id WHERE assesmen.id_pelayanan = pelayanan.id LIMIT 1) as assesmen_apotik_detail_ids,
                (SELECT GROUP_CONCAT(CONCAT(assesmen_apotik_detail.jumlah, " ", obat.satuan, " ", obat.nama_obat, " (", assesmen_apotik_detail.catatan, ")")) FROM assesmen_apotik_detail INNER JOIN obat ON obat.id = assesmen_apotik_detail.obat_id INNER JOIN assesmen_apotik ON assesmen_apotik.id = assesmen_apotik_detail.assesmen_apotik_id INNER JOIN assesmen ON assesmen.id = assesmen_apotik.assesmen_id WHERE assesmen.id_pelayanan = pelayanan.id LIMIT 1) as obat_ids,
                (SELECT anamnesa FROM assesmen WHERE id_pelayanan = pelayanan.id LIMIT 1) as anamnesa,
                users.nama_lengkap as dokter, 
                pasien.*
            ')
            ->join('pasien', 'pasien.id = pelayanan.pasien_id', 'left')
            ->join('users', 'users.id = pelayanan.dokter_id', 'left')
            ->where('pelayanan.id', $pelayananId)
            ->get()
            ->getResultArray();
    }

    public function getAnamnesa($idPelayanan) {
        $query = $this->db->table('assesmen')
            ->select('anamnesa')
            ->where('id', $idPelayanan)
            ->get();
    
        return $query->getResultArray(); // Mengembalikan hasil query dalam bentuk array
    }


    public function getPelayananDetails($pelayananId)
    {
        return $this->db->table('pelayanan')
            ->select('
                pelayanan.id as pelayanan_id, 
                pelayanan.tgl_pelayanan, 
                (SELECT GROUP_CONCAT(assesmen.id) FROM assesmen WHERE assesmen.id_pelayanan = pelayanan.id LIMIT 1) as assesmen_ids,
                (SELECT GROUP_CONCAT(diagnosa_pelayanan.id) FROM diagnosa_pelayanan WHERE diagnosa_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as diagnosa_pelayanan_ids,
                (SELECT GROUP_CONCAT(CONCAT(diagnosa.kode_diagnosa, " - ", diagnosa.diagnosa)) FROM diagnosa_pelayanan INNER JOIN diagnosa ON diagnosa.id = diagnosa_pelayanan.diagnosa_id WHERE diagnosa_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as diagnosa_ids,
                (SELECT GROUP_CONCAT(tindakan_pelayanan.id) FROM tindakan_pelayanan WHERE tindakan_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as tindakan_pelayanan_ids,
                (SELECT GROUP_CONCAT(CONCAT(tindakan.kode_tindakan, " - ", tindakan.tindakan)) FROM tindakan_pelayanan INNER JOIN tindakan ON tindakan.id = tindakan_pelayanan.tindakan_id WHERE tindakan_pelayanan.pelayanan_id = pelayanan.id LIMIT 1) as tindakan_ids,
                (SELECT GROUP_CONCAT(assesmen_apotik.id) FROM assesmen_apotik WHERE assesmen_apotik.assesmen_id IN (SELECT id FROM assesmen WHERE id_pelayanan = pelayanan.id) LIMIT 1) as assesmen_apotik_ids,
                (SELECT GROUP_CONCAT(assesmen_apotik_detail.id) FROM assesmen_apotik_detail INNER JOIN assesmen_apotik ON assesmen_apotik.id = assesmen_apotik_detail.assesmen_apotik_id INNER JOIN assesmen ON assesmen.id = assesmen_apotik.assesmen_id WHERE assesmen.id_pelayanan = pelayanan.id LIMIT 1) as assesmen_apotik_detail_ids,
                (SELECT GROUP_CONCAT(CONCAT(assesmen_apotik_detail.jumlah, " ", obat.satuan, " ", obat.nama_obat, " (", assesmen_apotik_detail.catatan, ")")) FROM assesmen_apotik_detail INNER JOIN obat ON obat.id = assesmen_apotik_detail.obat_id INNER JOIN assesmen_apotik ON assesmen_apotik.id = assesmen_apotik_detail.assesmen_apotik_id INNER JOIN assesmen ON assesmen.id = assesmen_apotik.assesmen_id WHERE assesmen.id_pelayanan = pelayanan.id LIMIT 1) as obat_ids,
                (SELECT anamnesa FROM assesmen WHERE id_pelayanan = pelayanan.id LIMIT 1) as anamnesa,
                users.nama_lengkap as dokter, 
                pasien.*
            ')
            ->join('pasien', 'pasien.id = pelayanan.pasien_id', 'left')
            ->join('users', 'users.id = pelayanan.dokter_id', 'left')
            ->where('pelayanan.id', $pelayananId)
            ->get()
            ->getResultArray();
    }

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'tgl_pelayanan' => 'required|valid_date',
        'dokter_id'     => 'required|integer',
        'petugas_id'    => 'required|integer',
        'pasien_id'     => 'required|integer'
    ];

    protected $validationMessages = [
        'tgl_pelayanan' => [
            'required'   => 'Tanggal pelayanan is required',
            'valid_date' => 'Tanggal pelayanan must be a valid date'
        ],
        'dokter_id' => [
            'required' => 'Dokter ID is required',
            'integer'  => 'Dokter ID must be an integer'
        ],
        'petugas_id' => [
            'required' => 'Petugas ID is required',
            'integer'  => 'Petugas ID must be an integer'
        ],
        'pasien_id' => [
            'required' => 'Pasien ID is required',
            'integer'  => 'Pasien ID must be an integer'
        ]
    ];

    protected $skipValidation = false;


    public function cetak($start_date, $end_date)
    {
        return $this->where('created_at >=', $start_date)
            ->where('created_at <=', $end_date)
            ->findAll();
    }


    public function getCountPelayananByJenisPasienAndKabupaten($bulan, $tahun)
    {
        return $this->db->table('pelayanan')
            ->select('
                pasien.jenis_pasien,
                pasien.kabupaten,
                pasien.desa,
                COUNT(*) as total_pelayanan,
                SUM(CASE WHEN pasien.jenis_pasien = "BPJS" THEN 1 ELSE 0 END) as total_bpjs,
                SUM(CASE WHEN pasien.jenis_pasien = "Umum" THEN 1 ELSE 0 END) as total_umum
            ')
            ->join('pasien', 'pasien.id = pelayanan.pasien_id', 'left')
            ->where('pelayanan.deleted_at', null)
            ->where("MONTH(pelayanan.tgl_pelayanan) = $bulan")
            ->groupBy('pasien.jenis_pasien, pasien.kabupaten, pasien.desa')
            ->get()
            ->getResultArray();
    }
}
