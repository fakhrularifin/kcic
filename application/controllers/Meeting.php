<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Meeting extends Secure_area {
	public function index()
	{
		$this->load->view("inc/header");
		$this->load->view('meeting/meeting_list');
	}
	public function meeting_list()
	{
		$this->load->view("inc/header");
		$this->load->view('meeting/meeting_list');
	}
	public function room_list()
	{
		$this->load->view("inc/header");
		$this->load->view('meeting/room_list');
	}
	public function room_book()
	{
		$this->load->view("inc/header");
		$this->load->view('meeting/room_book');
	}
	public function room_approval()
	{
		$this->load->view("inc/header");
		$this->load->view('meeting/room_approval');
	}
	
	public function get_jadwal_ruang_rapat() {
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/ruangRapat/getJadwalRuangRapat";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);

		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,NULL);
	}
	public function get_ruang_rapat() {
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/ruangRapat/getRuangRapat";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);

		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,NULL);
	}
	public function get_current_jadwal() {
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/ruangRapat/getCurrentJadwalRuangRapat";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);

		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,NULL);
	}
	
	public function get_pengajuan_jadwal() {
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/ruangRapat/getPengajuanJadwalRuangRapat";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);

		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,NULL);
	}
	
	public function get_detail_jadwal() {
		$token = $this->session->userdata('token');
		$url = $this->config->item("api_url")."/api/ruangRapat/getDetailJadwalRuangRapat";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'idRuangRapat'=> $this->input->post('idRuangRapat'),
			'tanggal'=> $this->input->post('tanggal')
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	
	public function post_ruang_rapat() {
		$url = $this->config->item('api_url')."/api/ruangRapat/postRuangRapat";
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
			'nama'=> $this->input->post('nama'),
			'lokasi'=> $this->input->post('lokasi')
		);
		//} else { $json_data = NULL; }
		$this->load->library('mylib');
		$this->mylib->curl_processor($param,$json_data);
	}
	public function post_pengajuan_jadwal() {
		$url = $this->config->item('api_url')."/api/ruangRapat/postPengajuanJadwalRuangRapat";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		if (null !==($this->input->post('makan_siang'))) { $makan_siang = $this->input->post('makan_siang'); } else { $makan_siang = "N";}
		if (null !==($this->input->post('akun_zoom'))) { $akun_zoom = $this->input->post('akun_zoom'); } else { $akun_zoom = "N";}
		if (null !==($this->input->post('video_conf'))) { $video_conf = $this->input->post('video_conf'); } else { $video_conf = "N";}
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		//$this->form_validation->set_rules('tanggal_mulai','tanggal','required|min_length[5]|max_length[255]');
		//if ($this->form_validation->run()==true) {
		$json_data = array(
			'idRuangRapat' => $this->input->post('id_ruang_rapat'),
			'user' => $email,
			'tanggal' => $this->input->post('tanggal'),
			'jamMulai' => $this->input->post('jam_mulai'),
			'jamAkhir' => $this->input->post('jam_akhir'),
			'peserta' => $this->input->post('peserta'),
			'makanSiang' => $makan_siang,
			'akunZoom' => $akun_zoom,
			'videoConf' => $video_conf,
			'requestTamu' => $this->input->post('request_tamu')

		);
		//} else { $json_data = NULL; }
		$this->load->library('mylib');
		$this->mylib->curl_processor($param,$json_data);
	}
	
	public function post_update_status_jadwal() {
		$url = $this->config->item('api_url')."/api/ruangRapat/postUpdateStatusJadwalRuangRapat";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$id = $_POST['id'];
		$status = strtoupper($_POST['status']);
		
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
			
		$json_data = array(
			'idJadwalRuangRapat'=> $id,
			'status'=> $status,
			'alasanTidakDisetujui' => "test"
		);

		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	
}

