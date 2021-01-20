<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->url = $this->config->item('api_url');
	}

    private function curl($urlExt, $headers, $payload){
        $curl_handle = curl_init(); 
        curl_setopt($curl_handle, CURLOPT_URL,$this->url.$urlExt);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->config->item('curl_timeout'));
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($curl_handle);
        return $result;
    }

	public function postLogin(){
        $urlExt = '/api/auth/postLogin';
        $headers = ['Content-Type: application/json'];
        $payload = json_encode([
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ]);
        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function getSuratMasuk(){
        $urlExt = '/api/surat/getSuratMasuk';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];
        $payload = json_encode([
            'penerima' => $this->input->post('penerima'),
            'offset' => intval($this->input->post('offset'))
        ]);
        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }

    public function getSuratKeluar(){
        $urlExt = '/api/surat/getSuratKeluar';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];
        $payload = json_encode([
            'pengirim' => $this->input->post('pengirim')
        ]);
        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function postUpdateApprovalSurat(){
        $urlExt = '/api/surat/postUpdateApprovalSurat';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];
        $payload = json_encode([
            'idSurat' => $this->input->post('idSurat'),
            'status' => $this->input->post('status')
        ]);
        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function postBalasanDisposisi(){
        $urlExt = '/api/surat/postBalasanDisposisi';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];

        $payload = json_encode([
            'idSurat' => $this->input->post('idSurat'),
            'pengirim' => $this->input->post('pengirim'),
            'penerima' => $this->input->post('penerima'),
            'penerimaCc' => $this->input->post('penerimaCc'),
            'memo' => $this->input->post('memo'),
        ]);
        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function getSuratDetail(){
        $urlExt = '/api/surat/getSuratDetail';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];

        $payload = json_encode([
            'idSurat' => $this->input->post('idSurat')
        ]);
        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function postUpdateStatusDibacaSurat(){
        $urlExt = '/api/surat/postUpdateStatusDibacaSurat';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];

        $payload = json_encode([
            'idSurat' => $this->input->post('idSurat'),
            'penerima' => $this->input->post('penerima'),
            'status' => $this->input->post('status'),
        ]);

        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function postNotaRevisiSurat(){
        $urlExt = '/api/surat/postNotaRevisiSurat';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];

        $payload = json_encode([
            'idSurat' => $this->input->post('idSuratRef'),
            'pengirim' => $this->input->post('pengirim'),
            'penerima' => $this->input->post('penerima'),
            'memo' => $this->input->post('memo'),
        ]);

        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }

    public function getDisposisiSummary(){
        $urlExt = '/api/surat/getDisposisiSummary';
        $headers = [
            'Content-Type: application/json',
            'userToken: '.$this->input->post('token')
        ];

        $payload = json_encode([
            'idSurat' => $this->input->post('idSuratRef'),
        ]);

        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function postSurat(){
        $urlExt = '/api/surat/postSurat';
        $headers = [
            'Content-type: multipart/form-data',
            'userToken: '.$this->input->post('token'),
            'isManager: '.$this->input->post('isManager'),
            'manager: '.$this->input->post('manager')
        ];

        $payload = [
            'nomorSurat' => $this->input->post('nomorSurat'),
            'lampiran' => $this->input->post('lampiran'),
            'jenisSurat' => $this->input->post('jenisSurat'),
            'pengirim' => $this->input->post('pengirim'),
            'penerima' => $this->input->post('penerima'),
            'penerimaCc' => $this->input->post('penerimaCc'),
            'tanggalTerimaSurat' => $this->input->post('tanggalTerimaSurat'),
            'perihal' => $this->input->post('perihal'),
            'sifat' => $this->input->post('sifat'),
            'rujukan' => $this->input->post('rujukan'),
            'memo' => $this->input->post('memo')
        ];

        $files = $_FILES['attachments'];

        if($files['size'] > 0){
            $payload['attachments'] = new CURLFile($files['tmp_name'], $files['type'], $files['name']); 
        }

        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
    }
    
    public function postRevisiSurat(){
        $urlExt = '/api/surat/postRevisiSurat';
        $headers = [
            'Content-type: multipart/form-data',
            'userToken: '.$this->input->post('token')
        ];

        $payload = [
            'idSurat' => $this->input->post('idSurat'),
            'nomorSurat' => $this->input->post('nomorSurat'),
            'lampiran' => $this->input->post('lampiran'),
            'jenisSurat' => $this->input->post('jenisSurat'),
            'pengirim' => $this->input->post('pengirim'),
            'penerima' => $this->input->post('penerima'),
            'penerimaCc' => $this->input->post('penerimaCc'),
            'tanggalTerimaSurat' => $this->input->post('tanggalTerimaSurat'),
            'perihal' => $this->input->post('perihal'),
            'sifat' => $this->input->post('sifat'),
            'rujukan' => $this->input->post('rujukan'),
            'memo' => $this->input->post('memo'),
        ];

        $files = $_FILES['attachments'];

        if($files['size'] > 0){
            $payload['attachments'] = new CURLFile($files['tmp_name'], $files['type'], $files['name']); 
        }

        $resp = $this->curl($urlExt, $headers, $payload);
        echo $resp;
	}
}
