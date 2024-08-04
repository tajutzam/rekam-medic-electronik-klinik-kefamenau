<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaModel extends Model
{
    protected $table            = 'diagnosa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_diagnosa', 'diagnosa', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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


    public function getTopDiagnosa($start_date, $end_date)
    {
        $builder = $this->db->table('diagnosa_pelayanan dp');

        $builder->select('d.id AS diagnosa_id, d.diagnosa AS nama_diagnosa, COUNT(dp.id) AS jumlah_pelayanan , d.kode_diagnosa');
        $builder->join('diagnosa d', 'dp.diagnosa_id = d.id');
        $builder->join('pelayanan p', 'dp.pelayanan_id = p.id');
        $builder->where('p.tgl_pelayanan >=', $start_date);
        $builder->where('p.tgl_pelayanan <=', $end_date);
        $builder->groupBy('d.id, d.diagnosa');
        $builder->orderBy('jumlah_pelayanan', 'DESC');
        $builder->limit(10);

        $query = $builder->get();
        return $query->getResultArray();
    }
}
