<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaPelayananModel extends Model
{
    protected $table            = 'diagnosa_pelayanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'diagnosa_id', 'pelayanan_id', 'jenis'
    ];


    public function getPopularDiagnosa($limit = 10)
    {
        return $this->select('diagnosa.id, diagnosa.diagnosa,  diagnosa.kode_diagnosa, COUNT(diagnosa_pelayanan.diagnosa_id) as total_diagnosa')
            ->join('diagnosa', 'diagnosa.id = diagnosa_pelayanan.diagnosa_id')
            ->groupBy('diagnosa_pelayanan.diagnosa_id')
            ->orderBy('total_diagnosa', 'DESC')
            ->limit($limit)
            ->findAll();
    }

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
}
