<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TindakanPelayananTable extends Migration
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
            'tindakan_id' => [
                'type'       => 'int',
                'constraint' => 11, // Set an appropriate constraint length
                'unsigned' => true
            ],
            'pelayanan_id' => [
                'type'       => 'int',
                'constraint' => 11, // Set an appropriate constraint length
                'unsigned' => true
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
        $this->forge->addForeignKey('pelayanan_id', 'pelayanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tindakan_id', 'diagnosa', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tindakan_pelayanan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tindakan_pelayanan');
    }
}
