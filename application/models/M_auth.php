<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('t_user', ['email' => $email])->row();

		if($user) {
			$check_password = password_verify($password, $user->password);
			if($check_password) {
				$_SESSION['user'] = $user;
				return true;
			}
		}

		return false;
	}
}