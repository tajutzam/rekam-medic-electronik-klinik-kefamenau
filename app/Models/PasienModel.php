<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table            = 'pasien';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'nomor_rm',
        'nomor_ktp',
        'no_bpjs',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'jenis_kelamin',
        'alamat',
        'nomor_hp',
        'agama',
        'gol_dar',
        'pekerjaan',
        'pendidikan',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'nama_ibu',
        'wali_pasien',
        'no_hp_wali',
        'riwayat_penyakit',
        'riwayat_penyakit_keluarga',
        'riwayat_alergi',
        'qrcode',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function getPendaftaranBulanan()
    {
        $builder = $this->db->table($this->table);
        $builder->select('MONTH(created_at) as bulan, COUNT(*) as jumlah');
        $builder->groupBy('bulan');
        $builder->orderBy('bulan');
        $query = $builder->get();

        $result = $query->getResultArray();

        // Inisialisasi array bulan dengan nilai 0
        $data = array_fill_keys(
            array_map(function ($num) {
                return date('F', mktime(0, 0, 0, $num, 10));
            }, range(1, 12)),
            0
        );

        // Isi data dengan hasil query
        foreach ($result as $row) {
            $bulan = date('F', mktime(0, 0, 0, $row['bulan'], 10));
            $data[$bulan] = $row['jumlah'];
        }

        return $data;
    }


    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateNomorRM'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function generateNomorRM(array $data)
    {
        // Get the last inserted nomor_rm
        $lastRecord = $this->orderBy('id', 'DESC')->first();
        if ($lastRecord) {
            $lastNomorRm = $lastRecord['nomor_rm'];
            $lastNumber = intval(substr($lastNomorRm, 2));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $data['data']['nomor_rm'] = str_pad($newNumber, 6, '0', STR_PAD_LEFT);

        return $data;
    }
}
