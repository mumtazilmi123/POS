<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'sale_faktur' => [
				'type'		=> 'char',
				'constraint' => '20',
				'null'		=> false
			],
			'sale_tgl' => [
				'type'		=> 'date',
				'null'		=> false
			],
			'sale_cs' => [
				'type' => 'int',
				'constraint' => '11',
			],
			'sale_discpersen' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'sale_discuang' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'sale_totalkotor' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'sale_totalbersih' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			]
		]);

		$this->forge->addPrimaryKey('sale_faktur');
		$this->forge->addForeignKey('sale_cs', 'pelanggan', 'cs_code', 'cascade');
		$this->forge->createTable('penjualan');
	}

	public function down()
	{
		$this->forge->dropTable('penjualan');
	}
}