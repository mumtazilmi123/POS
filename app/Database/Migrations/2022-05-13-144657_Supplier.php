<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'sup_code' => [
				'type' => 'int',
				'constraint' => '11',
				'auto_increment' => true,
			],
			'sup_name' => [
				'type' => 'varchar',
				'constraint' => '100',
				'null' => false
			],
			'sup_address' => [
				'type' => 'text'
			],
			'sup_phone' => [
				'type' => 'char', 'constraint' => '20'
			]
		]);

		$this->forge->addKey('sup_code', true);
		$this->forge->createTable('supplier');
	}

	public function down()
	{
		$this->forge->dropTable('supplier');
	}
}