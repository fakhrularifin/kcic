<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Dashboard extends Secure_area {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$this->load->view("inc/header");
		$this->load->view("dashboard/dashboard");
	}

}