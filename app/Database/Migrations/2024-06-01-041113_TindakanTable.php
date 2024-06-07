<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TindakanTable extends Migration
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
            'kode_tindakan' => [
                'type'       => 'varchar',
                'constraint' => 11,
            ],
            'tindakan' => [
                'type' => 'varchar',
                'constraint' => 200,
            ],
            'tarif' => [
                'type' => 'bigint',
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
        $this->forge->createTable('tindakan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tindakan');
    }
}
