<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'idbarcode'          => [
				'type'           => 'char',
				'constraint'     => '50',
			],
			'pr_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'pr_uid' => [
				'type' => 'int',
				'constraint' => '11'
			],
			'pr_ctgid' => [
				'type' => 'int',
				'constraint' => '11'
			],
			'readystock' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'harga_beli' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			],
			'harga_jual' => [
				'type' => 'double',
				'constraint' => '11,2',
				'default' => 0.00
			]
		]);
		$this->forge->addKey('idbarcode', true);
		$this->forge->addForeignKey('pr_uid', 'satuan', 'u_id', 'cascade');
		$this->forge->addForeignKey('pr_ctgid', 'kategori', 'ctg_id', 'cascade');
		$this->forge->createTable('produk');
	}

	public function down()
	{
		$this->forge->dropTable('produk');
	}
}