<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssessmenApotikDetail extends Migration
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
            'assesmen_apotik_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'obat_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'total' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default' => 0

            ],
            'catatan' => [
                'type'       => 'varchar',
                'constraint' => 255,
                'default' => ''
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
        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey('assesmen_apotik_id', 'assesmen_apotik', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('obat_id', 'obat', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('assesmen_apotik_detail');
    }

    public function down()
    {
        //
    }
}
