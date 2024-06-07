<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiagnosaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_diagnosa' => 'KD001',
                'diagnosa' => 'Flu',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_diagnosa' => 'KD002',
                'diagnosa' => 'Demam',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO diagnosa (kode_diagnosa, diagnosa, created_at, updated_at) VALUES(:kode_diagnosa:, :diagnosa:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        $this->db->table('diagnosa')->insertBatch($data);
    }
}
