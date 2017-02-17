<?php

/**
 * Description of registerlogin_model
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class broadcastloker_model extends CI_Model {

    function broadcastloker_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('db_load');
    }

    function SaveBroadcastloker($data) {
        
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:m:s');
        $db = $this->load->database('default',TRUE);
//        print_r($data);die(0);
        $sql = 'select max(id_user) as last_id from user';
        $query1 = $db->query($sql);
        
        $row = $query1->row_array();
// print_r($row);die(0);

//        $last_id=$this->db_load->generate_id($);
        $cheklastid = $this->db_load->generetecode($row['last_id']);
//        print_r($cheklastid);die(0);
        if ($cheklastid != '') {
            $sqlinsert = 'INSERT INTO user(id_user,username,password,id_sttsuser,nama,alamat,id_kota,telp,email,created_by,created_date,modified_by,modified_date) values';
            $sqlinsert .="('" . $cheklastid . "','" . $data['username'] . "','" . md5($data['password']) . "','" . $data['status'] . "','" . $data['nama'] . "','" . $data['alamat'];
            $sqlinsert .="','" . $data['kota'] . "','" . $data['no_tlp'] . "','" . $data['email'] . "','','".$date."','','".$date."')";
            
            $query = $db->query($sqlinsert);
            if ($query) {
                if ($data['status'] == '1') {
                    $sqlinsert = 'INSERT INTO training_center(id_training,create_date,modified_date) values';
                    $sqlinsert .="('" . $cheklastid . "','" . $date . "','" . $date . "')";
                }else if($data['status'] == '2'){
                    $sqlinsert = 'INSERT INTO company(id_pt,create_date,modified_date) values';
                    $sqlinsert .="('" . $cheklastid . "','" . $date . "','" . $date . "')";
                }else{
                    $sqlinsert = 'INSERT INTO employe(id_employ,create_date,modified_date) values';
                    $sqlinsert .="('" . $cheklastid . "','" . $date . "','" . $date . "')";
                }
//                print_r($sqlinsert);die(0);
                $query = $db->query($sqlinsert);
                if($query){
                    return 'ok';
                }else{
                    return 'error';
                }
            }else{
                return 'error';
            }

//            return 'ok';
        }
    }

//    function chekusername($data) {
//        $db = $this->load->database('k3477807_jobseeker', TRUE);
//        $sql = "select id_user as username from user where username=lower('" . $data['username'] . "')";
//        $qry = $db->query($sql);
//        $num = $qry->num_rows();
//        if ($num > 0) {
//            return "username telah di gunakan";
//        } else {
//            return "ok";
//        }
//    }

    function ChekLogin($condition) {
         $hsl = array();
         $db = $this->load->database('default', TRUE);
         $registered = '0';
         $cond = array(
             'username' => $condition['username'],
             'password' => md5($condition['password']),
         );
//         print_r($cond);die(0);
         $sql = "select id_user,username,nama,id_sttsuser,email  from user where username=lower('" . $condition['username'] . "') and password=('" . md5($condition['password']) . "')";
//                  print_r($sql);die(0);

         $qry = $db->query($sql);
         $num = $qry->num_rows();
//                           print_r($num);die(0);

         if ($num > 0) {
             $row = $qry->row_array();
             return $row;
         } else {
             return 'error';
         }
     }

//    function ConfirmLogin($data) {
////        print_r($data)
//        $hasil = array();
//        $coll = 'tuser';
//        $cond = array('_id' => new MongoId($data['user_id']));
//        $chekuser = $this->globalmodel->getOneRecordWithCond($cond, $coll);
//        if ($data['respon'] == '1') {
//
//
//            $set = array('$set' => array('no_telp' => $data['no_tlp_baru']));
//            $condisi = array($cond, $set);
//
//            $updateuser = $this->globalmodel->UpdateRecordWithCond($cond, $set, $coll);
//            if ($updateuser) {
//                $action = ' Update no telp: lama : ' . $chekuser['no_telp'] . ' ke baru : ' . $data['no_tlp_baru'] . ' user_id : ' . new MongoId($data['user_id']);
//                $insertLog = $this->globalmodel->InsertTLog($coll, $action, 'succes');
//                $msg = $this->globalmodel->Message('10');
//                $status = "1";
//                $hasil = array(
//                    "user_id" => $data['user_id'],
//                    "no_telp" => $data['no_tlp_baru']
//                );
////                $cond = array('no_telp' => $data['no_tlp_baru']);
////                $set = array('$set' => array('fdelete' => '0'));
////                $kondisi = array($cond, $set);
////                $deleteverivikasi = $this->DeleteVerifikasi($kondisi);
//            } else {
//                $action = ' Update no telp: lama : ' . $chekuser['no_telp'] . ' ke baru : ' . $data['no_telp_baru'] . ' user_id : ' . new MongoId($data['user_id']);
//                $insertLog = $this->globalmodel->InsertTLog($coll, $action, 'error');
//                $msg = $this->globalmodel->Message('11');
//                $status = "0";
//                $hasil = array(
//                    "user_id" => $data['user_id'],
//                    "no_telp" => ''
//                );
//            }
//        } else {
//            $msg = $this->globalmodel->Message('11');
//            $status = "0";
//            $hasil = array(
//                "user_id" => $data['user_id'],
//                "no_telp" => $chekuser['no_telp']
//            );
//        }
//        $balikan = array('data' => $hasil,
//            'message' => $msg,
//            'status' => $status);
//        return $balikan;
//    }
//
//    function InsertVerifikasi($data) {
//        date_default_timezone_set('Asia/Jakarta');
//        $date = date('Y-m-d h:i:sa');
//        $dataverifikasi = array(
//            "telp" => $data['no_telp'],
//            "kode_verify" => $data['kode_verify'],
//            "create_date" => $date,
//            "modified_date" => $date,
//        );
//
//        $insert = $this->globalmodel->insertToDatabase('temp_verifikasi', $dataverifikasi);
//        return $insert;
//    }
//
//    function InsertUser($data) {
//        date_default_timezone_set('Asia/Jakarta');
//        $date = date('Y-m-d h:i:sa');
//        $datauser = array(
//            "nama" => '',
//            "no_telp" => $data['no_telp'],
//            "alamat" => '',
//            "fdeleted" => '1',
//            "status" => '0',
//            "create_by" => '',
//            "create_date" => $date,
//            "modified_by" => '',
//            "modified_date" => $date,
//        );
//        $saveuser = $this->globalmodel->insertToDatabase('tuser', $datauser);
//        return $saveuser;
//    }
//
//    function InsertLogin($data) {
////         print_r($data);die(0);
//        date_default_timezone_set('Asia/Jakarta');
//        $date = date('Y-m-d h:i:sa');
//        $datalogin = array(
//            'user_id' => new MongoId($data['user_id']),
//            "username" => strtolower($data['username']),
//            "password" => md5($data['password']),
//            "levelid" => '0',
//            "create_by" => '',
//            "create_date" => $date,
//            "modified_by" => '',
//            "modified_date" => $date,
//        );
//        $saveuser = $this->globalmodel->insertToDatabase('tlogin', $datalogin);
////        print_r($saveuser);die(0);
//        return $saveuser;
//    }

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
//    function DeleteVerifikasi($data) {
//
//        $update = $this->globalmodel->deleteRecordWithCondition('temp_verifikasi', $data);
//        return 'ok';
//    }
//
//    function Verifikasi($data) {
//
//        $rand = rand(10000, 100000);
//
//
//        $pesan = "Your boleci verification : " . $rand . " ";
//        $telp = $data['no_telp'];
//        $dataPush = array(
//            'sms_create' => 'true',
//            'pesan' => $pesan,
//            'no_hp' => $telp
//        );
//
//
//        $test = $this->globalmodel->sms_gateway("http://118.98.22.90:13013/cgi-bin/sendsms?username=jbgrosir&password=jbgrosir123&to=" .
//                $dataPush['no_hp'] . "&text=" . $dataPush['pesan'], $dataPush);
////       print_r($test);die(0);
//        return $rand;
//    }
//
//    function PendingInvite($data) {
//        date_default_timezone_set('Asia/Jakarta');
//        $date = date('Y-m-d h:i:sa');
////        print_r($data);die(0);
//        $telp = $data['no_tlp'];
//        $datapending = array(
//            'shop_id_inviter' => new MongoId($data['shop_id']),
//            "no_tlp_invited" => $telp,
//            "fdelete" => '1',
//            "create_by" => '',
//            "create_date" => $date,
//            "modified_by" => '',
//            "modified_date" => $date,
//        );
//        $saveinvite = $this->globalmodel->insertToDatabase('tpending_invite', $datapending);
////         print_r($saveinvite);die(0);
//        return $saveinvite;
//    }
//
//    function InsertmobileData($data) {
//        date_default_timezone_set('Asia/Jakarta');
//        $date = date('Y-m-d h:i:sa');
//        $datauser = array(
//            "user_id" => new MongoId($data['user_id']),
//            "no_telp" => $data['no_telp'],
//            "hardware_id" => $data['hardware_id'],
//            "create_by" => '',
//            "create_date" => $date,
//            "modified_by" => '',
//            "modified_date" => $date,
//        );
//        $saveuser = $this->globalmodel->insertToDatabase('tmobile', $datauser);
//        return $saveuser;
//    }

    //put your code here
}
