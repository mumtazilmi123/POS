<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'cs_code' => [
				'type' => 'int',
				'constraint' => '11',
				'auto_increment' => true,
			],
			'cs_name' => [
				'type' => 'varchar',
				'constraint' => '100',
				'null' => false
			],
			'cs_address' => [
				'type' => 'text'
			],
			'cs_phone' => [
				'type' => 'char', 'constraint' => '20'
			]
		]);

		$this->forge->addKey('cs_code', true);
		$this->forge->createTable('pelanggan');
	}

	public function down()
	{
		$this->forge->dropTable('pelanggan');
	}
}