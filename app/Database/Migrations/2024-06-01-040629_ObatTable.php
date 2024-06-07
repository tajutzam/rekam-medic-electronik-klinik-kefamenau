<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ObatTable extends Migration
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
            'dosis' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Set an appropriate constraint length
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'kode_obat' => [
                'type'       => 'VARCHAR',
                'constraint' => 22,
            ],
            'nama_obat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Set an appropriate constraint length
            ],
            'harga' => [
                'type' => 'BIGINT',
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
        $this->forge->createTable('obat');
    }

    public function down()
    {
        $this->forge->dropTable('obat');
    }
}
