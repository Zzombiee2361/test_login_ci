<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_M_role extends CI_Migration {

	public function up() {
		$this->dbforge->add_field([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'role' => [
				'type' => 'VARCHAR',
				'constraint' => 100,
			]
		]);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('m_role');

		$this->db->insert_batch('m_role', [
			['id' => 1, 'role' => 'User'],
			['id' => 2, 'role' => 'Admin'],
		]);
	}

	public function down() {
		$this->dbforge->drop_table('t_user');
	}
}