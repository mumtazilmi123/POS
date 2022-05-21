<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembelian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'buy_faktur' => [
				'type'		=> 'char',
				'constraint' => '20',
				'null'		=> false
			],
			'buy_tgl' => [
				'type'		=> 'date',
				'null'		=> false
			],
			'buy_jenisbayar' => [
				'type' => 'enum',
				'constraint' => ['T', 'K'],
				'default' => 'T'
			],
			'buy_supkode' => [
				'type' => 'int',
				'constraint' => '11',
			],
			'buy_discpersen' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'buy_discuang' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'buy_totalkotor' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'buy_totalbersih' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
		]);

		$this->forge->addPrimaryKey('buy_faktur');
		$this->forge->addForeignKey('buy_supkode', 'supplier', 'sup_kode', 'cascade');
		$this->forge->createTable('pembelian');
	}

	public function down()
	{
		$this->forge->dropTable('pembelian');
	}
}