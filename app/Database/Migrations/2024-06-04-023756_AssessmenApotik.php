<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AssessmenApotik extends Migration
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
            'assesmen_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total' => [
                'type'       => 'BIGINT',
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
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('assesmen_id', 'assesmen', 'id', 'CASCADE', 'CASCADE');
        // Create the table
        $this->forge->createTable('assesmen_apotik');
    }

    public function down()
    {
        //
        $this->forge->dropTable('assesmen_apotik');
    }
}
