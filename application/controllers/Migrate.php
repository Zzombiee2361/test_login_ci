<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('migration');
	}

	private function do_migration($version = null) {
		if($this->input->is_cli_request() && ENVIRONMENT === 'development') {
			if($version === null) {
				$migration = $this->migration->latest();
			} else {
				$migration = $this->migration->version($version);
			}

			if(!$migration) {
				echo $this->migration->error_string();
			} else {
				echo 'Migration(s) done'.PHP_EOL;
			}
		} else {
			show_error('You don\'t have permission for this action');;
		}
	}

	public function index() {
		$this->do_migration();
	}

	public function list() {
		$migrations = $this->migration->find_migrations();
		foreach ($migrations as $sq => $filename) {
			echo "[$sq] ". basename($filename) ."\n";
		}
	}

	public function reset() {
		$this->do_migration(0);
	}

	public function version($version) {
		$this->do_migration($version);
	}
 }