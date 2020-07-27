<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function list_user() {
		return $this->db
			->select('id, nama, email, no_telepon, alamat, role_id')
			->from('t_user')
			->get()->result();
	}

	public function store() {
		$data = [
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'no_telepon' => $this->input->post('no_telepon', ''),
			'alamat' => $this->input->post('alamat', ''),
			'role_id' => $this->input->post('role_id'),
		];

		$id = $this->input->post('id');
		if($id) {
			return $this->db->update('t_user', $data, ['id' => $id]);
		}

		return $this->db->insert('t_user', $data);
	}

	public function destroy() {
		$id = $this->input->post('id');
		return $this->db->delete('t_user', ['id' => $id]);
	}
}