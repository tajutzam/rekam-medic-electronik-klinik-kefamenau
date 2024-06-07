<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'dosis' => '500 mg',
                'satuan' => 'Tablet',
                'kode_obat' => 'OB001',
                'nama_obat' => 'Paracetamol',
                'harga' => 5000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'dosis' => '50 mg',
                'satuan' => 'Botol',
                'kode_obat' => 'OB002',
                'nama_obat' => 'Amoxicillin',
                'harga' => 8000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO obat (dosis, satuan, kode_obat, nama_obat, harga, created_at, updated_at) VALUES(:dosis:, :satuan:, :kode_obat:, :nama_obat:, :harga:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        $this->db->table('obat')->insertBatch($data);
    }
}
