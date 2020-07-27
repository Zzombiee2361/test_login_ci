<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_T_user extends CI_Migration {

	public function up() {
		$this->dbforge->add_field([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
				'unique' => true,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			],
			'no_telepon' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
			],
			'alamat' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'role_id' => [
				'type' => 'INT',
				'unsigned' => true,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('t_user');

		$this->db->insert('t_user', [
			'nama' => 'Admin',
			'email' => 'admin@localhost',
			'password' => '$2y$10$Wz//ZqsOx8Z68MNHEqGYPOgGh1ZZosaPvunSGYBZoN4NeJHT1J.Ia', // password
			'no_telepon' => '',
			'alamat' => '',
			'role_id' => 2,
		]);
	}

	public function down() {
		$this->dbforge->drop_table('t_user');
	}
}