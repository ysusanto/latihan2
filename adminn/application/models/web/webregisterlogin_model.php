<?php

/**
 * Description of registerlogin_model
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class webregisterlogin_model extends CI_Model {

    function webregisterlogin_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function ChekLogin($condition) {
        $hsl = array();
        $registered = '0';
//        $cond = array(
//            'username' => $condition['username'],
//            'password' => md5($condition['password'])
//        );
//        $coll = 'tlogin';

        $db = $this->load->database('default', TRUE);

        $sqllogin = "select user_id,username from tlogin where  username='" . $condition['username'] . "' and password='" . md5($condition['password']) . "'";
        $query = $db->query($sqllogin);
//        print_r($sqllogin);die(0);
//        $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, $coll);
//        $id = "0";
//        $telp = "0";

        if ($query->num_rows() > 0) {
            $hsl = $query->row_array();
//            print_r($hsl);die(0);
            $sqluser = "select a.nama,b.* from tuser a right join tlogin b on a.user_id=b.user_id or a.user_id2=b.user_id where  b.user_id='" . $hsl['user_id'] . "' ";
            $query = $db->query($sqluser);
//            print_r($sqluser);die(0);
            $chekuser=$query->row_array();
//            $msg = $this->globalmodel->Message('10');
//            $status = "1";
//            $condUser = array(
//                '_id' => new MongoId($cheklogin['user_id']),
//                'fdeleted' => '1'
//            );
//            $coluser = 'tuser';
//            $chekuser = $this->globalmodel->getOneRecordWithCond($condUser, $coluser);
//            $chekuser['user_id'] = $chekuser['_id']->{'$id'};
//            $chekuser['username'] = $cheklogin['username'];
//            unset($chekuser['_id']);
//            unset($chekuser['fdeleted']);
//            unset($chekuser['create_by']);
//            unset($chekuser['create_date']);
//            unset($chekuser['modified_by']);
//            unset($chekuser['modified_date']);
//print_r($hsl);die(0);
            $msg = 'Login sukses';
            $status = "1";
            $hsl = $chekuser;
        } else {
            $msg = 'Login Gagal';
            $status = "0";
        }
        //dikomen ama momo ayunda si manis manja imut menggemaskan, kalo ada masalah kita kelahi sini
        $balikan = array('data' => array('userdetail' => $hsl), 'msg' => $msg, 'status' => $status);
        return $balikan;
    }

    function getuserdetail($condition) {
        $db = $this->load->database('default', TRUE);

        $sqllogin = "select user_id,username,modified_date from tlogin where  username='" . $condition['username'] . "'";
        $query = $db->query($sqllogin);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $sql = "select user_id,nama,alamat,no_telp from tuser where  fdelete ='1' and user_id='" . $row['user_id'] . "'";
            $query = $db->query($sql);
            $chekuser = $query->row_array();

            return $chekuser;
        } else {
            return 0;
        }
    }

    function generateid($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('ymd');
        switch ($data['status']) {
            case 'user' :

                break;
            case 'product':
                break;
            case 'shop':
                break;
            default :
        }
    }

    function createUserID($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $db = $this->load->database('default', TRUE);
        $sql = "insert into tuser(nama,no_telp,alamat,fdelete,create_date,modified_date) values (";
        $sql.="'".$data['nama']."','".$data['telp']."','','1',";
        $sql.="'" . $date . "',";
        $sql.="'" . $date . "')";
        $query = $db->query($sql);
        if ($query) {
            $sql = "select user_id from tuser where create_date='" . $date . "' order by create_date desc";
            $query = $db->query($sql);
            $hasil = $query->row_array();
        }
        return $hasil['user_id'];
    }

    function createUserLogin($data) {
//        print_r($data);die(0);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $db = $this->load->database('default', TRUE);
        $sql = "insert into tlogin(user_id,username,password,levelid,create_date,modified_date) values (";
        $sql.="'" . $data['user_id'] . "',";
        $sql.="'" . $data['username'] . "',";
        $sql.="'" . md5($data['password']) . "',";
        $sql.="'0',";
        $sql.="'" . $date . "',";
        $sql.="'" . $date . "')";
        $query = $db->query($sql);
        if ($query) {

            $sqlselect = "select id_login from tlogin where username='" . $data['username'] . "' and user_id='" . $data['user_id'] . "'";
            $query2 = $db->query($sqlselect);
            $row = $query2->row_array();
        }
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
        return $row['id_login'];
    }

    function cekUser($data) {
        $balikan = array();
         $db = $this->load->database('default', TRUE);
        
        $sql = "select * from tlogin where username='" . $data['username'] . "' order by create_date desc";
        $query = $db->query($sql);
        $hasil = $query->row_array();
//        $cekuser = $this->globalmodel->getOneRecordWithCond($cond, $coll);

        if ($query->num_rows()>0) {
            $balikan = 0;
        } else {
            $balikan = 1;
        }
        return $balikan;
    }

}
