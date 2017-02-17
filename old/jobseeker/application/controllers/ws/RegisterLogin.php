<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of ws_global
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class RegisterLogin extends  CI_Controller {

    public function RegisterLogin() {

        parent::__construct();
        $this->load->model('ws/registerlogin_model', 'registermodel');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    function Register($data, $type) {

        if (strtolower($type) == 'regist') {
            $verification = $this->Verifikasi($data);
            $dataverifikasi = array(
                "telp" => $data['no_telp'],
                "kode_verify" => $verification,
                "create_date" => date("d-m-Y h:i:sa"),
                "modified_date" => date("Y-m-d h:i:sa"),
            );

            $insertverivikasi = $this->registermodel->InsertVerifikasi($dataverifikasi, 'temp_verifikasi');


            if ($insertverivikasi != '11') {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message($insertverivikasi);
                $status = "0";
            }

           

            $databalikan = array(
                "data" => array(
                    "kode_verifikasi" => $verification
                ),
                "message" => $msg,
                "status" => $status
            );
        } else if (strtolower($type) == 'verify') {

            $syarat = array(
                "telp" => $data['no_telp'],
                "kode_verify" => $data['password']
            );
            $chekverify = $this->globalmodel->getRecordWithCondition('temp_verifikasi',$syarat);
            if (sizeof($chekverify) > 0) {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('12');
                $status = "0";
            }
            
             //merchant list belum 
        } else {
            $datauser = array(
                "fnama" => $data['nama'],
                "fno_telp" => $data['no_telp'],
                "fdeleted" => '0',
                "status" => $data['status'],
                "create_by" => $data['nama'],
                "create_date" => date("Y-m-d h:i:sa"),
                "modified_by" => $data['picture'],
                "modified_date" => date("Y-m-d h:i:sa"),
            );
            $saveuser = $this->registermodel->SaveRegister($datauser, 'tuser');

            $cond = array();
            $cheklevel = getRecordWithCondition('lu_level', $cond);
            $datalogin = array(
                'userid' => $saveuser,
                "username" => $data['username'],
                "password" => md5($data['password']),
                "levelid" => $cheklevel['_id'],
                "create_by" => $data['nama'],
                "create_date" => date("d-m-Y h:i:sa", $data['date']),
                "modified_by" => $data['picture'],
                "modified_date" => date("d-m-Y h:i:sa", $data['date']),
            );
            $savelogin = $this->registermodel->insertToDatabase('tlogin', $datauser);

            if ($insertverivikasi != '10') {
                $msg = $this->globalmodel->Message($savelogin);
                $status = "0";
            } else {
                $msg = $this->globalmodel->Message($savelogin);
                $status = "0";
            }

            $databalikan = array(
                "data" => array(),
                "message" => $msg,
                "status" => $status
            );
        }




        return json_encode($databalikan);
//        $getallmarket = $this->shopmodel->getallmarket($data);
    }

    function Login($data) {

        $syarat = array(
            "username" => $data['username'],
            "password" => $data['password']
        );
        $chekLogin = $this->registermodel->ChekLogin($syarat);
        if (sizeof($chekLogin) > 0) {
            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('12');
            $status = "0";
        }
        $databalikan = array(
            "data" => array(),
            "message" => $msg,
            "status" => $status
        );

        return json_encode($databalikan);
    }

    function Verifikasi($data) {

        $rand = rand(10000, 100000);


        $pesan = "Your boleci verification : " . $rand . " ";
        $telp = $data['no_telp'];
        $dataPush = array(
            'sms_create' => 'true',
            'pesan' => $pesan,
            'no_hp' => $telp
                );
        
        
        $this->globalmodel->sms_gateway("http://118.98.22.90:13013/cgi-bin/sendsms?username=jbgrosir&password=jbgrosir123&to=" .
                $dataPush['no_hp'] . "&text=" . $dataPush['pesan'], $dataPush);
        return $rand;
    }

//put your code here
}
