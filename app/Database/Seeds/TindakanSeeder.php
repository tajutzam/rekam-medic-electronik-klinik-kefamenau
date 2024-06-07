<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TindakanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_tindakan' => 'T001',
                'tindakan' => 'Pemeriksaan Umum',
                'tarif' => 50000,
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_tindakan' => 'T002',
                'tindakan' => 'Rontgen',
                'tarif' => 100000,
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Using Query Builder
        $this->db->table('tindakan')->insertBatch($data);
    }
}
