<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasienTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_rm' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nomor_ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'no_bpjs' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'usia' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'default'    => 'Laki-laki',
            ],
            'jenis_pasien' => [
                'type'       => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'default'    => 'Laki-laki',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'nomor_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'gol_dar' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'desa' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kabupaten' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'wali_pasien' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_hp_wali' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'riwayat_penyakit' => [
                'type' => 'TEXT',
            ],
            'riwayat_penyakit_keluarga' => [
                'type' => 'TEXT',
            ],
            'riwayat_alergi' => [
                'type' => 'TEXT',
            ],
            'qrcode' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pasien');
    }

    public function down()
    {
        $this->forge->dropTable('pasien');
    }
}
