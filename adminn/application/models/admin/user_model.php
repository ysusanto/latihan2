<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author ASUS
 */
class user_model extends CI_Model {

    function user_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function viewuser() {
        $db = $this->load->database('default', TRUE);

        $sqlmenu = "select * from tlogin a inner join tuser b on a.user_id=b.user_id where fdelete='1' and  levelid='1' ";
        $query = $db->query($sqlmenu);
//        $cond = array(
//            'levelid' => '1'
//        );
//
//        $datalogin = $this->globalmodel->getRecordWithCondition('tlogin', $cond);
        if ($query->num_rows > 0) {
            $a = 1;
            foreach ($query->result_array() as $value) {
//                $cond = array(
//                    '_id' => $value['user_id'],
//                    'fdeleted' => '1'
//                );
//                $datauser = $this->globalmodel->getOneRecordWithCond($cond, 'tuser');
                $detail = "<a onclick=\"deleteuser('" . $value['user_id'] . "')\" href='#' style=\"text-decoration:none;margin-left:7px;\"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>";
                $jsonuser['aaData'][] = array("<div style='text-align:left;'>" . $a . "</div>", "<div style='text-align:left;'>" . $value['username'] . "</div>", "<div style='text-align:left;'>" . $value['nama'] . "</div>", "<div style='text-align:left;'>" . $value['alamat'] . "</div>", "<div style='text-align:left;'>" . $value['no_telp'] . "</div>", "<div style='text-align:center;'>" . $detail . "</div>");
                $a++;
            }
        } else {
            $jsonuser['aaData'] = array();
        }
        return $jsonuser;
    }

    function deleteUser($data) {
        $cond = array(
//            'user_id' => new MongoId($data['user_id'])
        );

        $sqlmenu = "delete from tlogin where user_id='" . $data['user_id'];
        $query = $db->query($sqlmenu);
        if ($query) {
            $sqlmenu = "delete from tuser where user_id='" . $data['user_id'];
            $query = $db->query($sqlmenu);
            $status = 'ok';
        } else {

            $status = 'gagal';
        }
        return $status;
    }

    //put your code here
}
