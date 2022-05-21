<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satuan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'u_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'u_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			]
		]);
		$this->forge->addKey('u_id', true);
		$this->forge->createTable('satuan');
	}

	public function down()
	{
		$this->forge->dropTable('satuan');
	}
}