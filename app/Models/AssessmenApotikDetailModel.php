<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmenApotikDetailModel extends Model
{
    protected $table = 'assesmen_apotik_detail';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'assesmen_apotik_id',
        'obat_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'jumlah', 'total', 'catatan',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $dateFormat    = 'datetime';

    // Soft Deletes
    protected $useSoftDeletes = true;
}
