<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secure_area extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        setlocale (LC_TIME, 'id_ID');
        
        if(!$this->session->userdata('token'))
		{
			redirect('auth');
		}
	}
}