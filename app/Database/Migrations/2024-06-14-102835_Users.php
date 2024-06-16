<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 191
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

    }

    public function down()
    {
        // DROP TABLE IF EXISTS `table_name`.
        $this->forge->dropTable('users', true);
    }
}
