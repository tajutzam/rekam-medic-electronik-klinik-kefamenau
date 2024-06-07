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
        'deleted_at'
    ];

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
}
