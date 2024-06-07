<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DiagnosaTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_diagnosa' => [
                'type'       => 'varchar',
                'constraint' => 100, // Set an appropriate constraint length

            ],
            'diagnosa' => [
                'type' => 'varchar',
                'constraint' => 200,
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
        $this->forge->createTable('diagnosa');
    }

    public function down()
    {
        //
        $this->forge->dropTable('diagnosa');
    }
}
