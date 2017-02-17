<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invition_model
 *
 * @author user
 */
class invition_model extends CI_Model {

    function invition_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    //put your code here
    function PendingInvite($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
//        print_r($data);die(0);
        $telp = '+62' . $data['no_tlp'];
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
        return $saveinvite;
    }

    function ChekPendingInvite($data) {
$hasil=array();
        $cond = array(
            'fdelete' => '1',
            'no_tlp_invited' => $data['no_telp']
        );
        $chek = $this->globalmodel->getRecordWithCondition('tpending_invite', $cond);
        if (sizeof($chek) > 0) {
            foreach ($chek as $row) {
                $conduser=array(
                    'fdeleted'=>'1',
                    'no_telp'=>$chek['no_tlp_invited']
                );
                $userdata=$this->globalmodel->getOneRecordWithCond($conduser, 'tuser');
                $row['userdata']=$userdata;
               array_push($hasil,$row); 
            }
        }
        return $hasil;
    }

//    function AddFollower($data) {
//        $datainsert = array(
//            "shop_id_followed" => $data['shop_id'],
//            'user_id_follower' => $data['user_id'],
//            'fdeleted' => '1',
//            'creatad_by' => '',
//            'created_date' => $date,
//            'modified_by' => '',
//            'modified_date' => $date,
//        );
//        $insertfolower = $this->globalmodel->insertToDatabase('tfollower', $datainsert);
//        
//        
//    }

}
