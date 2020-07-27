<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct([
			'template'		=> 'layouts/auth',
			'title'			=> 'Login',
			'disable_auth'	=> true,
		]);

		$this->load->model('m_auth');
	}

	public function index() {
		if(isset($_SESSION['user'])) {
			redirect('/');
		}

		$this->view('auth/login', [
			'page_js' => ['js/form-ajax.js', 'js/auth.js'],
		]);
	}

	public function auth() {
		if($this->m_auth->login()) {
			$this->json([
				'status' => 'success',
				'redirect' => base_url(),
				'redirectDelay' => 1,
			]);
		} else {
			$this->json([
				'status' => 'error',
				'errors' => [
					'password' => 'Email atau password salah'
				]
			], 400);
		}
	}

	public function logout() {
		if(isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		redirect('login');
	}
}