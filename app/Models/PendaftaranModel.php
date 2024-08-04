<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'pasien_id',
        'tanggal_pendaftaran',
        'cara_bayar',
        'jenis_pasien',
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;


    public function getPendaftaranBulanan($bulan = null)
    {
        $builder = $this->db->table($this->table);

        if ($bulan !== null) {
            $builder->where('MONTH(created_at)', $bulan);
        }

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
            $bulanNama = date('F', mktime(0, 0, 0, $row['bulan'], 10));
            $data[$bulanNama] = $row['jumlah'];
        }

        return $data;
    }


    public function getPendaftaranBulananFilter($start_date, $end_date)
    {
        // Assuming created_at is the column storing the date of registration
        $this->where('created_at >=', $start_date)
            ->where('created_at <=', $end_date);

        // Group by month and count the number of registrations per month
        $this->select('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as jumlah');
        $this->groupBy('month');
        $query = $this->get();

        $result = [];
        foreach ($query->getResultArray() as $row) {
            $result[$row['month']] = $row['jumlah'];
        }

        return $result;
    }



    public function cetak($bulan)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pendaftaran.*, pasien.*');
        $builder->join('pasien', 'pasien.id = pendaftaran.pasien_id');
        $builder->where('MONTH(pendaftaran.created_at)', $bulan);
        $query = $builder->get();
        return $query->getResultArray();
    }








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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
