<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Cuti extends Secure_area {
	public function index()
	{
		/* $this->load->view("inc/header");
		$this->load->view('cuti/cuti_list'); */
		$this->cuti_list();
	}
	public function cuti_new()
	{
		$this->load->view("inc/header");
		$this->load->view('cuti/cuti_new');
	}
	public function cuti_approval()
	{
		$this->load->view("inc/header");
		$this->load->view('cuti/cuti_approval');
	}
	public function cuti_list()
	{
		$this->load->view("inc/header");
		$this->load->view('cuti/cuti_list');
	}
	public function curl_post($url,$json_data) {
		//header('Content-Type: application/json');
		$token = $this->session->userdata('token');
		$headers = array(
        'Content-Type: application/json',
		'userToken:'.$token		
		);		
		$payload = json_encode($json_data);
		$curl_handle = curl_init($url); 
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($curl_handle);
		//var_dump($result);
		echo curl_getinfo($curl_handle) . '<br/>';
		echo curl_errno($curl_handle) . '<br/>';
		echo curl_error($curl_handle) . '<br/>';
		curl_close($curl_handle);
		$response = json_decode($result,true);
		//var_dump($response);
		//echo  json_last_error() ;

		if(isset($response['message'])) {
			$toast = array(
			'message'=>$response['message'],
			'title'=>$response['status']
			);
			//print_r($toast);
		}
		echo $result;
		//if($response['status']==200 && count($response['data'])!=0) {
		//	return $result;
		//	echo "asdasd";
		//} else {
			//show_alert('Login Gagal Periksa username dan kata sandi anda');
			//redirect(base_url('index.php'));
		//}
	}
	public function get_pengajuan_cuti() {
		$email = $this->session->userdata('email');
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/cuti/getPengajuanCuti";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'offset'=> 0
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	public function get_cuti_user() {
		$email = $this->session->userdata('email');
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/cuti/getPengajuanCutiUser";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'pengaju'=> $email
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	public function post_pengajuan_cuti() {
		$url = $this->config->item('api_url')."/api/cuti/postPengajuanCuti";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');

		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		//$this->form_validation->set_rules('tanggal_mulai','tanggal','required|min_length[5]|max_length[255]');
		//if ($this->form_validation->run()==true) {
		$json_data = array(
			'pengaju'=> $email,
			'tanggalMulai'=> $this->input->post('tanggal_mulai'),
			'tanggalAkhir'=> $this->input->post('tanggal_akhir'),
			'tipe'=> $this->input->post('tipe'),
			'jenis'=> $this->input->post('jenis'),
			'alasan'=> $this->input->post('alasan')
		);
		//} else { $json_data = NULL; }
		
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	public function post_followup_cuti() {
		$url = $this->config->item('api_url')."/api/cuti/postFollowUpPengajuanCuti";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$id_cuti = $_POST['idCuti'];
		$status = strtoupper($_POST['status']);
		
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
			
		$json_data = array(
			'idCuti'=> $id_cuti,
			'status'=> $status
		);

		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
}

