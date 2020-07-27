<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() {
		parent::__construct(['title' => 'Home']);
		$this->only_role(2);
		$this->load->model('m_user');
	}

	public function index() {
		$result_roles = $this->db->get('m_role')->result();
		$roles = [];
		foreach ($result_roles as $role) {
			$roles[$role->id] = $role->role;
		}
		$this->view('user/index', [
			'page_css' => ['lib/mdb/css/addons/datatables.min.css'],
			'page_js' => ['lib/mdb/js/addons/datatables.min.js', 'js/form-ajax.js', 'js/user.js'],
			'roles' => $roles,
		]);
	}

	public function table() {
		$users = $this->m_user->list_user();
		$this->json(['data' => $users]);
	}

	private function validate() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[t_user.email]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('role_id', 'Role', 'required|numeric');

		if($this->form_validation->run() === false) {
			return [
				'status' => 'error',
				'errors' => $this->form_validation->error_array(),
			];
		}

		return true;
	}

	public function store() {
		$validation = $this->validate();
		if($validation !== true) {
			$this->json($validation, 422);
			return;
		}

		if($this->m_user->store()) {
			$this->json(['status' => 'success']);
		} else {
			$this->json([
				'status' => 'error',
				'message' => 'Something went wrong',
			], 500);
		}
	}

	public function destroy() {
		if($this->m_user->destroy()) {
			$this->json(['status' => 'success']);
		} else {
			$this->json([
				'status' => 'error',
				'message' => 'Something went wrong',
			], 500);
		}
	}
}