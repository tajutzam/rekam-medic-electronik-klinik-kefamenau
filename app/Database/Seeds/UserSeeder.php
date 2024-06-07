<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {

        // 'constraint' => ['petugas', 'dokter', 'kepala-klinik', 'farmasi', 'admin'],

        $data = [
            [
                'nama_lengkap' => 'admin',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => '123 Main St, Anytown, USA',
                'jabatan' => 'Admin',
                'username' => 'admin',
                'role' => 'admin',
                'password' => password_hash('rahasia', PASSWORD_DEFAULT),
                'foto' => null,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
                'deleted_at' => null,
            ],
            [
                'nama_lengkap' => 'petugas',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => '456 Elm St, Anytown, USA',
                'jabatan' => 'Petugas',
                'username' => 'petugas',
                'role' => 'petugas',
                'password' => password_hash('rahasia', PASSWORD_DEFAULT),
                'foto' => null,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
                'deleted_at' => null,
            ],
            [
                'nama_lengkap' => 'dokter',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => '456 Elm St, Anytown, USA',
                'jabatan' => 'dokter',
                'username' => 'dokter',
                'role' => 'dokter',
                'password' => password_hash('rahasia', PASSWORD_DEFAULT),
                'foto' => null,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
                'deleted_at' => null,
            ],
            [
                'nama_lengkap' => 'kepala-klinik',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => '456 Elm St, Anytown, USA',
                'jabatan' => 'kepala-klinik',
                'username' => 'kepala-klinik',
                'role' => 'kepala-klinik',
                'password' => password_hash('rahasia', PASSWORD_DEFAULT),
                'foto' => null,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
                'deleted_at' => null,
            ],
            [
                'nama_lengkap' => 'farmasi',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => '456 Elm St, Anytown, USA',
                'jabatan' => 'farmasi',
                'username' => 'farmasi',
                'role' => 'farmasi',
                'password' => password_hash('rahasia', PASSWORD_DEFAULT),
                'foto' => null,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
                'deleted_at' => null,
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
