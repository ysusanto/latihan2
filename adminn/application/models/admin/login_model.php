<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class login_model extends CI_Model {
    function login_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }
    
    function ChekLogin($condition) {
         $db = $this->load->database('default', TRUE);

         $cond = array(
            'username' => $condition['username'],
            'password' => sha1($condition['password']),
            'levelid'=>'1'
        );
//        $password = sha1($_POST["txtPassword"]);
		$result = $db->query("SELECT user_id,username,password FROM tb_user WHERE username='{$cond['username']}' AND password='{$cond['password']}'");
//		$row = mysql_fetch_assoc($result);
        
        $hsl=array();
        $registered = '0';
        
//        $coll = 'tlogin';
//        $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, $coll);
        $id = "0";
        $telp = "0";

        if ($result->num_rows()>0) {
          
            $chekuser=$result->row_array();
//            $condUser = array(
//                '_id' => new MongoId($cheklogin['user_id']),
//                'fdeleted' => '1'
//            );
//            $coluser = 'tuser';
//            $chekuser = $this->globalmodel->getOneRecordWithCond($condUser, $coluser);
//            $chekuser['user_id'] = $chekuser['_id']->{'$id'};
//            $chekuser['username']= $cheklogin['username'];
//            $chekuser['level']=$chekuser['levelid'];
//            unset($chekuser['_id']);
//            unset($chekuser['fdeleted']);
////            unset($chekuser['create_by']);
//            unset($chekuser['create_date']);
////            unset($chekuser['modified_by']);
//            unset($chekuser['modified_date']);
//print_r($chekuser);die(0);
            $msg = "login sukses";
            $status = "1";
            $hsl = $chekuser;
        } else {
            $msg = "login gagal";
            $status = "0";
        }
        //dikomen ama momo ayunda si manis manja imut menggemaskan, kalo ada masalah kita kelahi sini
        $balikan = array('data' => array('userdetail' => $hsl), 'msg' => $msg, 'status' => $status);
        return $balikan;
    }
    
    function createUser($data){
          $db = $this->load->database('default', TRUE);
      date_default_timezone_set('Asia/Jakarta');
      $date = date('Y-m-d H:i:s');
        $datauser = array(
            "nama" => $data['nama'],
            "no_telp" => $data['telp'],
            "alamat" => $data['alamat'],
            "fdeleted" => '1',
            "status" => '0',
            "create_by" => '',
            "create_date" => $date,
            "modified_by" => '',
            "modified_date" => $date,
        );
        $sqlinsert = "INSERT INTO tuser(nama,no_telp,alamat,fdelete,create_date,modified_date) values ('";
        $sqlinsert .= $datauser['nama']."','";
        $sqlinsert .= $datauser['no_telp']."','";
        $sqlinsert .= $datauser['alamat']."','";
        $sqlinsert .= $datauser['fdelete']."','";
        $sqlinsert .= $datauser['create_date']."','";
        $sqlinsert .= $datauser['modified_date']."')";
//        print_r($sqllogin);die(0);
        $query = $db->query($sqlinsert);
        if($query){
            $sql ="select max(user_id) as 'user_id' from tuser";
            $qry = $db->query($sql);
            $row=$qry->row_array();
        }else{
            $row['user_id']=11;
        }
        return $row['user_id'];  
    }
    function createlogin($data){
          $db = $this->load->database('default', TRUE);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $datalogin = array(
            'user_id' => new MongoId($data['user_id']),
            "username" => strtolower($data['username']),
            "password" => md5($data['password']),
            "levelid" => '1',
            "create_by" => '',
            "create_date" => $date,
            "modified_by" => '',
            "modified_date" => $date,
        );
        $sqlinsert = "INSERT INTO tlogin(user_id,username,password,levelid,create_date,modified_date) values ('";
        $sqlinsert .= $datalogin['user_id']."','";
        $sqlinsert .= $datalogin['username']."','";
        $sqlinsert .= $datalogin['password']."','";
        $sqlinsert .= $datalogin['levelid']."','";
        $sqlinsert .= $datalogin['create_date']."','";
        $sqlinsert .= $datalogin['modified_date']."')";
        $query = $db->query($sqlinsert);
        if($query){
            $sql ="select max(id_login) as 'id_login' from tlogin";
            $qry = $db->query($sql);
            $row=$qry->row_array();
        }else{
            $row['id_login']=11;
        }
        return $row['id_login'];
    }
    function cekUser($data) {
        $balikan = array();
        $cond = array(
            'username' => $data['username'],
        );
        $coll = 'tlogin';
        $cekuser = $this->globalmodel->getOneRecordWithCond($cond, $coll);

        if ($cekuser) {
            $balikan = 0;
        } else {
            $balikan = 1;
        }
        return $balikan;
    }
}

