<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	//$this->load->helper('common');
	public function index()
	{
        if($this->session->userdata('token'))
		{
			redirect('dashboard');
		}else{
            $this->load->view("inc/header");
		    $this->load->view('main');
        }
		
	}
	public function logout(){
			$this->session->sess_destroy();
			redirect(base_url());
	}

	public function login() {
		$this->load->helper('common');
		$username = $this->input->post('sso-email');
		$password = $this->input->post('sso-password');
		
		$url = $this->config->item('api_url')."/api/auth/postLogin";

		$headers = array(
			'Content-Type: application/json'		
		);
		$json_data = array(
				'email' => $username,
				'password' => $password
			);
		$payload = json_encode($json_data);
		$curl_handle = curl_init(); 
		curl_setopt($curl_handle, CURLOPT_URL,$url);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl_handle);
		curl_close($curl_handle);
		$response = json_decode($result,true);
		//var_dump($response);
		//echo  json_last_error() ;
		if($response['status'] ==200) {
		if($response['data']['token']!='') {
			$data_session = array(
					'email' => $response['data']['mail'],
					'name' => $response['data']['firstName']." ".$response['data']['lastName'],
					'guid' => $response['data']['gidNumber'],
					'is_manager' => $response['data']['isManager'],
					'manager' => $response['data']['manager'],
					'token' => $response['data']['token']
					);
	 
			$this->session->set_userdata($data_session);
			redirect(base_url('dashboard'));
		} else {
			echo 'kosong';
		}
		} else {
			//show_alert('Login Gagal Periksa username dan kata sandi anda');
			redirect(base_url());
		}
	}
}

