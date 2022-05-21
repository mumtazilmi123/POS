<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ctg_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'auto_increment' => true,
			],
			'ctg_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
            ],
			'ctg_brand'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			]
		]);
		$this->forge->addKey('ctg_id', true);
		$this->forge->createTable('kategori');
	}

	public function down()
	{
		$this->forge->dropTable('kategori');
	}
}