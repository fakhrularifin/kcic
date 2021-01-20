<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Surat extends Secure_area {
	public function index()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/inbox');
	}
	public function inbox()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/inbox');
	}
	public function outbox()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/outbox');
	}
	public function check_list()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/check_list');
	}
	public function arsip_new()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/arsip_new');
	}
	public function test()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/test');
	}
	public function read()
	{	//echo "surat id =". $this->uri->segment(3);
		//$data['id'] = $this->uri->segment(3);
		$this->load->view("inc/header");
		$this->load->view('surat/read');
		
		
		/*$uri->getSegment(3, 'foo');
		$url = $this->config->item('api_url')."/api/surat/getSuratMasuk";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'penerima'=> $email,
			'offset'=> 0
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);*/
	}
	public function disposisi()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/disposisi');
	}
	public function disposisi_sum()
	{
		$this->load->view("inc/header");
		$this->load->view('surat/disposisi_sum');
	}
	public function get_surat_masuk_old() {
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
	
		$url = $this->config->item('api_url')."/api/surat/getSuratMasuk";
		$headers = array(
        'Content-Type: application/json',
		'userToken:'.$token,'Content-Type: application/json'		
		);
		
		$json_data = array(
			'penerima' => $email
		);
		
		$payload = json_encode($json_data);
		$curl_handle = curl_init($url); //your API url
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($curl_handle);
		var_dump($result);
		curl_close($curl_handle);
		$response = json_decode($result,true);
		//var_dump($response);
		//echo  json_last_error() ;
	
		if($response['status']==200) {
			return $result;
		} else {
			//show_alert('Login Gagal Periksa username dan kata sandi anda');
			//redirect(base_url('index.php'));
			//echo 'response bukan 200';
		}
	}
	public function curl_post($url,$json_data) {
		//header('Content-Type: application/json');
		$token = $this->session->userdata('token');
		$manager = $this->session->userdata('manager');
		$is_manager = $this->session->userdata('is_manager');
		$headers = array(
        'Content-Type: application/json',
		'userToken:'.$token,
		'isManager:'.$is_manager,
		'manager:'.$manager
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
	public function curl_formdata($url,$token,$form_data) {
		$headers = array(
        'Content-Type: application/form-data',
		'userToken:'.$token		
		);		
		$payload = $form_data;
		$curl_handle = curl_init($url); 
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
		//curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($curl_handle);
		//var_dump($result);
		curl_close($curl_handle);
		$response = json_decode($result,true);
		var_dump($response);
		//echo  json_last_error() ;
		if(isset($response['message'])) {
			$toast = $response['message'];
		}
		if($response['status']==200 && count($response['data'])!=0) {
			return $result;
		} else {
			//show_alert('Login Gagal Periksa username dan kata sandi anda');
			//redirect(base_url('index.php'));
		}
	}
	public function get_list_user() {
		$url = $this->config->item('api_url')."/api/user/getListUser";
		$token = $this->session->userdata('token');
		//$query = 'bayu';
		//$query = $this->input->post('search');
		$query = "@kcic.co.id";
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'query'=> $query
		);
		$this->load->library('mylib');
		$data = json_decode($this->mylib->curl_processor($param,$json_data));
		//var_dump($data);
		//$search_result = array_column($data->data, 'email');
		$users = $data->data;
		$new =array();
		foreach ($users as $user) {
			$new[]['id'] = $user->email;
			$new[]['name'] = $user->name;
			//echo $user['email']."<br>";
			//$new['id'] = $user['email'];
			//$new['name'] = $user['name'];
		}
		//var_dump ($new);
		echo json_encode($new);
	}
	public function get_list_email() {
		$url = $this->config->item('api_url')."/api/user/getListUser";
		$token = $this->session->userdata('token');
		//$query = 'bayu';
		$query = $this->input->post('search');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'query'=> $query
		);
		$this->load->library('mylib');
		$data = json_decode($this->mylib->curl_processor($param,$json_data));
		$search_result = array_column($data->data, 'email');
		//var_dump ($search_result);
		echo json_encode($search_result);
	}
	public function get_surat_masuk() {
		$url = $this->config->item('api_url')."/api/surat/getSuratMasuk";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'penerima'=> $email,
			'offset'=> 0
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	
	public function get_surat_diperiksa() {
		$url = $this->config->item('api_url')."/api/surat/getSuratHarusDiperiksa";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'pemeriksa'=> $email
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	
	public function get_surat_keluar() {
		$url = $this->config->item('api_url')."/api/surat/getSuratKeluar";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'pengirim'=> $email
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	
	public function get_surat_detail() {
		$id_surat = $this->input->post('idSurat');
		//$id_surat = 2;
		$url = $this->config->item('api_url')."/api/surat/getSuratDetail";
		$token = $this->session->userdata('token');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'idSurat' => $id_surat
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);	
	}
	public function get_surat_no() {
		$id_surat = $this->input->get('idSurat');
		//$id_surat = 2;
		$url = $this->config->item('api_url')."/api/surat/getSuratDetail";
		$token = $this->session->userdata('token');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'idSurat' => $id_surat
		);
		$this->load->library('mylib');
		//echo $this->mylib->curl_processor($param,$json_data);
		$data = $this->mylib->curl_processor($param,$json_data);
		echo $data;
		//$data = json_decode($this->mylib->curl_processor($param,$json_data));
		//print_r( $data->data);
		//var_dump($data->data);
		//$search_result = array_column($data->data, 'nomorSurat');
		
		//echo json_encode($data->data);
	}
	public function update_status_surat() {
		$email = $this->session->userdata('email');
		$url = $this->config->item('api_url')."/api/surat/postUpdateStatusSurat";
		
		$json_data = array(
			'penerima' => $email,
			'idSurat' => $id_surat,
			'status' => 'READ',
		);
		$this->curl_post($url, $json_data);
	}
	
	public function post_nota_revisi() {
		$id_surat = $this->input->post('idSurat');
		$memo = $this->input->post('memo');
		$pengirim = $this->input->post('pengirim');
		$penerima = $this->input->post('penerima');
		//$url = $this->config->item('api_url')."/api/surat/postNotaPerbaikanSurat";
		$url = $this->config->item('api_url')."/api/surat/postNotaRevisiSurat";
		$json_data = array(
			'idSurat' => $id_surat,
			'pengirim' => $pengirim,
			'penerima' => $penerima,
			'memo' => $memo,
		);
		$this->curl_post($url, $json_data);
	}
	public function post_update_approval() {
		$id_surat = $this->input->post('idSurat');
		$status = $this->input->post('status');
		//$url = $this->config->item('api_url')."/api/surat/postUpdateStatusDisetujuiSurat";
		$url = $this->config->item('api_url')."/api/surat/postUpdateApprovalSurat";
		$json_data = array(
			'idSurat' => $id_surat,
			'status' => $status,
		);
		$this->curl_post($url, $json_data);
	}	
	public function post_update_dibaca() {
		$email = $this->session->userdata('email');
		$id_surat = $this->input->post('idSurat');
		$status = $this->input->post('status');
		$url = $this->config->item('api_url')."/api/surat/postUpdateStatusDibacaSurat";
		
		$json_data = array(
			'idSurat' => $id_surat,
			'penerima' => $email,
			'status' => $status,
		);
		$this->curl_post($url, $json_data);
	}	

	public function post_balasan_disposisi() {
		$id_disposisi = $this->input->post('idDisposisi');
		$memo = $this->input->post('memo');
		$url = $this->config->item('api_url')."/api/surat/postBalasanDisposisi";
		$json_data = array(
			'idDisposisi' => $this->input->post('id_disposisi'),
			'pengirim' => $email,
			'penerima' => $this->input->post('penerima'),
			'penerimaCc' => $this->input->post('penerima_cc'),
			'memo' => $this->input->post('memo')
		);
		$this->curl_post($url, $json_data);
	}
	
	public function get_disposisi_summary() {
		$id_surat = $this->input->post('idSurat');
		//$id_surat = 2;
		$url = $this->config->item('api_url')."/api/surat/getDisposisiSummary";
		$token = $this->session->userdata('token');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'idSurat' => $id_surat
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);	
	}
	
	public function post_surat() {
		//$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$url = $this->config->item('api_url')."/api/surat/postSurat";
		/*$gid = $this->session->userdata('guid');
		$uid = $this->session->userdata('uid');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout'),
			'gidNumber'=> $gid,
			'uidNumber'=> $uid
			);*/
			
		$json_data = array(
			'nomorSurat' => $this->input->post('nomor_surat'),
			'jenisSurat' => $this->input->post('jenis_surat'),
			'pengirim' => $email,
			'penerima' => $this->input->post('penerima'),
			'penerimaCc' => $this->input->post('penerima_cc'),
			'tanggalSurat' => $this->input->post('tanggal_surat'),
			'tanggalTerimaSurat' => $this->input->post('tanggal_terima_surat'),
			'perihal' => $this->input->post('perihal'),
			'sifat' => $this->input->post('sifat'),
			'rujukan' => $this->input->post('rujukan'),
			'memo' => $this->input->post('memo'),
			'lampiran' => $this->input->post('lampiran'),
			'attachments' => $this->input->post('attachments')

		);
		$this->curl_post($url, $json_data);

		//$this->load->library('mylib');
		//echo $this->mylib->curl_processor($param,$json_data);	
		
	}
	public function post_disposisi() {
		//$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$url = $this->config->item('api_url')."/api/surat/postSurat";			
		$json_data = array(
			'idSuratRef' => $this->input->post('id_ref_disposisi'),
			'nomorSurat' => $this->input->post('nomor_surat'),
			'jenisSurat' => 'DISPOSISI',
			'pengirim' => $email,
			'penerima' => $this->input->post('penerima_disposisi'),
			'penerimaCc' => $this->input->post('penerima_cc'),
			'tanggalSurat' => $this->input->post('tanggal_surat'),
			'tanggalTerimaSurat' => $this->input->post('tanggal_terima_surat'),
			'perihal' => $this->input->post('perihal'),
			'sifat' => $this->input->post('sifat'),
			'rujukan' => $this->input->post('rujukan'),
			'memo' => $this->input->post('memo'),
			'lampiran' => $this->input->post('lampiran'),
			'attachments' => $this->input->post('attachments')

		);
		$this->curl_post($url, $json_data);

		//$this->load->library('mylib');
		//echo $this->mylib->curl_processor($param,$json_data);	
		
	}
	public function post_revisi_surat() {
		$id_surat = $this->input->post('idSurat');
		$memo = $this->input->post('memo');
		$url = $this->config->item('api_url')."/api/surat/postRevisiSurat";
		$json_data = array(
			'nomorSurat' => $this->input->post('nomor_surat'),
			'jenisSurat' => $this->input->post('jenis_surat'),
			'pengirim' => $email,
			'penerima' => $this->input->post('penerima'),
			'penerimaCc' => $this->input->post('penerima_cc'),
			'tanggalSurat' => $this->input->post('tanggal_surat'),
			'perihal' => $this->input->post('perihal'),
			'sifat' => $this->input->post('sifat'),
			'rujukan' => $this->input->post('rujukan'),
			'memo' => $this->input->post('memo'),
			'lampiran' => $this->input->post('lampiran')
			//'attachments' => <multiple files>
		);
		$this->curl_post($url, $json_data);
	}
	
}

