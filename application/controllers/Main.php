<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Main extends Secure_area {
	//$this->load->helper('common');
	public function index()
	{

		if($this->session->userdata('token'))
		{
			redirect('dashboard');
		}else{
            redirect('auth');
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
			//redirect(base_url());
		//}
	}
	public function get_overview() {
		$url = $this->config->item('api_url')."/api/overview/getOverview";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'user'=> $email
		);
		$this->load->library('mylib');
		//$data_array = json_decode($this->mylib->curl_processor($param,$json_data));
		//$data_array = $this->mylib->curl_processor($param,$json_data);
		//return($data_array->data);
		echo $this->mylib->curl_processor($param,$json_data);
	}
	
	public function get_count_surat_masuk() {
		$url = $this->config->item('api_url')."/api/surat/getCountSuratMasuk";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'penerima'=> $email
		);
		$this->load->library('mylib');
		$data_array = json_decode($this->mylib->curl_processor($param,$json_data));
		return $data_array->data;	
		}
	
		public function get_count_surat_keluar() {
		$url = $this->config->item('api_url')."/api/surat/getCountSuratKeluar";
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
		$data_array = json_decode($this->mylib->curl_processor($param,$json_data));
		return $data_array->data;
	}
	
	public function get_count_mobil_tersedia() {
		$url = $this->config->item('api_url')."/api/mobil/getCountMobilTersedia";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$this->load->library('mylib');
		$data_array = json_decode($this->mylib->curl_processor($param,NULL));
		return $data_array->data;
	}
	public function get_count_ruang_rapat_tersedia() {
		$url = $this->config->item('api_url')."/api/ruangRapat/getCountRuangRapatTersedia";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "GET",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$this->load->library('mylib');
		$data_array = json_decode($this->mylib->curl_processor($param,NULL));
		return $data_array->data;
	}
	public function get_all_count(){
		$data = $this->get_overview();
		//print_r($data);
		//echo $data->suratMasuk;
		$data_array = array(
			'count_ruang_rapat_tersedia' => $data->ruangRapatTersedia,
			'count_surat_masuk' => $data->suratMasuk,
			'count_surat_keluar' => $data->suratKeluar,
			'count_mobil_tersedia' => $data->mobilTersedia,
			'count_jadwal_rapat_hari_ini' => $data->jadwalRapatHariIni,
			'count_pengajuan_cuti_user' => $data->pengajuanCutiUser
		);
		echo json_encode ($data_array);
	}	
	public function get_mac(){
		$_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
		echo $_IP_ADDRESS."<br>";
		$_PERINTAH = "arp -a $_IP_ADDRESS";
		ob_start();
		system($_PERINTAH);
		$_HASIL = ob_get_contents();
		ob_clean();
		$_PECAH = strstr($_HASIL, $_IP_ADDRESS);
		$_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
		$_HASIL = substr($_PECAH_STRING[1], 0, 17);
		echo "IP Anda : ".$_IP_ADDRESS."
		MAC ADDRESS Anda : ".$_HASIL;
	}
	public function generate_mac($input, $strength = 12) {
			$input_length = strlen($input);
			$random_string = '';
			for($i = 0; $i < $strength; $i++) {
				$random_character = $input[mt_rand(0, $input_length - 1)];
				$random_string .= $random_character;
			}
			return $random_string;
	}
	public function post_presensi() {
		$permitted_chars = '0123456789ABCDEF';
		$email = $this->session->userdata('email');
		$url = $this->config->item('api_url')."/api/presensi/postPresensi";		
		//$mac = "f0-b4-d2-81-5d-aa";
		$mac =	$this->generate_mac($permitted_chars, 12);
		$json_data = array(
			'email' => $email,
			'macAddress' => $mac
		);
		$this->curl_post($url, $json_data);
	}
 
	public function get_presensi_today() {
		$url = $this->config->item('api_url')."/api/presensi/getPresensiHariIni";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'email'=> $email
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
	public function get_presensi() {
		$url = $this->config->item('api_url')."/api/presensi/getPresensiHariIni";
		$token = $this->session->userdata('token');
		$email = $this->session->userdata('email');
		$param = array(
			'url'=> $url,
			'token'=> $token,
			'type'=> "POST",
			'curl_timeout'=> $this->config->item('curl_timeout')
			);
		$json_data = array(
			'email'=> $email
		);
		$this->load->library('mylib');
		echo $this->mylib->curl_processor($param,$json_data);
	}
}

