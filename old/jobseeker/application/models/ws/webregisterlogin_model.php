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
        $this->load->model('ws_global_model', 'globalmodel');
    }
    
    function ChekLogin($condition) {
        $hsl=array();
        $registered = '0';
        $cond = array(
            'username' => $condition['username'],
            'password' => md5($condition['password'])
        );
        $coll = 'tlogin';
        $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, $coll);
        $id = "0";
        $telp = "0";

        if (sizeof($cheklogin) > 0) {
            $msg = $this->globalmodel->Message('10');
            $status = "1";
            $condUser = array(
                '_id' => new MongoId($cheklogin['user_id']),
                'fdeleted' => '1'
            );
            $coluser = 'tuser';
            $chekuser = $this->globalmodel->getOneRecordWithCond($condUser, $coluser);
            $chekuser['user_id'] = $chekuser['_id']->{'$id'};
            $chekuser['username']= $cheklogin['username'];
            unset($chekuser['_id']);
            unset($chekuser['fdeleted']);
            unset($chekuser['create_by']);
            unset($chekuser['create_date']);
            unset($chekuser['modified_by']);
            unset($chekuser['modified_date']);

            $msg = $this->globalmodel->Message('10');
            $status = "1";
            $hsl = $chekuser;
        } else {
            $msg = $this->globalmodel->Message('12');
            $status = "0";
        }
        //dikomen ama momo ayunda si manis manja imut menggemaskan, kalo ada masalah kita kelahi sini
        $balikan = array('data' => array('userdetail' => $hsl), 'msg' => $msg, 'status' => $status);
        return $balikan;
    }
    
    function getuserdetail($condition){
        $cond = array(
            'username' => $condition['username']
        );
        $coll = 'tlogin';
        $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, $coll);
        if (sizeof($cheklogin) > 0) {
            $condUser = array(
                '_id' => new MongoId($cheklogin['user_id']),
                'fdeleted' => '1'
            );
            $coluser = 'tuser';
            $chekuser = $this->globalmodel->getOneRecordWithCond($condUser, $coluser);
            return $chekuser;
        }else{
            return 0;
        }
    }
}
