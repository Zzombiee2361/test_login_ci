<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	/**
	 * MY_Controller constructor
	 * @param array $options Controller options  
	 * 	$options = [  
	 * 		'template'		=> (string)	Template view. Default: "layouts/app",
	 * 		'title'			=> (string)	Page title. Default: "auth_daffa",
	 * 		'disable_auth'	=> (bool)	Disable auth check. Default: false,
	 * 	]
	 */
	public function __construct($options = []) {
		parent::__construct();

		$defaultOptions = [
			'template' => 'layouts/app',
			'title' => 'auth_daffa',
			'disable_auth' => false,
		];
		$options = array_merge($defaultOptions, $options);

		if(!isset($_SESSION['user']) && !$options['disable_auth']) {
			redirect('login');
		}

		$this->template = $options['template'];
		$this->view_data = [ // default view data loaded with template
			'page_title' => $options['title'],
		];
	}

	public function only_role($roles) {
		if(!is_array($roles)) $roles = [$roles];
		$usr_role = $_SESSION['user']->role_id;
		$search = array_search($usr_role, $roles);
		if($search === false) {
			redirect('/');
		}
	}

	private function parse_asset($type, $assets) {
		if(!is_array($assets)) {
			return $this->load->view($assets, [], true);
		}
		
		$view = '';
		foreach ($assets as $a) {
			$src = base_url('assets/' . $a);
			if($type === 'js') {
				$view .= "<script src='$src'></script>";
			} else {
				$view .= "<link rel='stylesheet' href='$src'></link>";
			}
		}
		return $view;
	}

	public function view($view, $vars = []) {
		if(isset($vars['page_js'])) {
			$vars['page_js'] = $this->parse_asset('js', $vars['page_js']);
		}
		if(isset($vars['page_css'])) {
			$vars['page_css'] = $this->parse_asset('css', $vars['page_css']);
		}

		$data = array_merge($this->view_data, $vars, ['page_content' => $view]);
		$this->load->view($this->template, $data);
	}

	public function json($vars, $status_code = 200) {
		http_response_code($status_code);
		header('Content-Type: application/json');
		echo json_encode($vars);
	}
}