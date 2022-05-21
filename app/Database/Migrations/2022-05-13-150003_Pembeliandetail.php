<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembeliandetail extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'detbeli_id' => [
				'type'		=> 'bigint',
				'constraint' => '11',
				'auto_increment' => true,
			],
			'detbeli_buy' => [
				'type'		=> 'char',
				'constraint' => '20',
			],
			'detbeli_barcode' => [
				'type'		=> 'char',
				'constraint' => '50',
			],
			'detbeli_hargabeli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'detbeli_hargajual' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'detbeli_jml' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'detbeli_subtotal' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			]
		]);

		$this->forge->addPrimaryKey('detbeli_id');
		$this->forge->addForeignKey('detbeli_buy', 'pembelian', 'buy_faktur', 'cascade');
		$this->forge->addForeignKey('detbeli_barcode', 'produk', 'idbarcode', 'cascade');
		$this->forge->createTable('pembelian_detail');
	}

	public function down()
	{
		$this->forge->dropTable('pembelian_detail');
	}
}