<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notification
 *
 * @author user
 */
class notification extends CI_Model {

    //put your code here

    function notification() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    function cheknotif($data) {
        $collshop = "tnotif";
//        $data['limitproduct'] = 5;
        $type = array('1', '2', '3', '4');
//         print_r($type);die(0);
        $balikan = array();
        $listnotif = array();
//        foreach ($type as $t) {

        $cond = array(
            'user_id' => new MongoId($data['user_id']),
//                'type' => $t,
            'read' => '0',
            'fdelete' => '1'
        );

        $getnotif = $this->globalmodel->getRecordWithCondition($collshop, $cond);
//            print_r($getnotif);die(0);
        if (sizeof($getnotif) > 0) {
            $balikan['jumlah'] = sizeof($getnotif);
            foreach ($getnotif as $gn) {
                $gn['notif_id'] = $gn['notif_id']->{'$id'};
                unset($gn['read']);
                unset($gn['fdeleted']);
                unset($gn['create_date']);
                unset($gn['modified_date']);
                array_push($listnotif, $gn);
            }
        } else {
            $balikan['jumlah'] = 0;
        }
        $balikan['listnotif'] = $listnotif;
//        }
        return $balikan;
    }

    function addnotification($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $dataadd = array('read' => '0', 'fdeleted' => '1', 'create_date' => $date, 'modified_date' => $date);
        $datanotif = array();
        $datanotif = array_merge($data, $dataadd);
        $saveuser = $this->globalmodel->insertToDatabase('tnotif', $datanotif);
        return $saveuser;
    }

    function isread($data) {
        $collshop = "tnotif";
//        $data['limitproduct'] = 5;

        $cond = array(
            'user_id' => new MongoId($data['user_id']),
//            'shop_id' => new MongoId($data['shop_id']),
            'read' => '0',
            'fdelete' => '1'
        );
        $getnotif = $this->globalmodel->getRecordWithCondition($coll, $cond);
        $balikan['jumlah'] = sizeof($getnotif);
    }

    function chekhardware($data) {
        $coll = "tmobile";
//        $data['limitproduct'] = 5;
        $type = array('1', '2', '3', '4');
//         print_r($type);die(0);
//        $balikan = array();mm
        $listhardware = array();
//        foreach ($type as $t) {

        $cond = array(
            'user_id' => new MongoId($data['user_id']),
//                'type' => $t,
            
        );

        $getnotif = $this->globalmodel->getRecordWithCondition($coll, $cond);
//            print_r($getnotif);die(0);
        if (sizeof($getnotif) > 0) {
//            $balikan['jumlah'] = sizeof($getnotif);
            foreach ($getnotif as $gn) {
                $gn['id'] = $gn['_id']->{'$id'};
                $gn['user_id'] = $gn['user_id']->{'$id'};
//                unset($gn['read']);
//                unset($gn['fdeleted']);
                unset($gn['create_date']);
                unset($gn['modified_date']);
                array_push($listhardware, $gn);
            }
        } 
//        $balikan['listnotif'] = $listnotif;
//        }
        return $listhardware;
    }

}
