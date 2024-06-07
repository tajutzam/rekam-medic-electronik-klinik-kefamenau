<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssesmenTable extends Migration
{
    public function up()
    {
        // Define the assesmen table structure
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pelayanan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tinggi_badan' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'berat_badan' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'status_gizi' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'Sistole' => [
                'type'       => 'CHAR',
                'constraint' => 10,
            ],
            'Diastole' => [
                'type'       => 'CHAR',
                'constraint' => 10,
            ],
            'denyut_jantung' => [
                'type'       => 'CHAR',
                'constraint' => 15,
            ],
            'respirate_rate' => [
                'type'       => 'CHAR',
                'constraint' => 15,
            ],
            'Ket' => [
                'type' => 'TEXT',
            ],
            'spo2' => [
                'type'       => 'CHAR',
                'constraint' => 5,
            ],
            'alergi_obat' => [
                'type'       => 'INT',
                'constraint' => 1,
            ],
            'Anamnesa' => [
                'type'       => 'CHAR',
                'constraint' => 15,
            ],
        ]);

        // Add the primary key
        $this->forge->addPrimaryKey('id');

        // Add the foreign key constraint
        $this->forge->addForeignKey('id_pelayanan', 'pelayanan', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('assesmen');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('assesmen');
    }
}
