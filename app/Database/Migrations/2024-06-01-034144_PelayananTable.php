<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PelayananTable extends Migration
{
    public function up()
    {
        // Define the pelayanan table structure
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tgl_pelayanan' => [
                'type'       => 'DATE',
            ],
            'dokter_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'petugas_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pasien_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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

        // Add the primary key
        $this->forge->addKey('id', true);

        // Add foreign key constraints
        $this->forge->addForeignKey('dokter_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pasien_id', 'pasien', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('petugas_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('pelayanan');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('pelayanan');
    }
}
