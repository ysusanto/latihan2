<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home_model
 *
 * @author ASUS
 */
class home_model extends CI_Model {

    //put your code here
    function webregisterlogin_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function menu($data) {
        $db = $this->load->database('default', TRUE);

        $sqlmenu = "select * from tmenu where  levelid='" . $data['level'] . "' ";
        $query = $db->query($sqlmenu);
//        $cond = array(
//            'levelid' => $data['level'],
//            'parent' => null,
//        );
        $datamenu = array();
        $datasubmenu = array();
//        $menu = $this->globalmodel->getRecordWithCondition('tmenu', $cond);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $datasubmenu = array();
//
//                $cond = array(
//                    'levelid' => $data['level'],
//                    'parent' => $value['_id'],
//                );
//                $submenu = $this->globalmodel->getRecordWithCondition('tmenu', $cond);
                $sqlsubmenu = "select * from tmenu where  levelid='" . $data['level'] . "' and parent='" . $value['id_menu'] . "'";
                $query1 = $db->query($sqlsubmenu);
                if ($query1->num_rows() > 0) {
                    foreach ($query1->result_array() as $row) {
//$datasubmenu=array();
//                    unset($row['create_by']);
                        unset($row['create_date']);
//                    unset($row['modified_by']);
                        unset($row['modified_date']);

                        array_push($datasubmenu, $row);
                    }
                }
                if ($value['parent'] != null) {
                    continue;
                }
                $value['submenu'] = $datasubmenu;
//                unset($value['create_by']);
                unset($value['create_date']);
//                unset($value['modified_by']);
                unset($value['modified_date']);
                array_push($datamenu, $value);
            }
        }
//        echo json_encode($datamenu);die(0);
        return $datamenu;
    }

    function lookupkategori() {
//         $db = $this->load->database('default', TRUE);
//        $cond = array(
//            'type' => '2',
//            'nama' => 'Pakaian',
//            'fdelete' => '1'
//        );
//         $sqlcate = "select * from tsub_lookup where lookup_id='".$data['lookup_id']."'";
//        $query = $db->query($sqlcate);
//        $datamenu = array();
//        $datasubmenu = array();
//        $parentkategori = $this->globalmodel->getOneRecordWithCond($cond, 'tlookup');
//        if (sizeof($parentkategori) > 0) {
            $hasil = '4';
//        } else {
//            $hasil = null;
//        }

        return $hasil;
    }

}
