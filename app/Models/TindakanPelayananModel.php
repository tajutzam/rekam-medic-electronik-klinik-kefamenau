<?php

namespace App\Models;

use CodeIgniter\Model;

class TindakanPelayananModel extends Model
{
    protected $table            = 'tindakan_pelayanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tindakan_id', 'pelayanan_id'
    ];


    public function getPopularDiagnosa($limit = 10)
    {
        return $this->select('tindakan.id, tindakan.tindakan,  tindakan.kode_tindakan, COUNT(tindakan_pelayanan.tindakan_id) as total_tindakan')
            ->join('tindakan', 'tindakan.id = tindakan_pelayanan.tindakan_id')
            ->groupBy('tindakan_pelayanan.tindakan_id')
            ->orderBy('total_tindakan', 'DESC')
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
