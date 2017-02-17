<?php

/**
 * Description of registerlogin_model
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class registerlogin_model extends CI_Model {

    function ws_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    function ChekUSer($data) {
        $balikan = array();
        $cond = array(
            'username' => $data['username'],
        );
        $coll = 'tlogin';
        $chekuser = $this->globalmodel->getOneRecordWithCond($cond, $coll);

        if (sizeof($chekuser) > 0) {
            $balikan ['data'] = array();
            $balikan ['message'] = $this->globalmodel->Message('16');
            $balikan ['status'] = "0";
        } else {
            $balikan ['data'] = array();
            $balikan ['message'] = $this->globalmodel->Message('10');
            $balikan ['status'] = "1";
        }
        return json_encode($balikan);
    }

    function insertToDatabase($coll, $data) {
        $m = new Mongo();
        $db = $m->itc;
        $collection = $db->$coll;
        $hasil = $collection->insert($data);
        if ($hasil) {
            $newDocID = $data['_id'];
            return $newDocID;
        } else {
            return 11;
        }
    }

    function SaveRegister($data, $coll) {
        $m = new Mongo();
        $db = $m->itc;
        $collection = $db->$coll;
        $hasil = $collection->insert($data);
        if ($hasil) {
            $newDocID = $data['_id'];
            return $newDocID;
        } else {
            return 11;
        }
    }

    function ChekLogin($condition) {
        $hsl=array();
        $registered = '0';
        $cond = array(
            'username' => $condition['username'],
            'password' => md5($condition['password']),
        );
        $coll = 'tlogin';
        $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, $coll);
        //gw edit dimari yaks
        $id = "0";
        $telp = "0";
//        print_r($condition);die(0);
//        print_r($cheklogin);die(0);

        if (sizeof($cheklogin) > 0) {
            $msg = $this->globalmodel->Message('10');
            $status = "1";
            $condUser = array(
                '_id' => new MongoId($cheklogin['user_id']),
                'fdeleted' => '1'
            );
            $coluser = 'tuser';
            $chekuser = $this->globalmodel->getOneRecordWithCond($condUser, $coluser);
//           print_r($chekuser);die(0);
            $chekuser['user_id'] = $chekuser['_id']->{'$id'};
            $chekuser['username']=$cheklogin['username'];
            unset($chekuser['_id']);
             unset($chekuser['fdeleted']);
            unset($chekuser['create_by']);
            unset($chekuser['create_date']);
            unset($chekuser['modified_by']);
            unset($chekuser['modified_date']);
            if ($chekuser['no_telp'] != $condition['telp']) {
                $msg = $this->globalmodel->Message('15');
                $status = "1";
                $registered = '1';
            }
            if ($chekuser['no_telp'] != $condition['telp']) {
                $telp = $condition['telp'];
            } else {
                $telp = $chekuser['no_telp'];
            }

            $msg = $this->globalmodel->Message('10');
            $status = "1";
            $hsl=$chekuser;
        } else {
            $msg = $this->globalmodel->Message('12');
            $status = "0";
        }
        //dikomen ama momo ayunda si manis manja imut menggemaskan, kalo ada masalah kita kelahi sini
        $balikan = array('data' => array('userdetail' => $hsl, 'no_tlp_baru' => $telp, 'beda_telp' => $registered), 'msg' => $msg, 'status' => $status);
        return $balikan;
    }

    function ConfirmLogin($data) {
//        print_r($data)
        $hasil = array();
        $coll = 'tuser';
        $cond = array('_id' => new MongoId($data['user_id']));
        $chekuser = $this->globalmodel->getOneRecordWithCond($cond, $coll);
        if ($data['respon'] == '1') {


            $set = array('$set' => array('no_telp' => $data['no_tlp_baru']));
            $condisi = array($cond, $set);

            $updateuser = $this->globalmodel->UpdateRecordWithCond($cond,$set, $coll);
            if ($updateuser) {
                $action = ' Update no telp: lama : ' . $chekuser['no_telp'] . ' ke baru : ' . $data['no_tlp_baru'] . ' user_id : ' . new MongoId($data['user_id']);
                $insertLog = $this->globalmodel->InsertTLog($coll, $action, 'succes');
                $msg = $this->globalmodel->Message('10');
                $status = "1";
                $hasil = array(
                    "user_id" => $data['user_id'],
                    "no_telp" => $data['no_tlp_baru']
                );
//                $cond = array('no_telp' => $data['no_tlp_baru']);
//                $set = array('$set' => array('fdelete' => '0'));
//                $kondisi = array($cond, $set);
//                $deleteverivikasi = $this->DeleteVerifikasi($kondisi);
            } else {
                $action = ' Update no telp: lama : ' . $chekuser['no_telp'] . ' ke baru : ' . $data['no_telp_baru'] . ' user_id : ' . new MongoId($data['user_id']);
                $insertLog = $this->globalmodel->InsertTLog($coll, $action, 'error');
                $msg = $this->globalmodel->Message('11');
                $status = "0";
                $hasil = array(
                    "user_id" => $data['user_id'],
                    "no_telp" => ''
                );
            }
        } else {
            $msg = $this->globalmodel->Message('11');
            $status = "0";
            $hasil = array(
                "user_id" => $data['user_id'],
                "no_telp" => $chekuser['no_telp']
            );
        }
        $balikan = array('data' => $hasil,
            'message' => $msg,
            'status' => $status);
        return $balikan;
    }

    function InsertVerifikasi($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $dataverifikasi = array(
            "telp" => $data['no_telp'],
            "kode_verify" => $data['kode_verify'],
            "create_date" => $date,
            "modified_date" => $date,
        );

        $insert = $this->globalmodel->insertToDatabase('temp_verifikasi', $dataverifikasi);
        return $insert;
    }

    function InsertUser($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $datauser = array(
            "nama" => '',
            "no_telp" => $data['no_telp'],
            "alamat" => '',
            "fdeleted" => '1',
            "status" => '0',
            "create_by" => '',
            "create_date" => $date,
            "modified_by" => '',
            "modified_date" => $date,
        );
        $saveuser = $this->globalmodel->insertToDatabase('tuser', $datauser);
        return $saveuser;
    }

    function InsertLogin($data) {
//         print_r($data);die(0);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $datalogin = array(
            'user_id' => new MongoId($data['user_id']),
            "username" => strtolower($data['username']),
            "password" => md5($data['password']),
            "levelid" => '0',
            "create_by" => '',
            "create_date" => $date,
            "modified_by" => '',
            "modified_date" => $date,
        );
        $saveuser = $this->globalmodel->insertToDatabase('tlogin', $datalogin);
//        print_r($saveuser);die(0);
        return $saveuser;
    }

//    function InsertmobileData($data) {
////         print_r($data);die(0);
//        date_default_timezone_set('Asia/Jakarta');
//        $date = date('Y-m-d h:i:sa');
//        $datalogin = array(
//            'user_id' => new MongoId($data['user_id']),
//            "hardware_id" => $data['hardware_id'],
//            
//            "create_date" => $date,
//            "modified_by" => '',
//            "modified_date" => $date,
//        );
//        $saveuser = $this->globalmodel->insertToDatabase('tmobile', $datalogin);
////        print_r($saveuser);die(0);
//        return $saveuser;
//    }
    function DeleteVerifikasi($data) {
        
         $update=$this->globalmodel->deleteRecordWithCondition('temp_verifikasi', $data);
          return 'ok';
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


       $test= $this->globalmodel->sms_gateway("http://118.98.22.90:13013/cgi-bin/sendsms?username=jbgrosir&password=jbgrosir123&to=" .
                $dataPush['no_hp'] . "&text=" . $dataPush['pesan'], $dataPush);
//       print_r($test);die(0);
        return $rand;
    }

    function PendingInvite($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
//        print_r($data);die(0);
        $telp=$data['no_tlp'];
        $datapending = array(
            'shop_id_inviter' => new MongoId($data['shop_id']),
            "no_tlp_invited" => $telp,
            
            "fdelete" => '1',
            "create_by" => '',
            "create_date" => $date,
            "modified_by" => '',
            "modified_date" => $date,
        );
        $saveinvite = $this->globalmodel->insertToDatabase('tpending_invite', $datapending);
//         print_r($saveinvite);die(0);
         return $saveinvite;
    }
    function InsertmobileData($data){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $datauser = array(
            "user_id" => new MongoId($data['user_id']),
            "no_telp" => $data['no_telp'],
            "hardware_id" => $data['hardware_id'],
            "create_by" => '',
            "create_date" => $date,
            "modified_by" => '',
            "modified_date" => $date,
        );
        $saveuser = $this->globalmodel->insertToDatabase('tmobile', $datauser);
        return $saveuser;
    }

    //put your code here
}
