<?php 
class Mylib {
	function curl_processor($param, $json_data) {
		$headers = array(
		'Content-Type: application/json',
		'userToken:'.$param['token']
		);
		$curl_handle = curl_init($param['url']); 
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $param['curl_timeout']);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $param['type']);
		if(isset($json_data)) {
			$payload = json_encode($json_data);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		} else {
			$json_data = NULL;
		}
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($curl_handle);
		//echo curl_getinfo($curl_handle) . '<br/>';
		//echo curl_errno($curl_handle) . '<br/>';
		//echo curl_error($curl_handle) . '<br/>';
		//var_dump($result);
		curl_close($curl_handle);
		$response = json_decode($result,true);
		//var_dump($response);
		//echo json_last_error() ;

		if(isset($response['message'])) {
			$toast = array(
			'message'=>$response['message'],
			'title'=>$response['status']
			);
			//print_r($toast);
		}
		return $result;
		//if($response['status']==200 && count($response['data'])!=0) {
		//	return $result;
		//	echo "asdasd";
		//} else {
			//show_alert('Login Gagal Periksa username dan kata sandi anda');
			//redirect(base_url('index.php'));
		//}
	}
	function curl_post($url,$json_data) {
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
	function curl_get($param) {
		//header('Content-Type: application/json');
		$headers = array(
		'Content-Type: application/json',
		'userToken:'.$param['token']
		);		
		$curl_handle = curl_init($param['url']); 
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $param['curl_timeout']);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $param['type']);
		//curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($curl_handle);
		//echo curl_getinfo($curl_handle) . '<br/>';
		//echo curl_errno($curl_handle) . '<br/>';
		//echo curl_error($curl_handle) . '<br/>';
		curl_close($curl_handle);
		$response = json_decode($result,true);
		//var_dump($response);
		//echo json_last_error() ;

		if(isset($response['message'])) {
			$toast = array(
			'message'=>$response['message'],
			'title'=>$response['status']
			);
		}
		echo $result;

	}
}