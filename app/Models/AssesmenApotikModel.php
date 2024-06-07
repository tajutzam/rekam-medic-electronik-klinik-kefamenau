<?php

namespace App\Models;

use CodeIgniter\Model;

class AssesmenApotikModel extends Model
{
    protected $table = 'assesmen_apotik';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'assesmen_id',
        'total',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getObatByPelayananId($pelayanan_id)
    {
        return $this->db->table('assesmen_apotik_detail')
            ->select(['assesmen_apotik_detail.catatan', 'assesmen_apotik_detail.total', 'assesmen_apotik_detail.jumlah', 'assesmen_apotik_detail.id as id_detail', 'obat.*']) // Adjust the columns as needed
            ->join('assesmen_apotik', 'assesmen_apotik.id = assesmen_apotik_detail.assesmen_apotik_id')
            ->join('obat', 'assesmen_apotik_detail.obat_id = obat.id')
            ->where('assesmen_apotik.assesmen_id', $pelayanan_id)
            ->get()
            ->getResultArray();
    }

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $dateFormat    = 'datetime';

    // Soft Deletes
    protected $useSoftDeletes = true;
}
