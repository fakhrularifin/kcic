<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Perdin extends Secure_area {
	public function index()
	{
		$this->load->view("inc/header");
		$this->load->view('perdin/car_book');
	}
	public function car_book()
	{
		$this->load->view("inc/header");
		$this->load->view('perdin/car_book');
	}
	public function car_approval()
	{
		$this->load->view("inc/header");
		$this->load->view('perdin/car_approval');
	}
	public function car_list()
	{
		$this->load->view("inc/header");
		$this->load->view('perdin/car_list');
		//if ($this->session->userdata('guid')==1004) { $this->load->view('perdin/car_list_admin'); }
	}
	
	public function get_all_perdin() {
		$email = $this->session->userdata('email');
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/perdin/getPerdin";
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
		//faqih_20200906: temporary for filter from json according to user logged
		//echo $this->mylib->curl_processor($param,$json_data);
		$json = $this->mylib->curl_processor($param,$json_data);
		$datas = json_decode($json);
		//$data = $datas->data;
		
		$filtered = array_filter($datas->data,	function ($filter) {
		$allowed  = $this->session->userdata('email');		
					return $filter->pengaju == $allowed;
					});
					$index = 2;
		foreach ($filtered as $key => $object) {
			   if ($key == $index) {
				  unset($filtered[$index]);
			   }
			}
		$result = array();
		array_push($result, $filtered);
		//print_r($result);
		echo json_encode($result);
	}
	public function get_perdin() {
		$email = $this->session->userdata('email');
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/perdin/getPerdin";
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
	public function get_mobil() {
		$email = $this->session->userdata('email');
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/mobil/getMobil";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,NULL);
	}
	public function post_mobil() {
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$url = $this->config->item('api_url')."/api/mobil/postMobil";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'merk'=> $this->input->post('merk'),
			'tipe'=> $this->input->post('tipe'),
			'platNo'=> $this->input->post('platNo'),
		);
		$this->load->library('mylib');
		$this->mylib->curl_processor($param,$json_data);
	}
	public function post_perdin() {
		$url = $this->config->item('api_url')."/api/perdin/postPerdin";
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
			'tujuan'=> $this->input->post('tujuan'),
			'tipeMobil'=> $this->input->post('tipe_mobil'),
			'hotel'=> $this->input->post('hotel'),
			'catatanDariUser'=> $this->input->post('catatan_dariuser')
		);
		//} else { $json_data = NULL; }
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	public function post_followup_perdin() {
		//$email = $this->session->userdata('email');
		$url = $this->config->item('api_url')."/api/perdin/postFollowUpPerdin";
		$token = $this->session->userdata('token');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
			
		//if(isset($_POST['idPerdin'])&&isset($_POST['status']))
		//{
			$id_perdin = $this->input->post('idPerdin');
			$id_mobil = $this->input->post('idMobil');
			$status = $this->input->post('status');
			$catatan = $this->input->post('catatanUntukUser');
		//}
		$json_data = array(
			'idPerdin'=> $id_perdin,
			'idMobil'=> $id_mobil,
			'status'=> $status,
			'catatan'=> $catatan
		);
		//var_dump($json_data);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
}

