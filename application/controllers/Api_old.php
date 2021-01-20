<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends CI_Controller{

  public function __construct(){
    parent::__construct();
  }
  public function login_check()
    {
	//$username = $this->input->post('sso-email');
	//$password = $this->input->post('sso-password');
	$username = 'abdullah.faqih@kcic.co.id';
    $password = 'test123';
	$url = $this->config->item('api_url')."/api/auth/postLogin";
	//$token = '0cff79adc0e25ccf691da2476661c274ccd7544d54ffb641c68f90b158b37b0f';
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
	curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
	//curl_setopt($curl_handle, CURLOPT_HEADER, 1);
	//curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ":" . $password);
	curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
	curl_setopt($curl_handle, CURLOPT_POST, 1);
	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($curl_handle);
	var_dump($result);
	curl_close($curl_handle);
	$response = json_decode($result,true);
	//var_dump($response);
	//echo  json_last_error() ;
	if($response['status'] ==200) {
	if($response['data']['token']!='') {
		$data_session = array(
				'uid' => $response['data']['uidNumber'],
				'name' => $response['data']['firstName']." ".$response['data']['lastName'],
				'token' => $response['data']['token']
				);
 
		$this->session->set_userdata($data_session);
	} else {
		echo 'kosong';
	}
	} else {
		echo 'invalid crendential';
	}
  }
  
	public function test_api() {
		$url = "api.pirantipandawa5.com:3099/api/surat/getSuratMasuk";
		$token = '0cff79adc0e25ccf691da2476661c274ccd7544d54ffb641c68f90b158b37b0f';
		$headers = array(
			'userToken:d985d095c1380139032c176ebeb3ffe0ec9b802d2102516b9181954b75275533',
			'Content-Type:application/json'
        	
    );
		$json_data = array(
			'penerima' => 'abdullah.faqih@kcic.co.id'
		);
		$payload = json_encode($json_data);
		$curl_handle = curl_init(); //your API url
		curl_setopt($curl_handle, CURLOPT_URL,$url);
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($curl_handle, CURLOPT_HEADER, 1);
		//curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
		curl_setopt($curl_handle, CURLOPT_POST, 1);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($curl_handle);
		curl_close($curl_handle);
		//print_r($result);
		$response = json_decode($result);
		print_r($response);
		//echo  json_last_error() ;
		//if($result) {print_r($result);} else {echo 'kosoong';}
	}
		
}