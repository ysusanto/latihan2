<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db_load
 *
 * @author ASUS
 */
class db_load extends CI_Model {

    //put your code here
    function db_load() {
        parent::__construct();
        require_once 'export/mpdf60/mpdf.php';
        $this->load->library('session');
        //$this->load->library('mpdf60/mpdf','pdf');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function loadlokasi() {
        $db = $this->load->database('default', TRUE);
        $hsl = array();

        $result = $db->query("SELECT location_id, location FROM tb_location");
        foreach ($result->result_array() as $row) {
            $a = '';
            $a.= "<option value='{$row['location_id']}'>{$row['location']}</option>";
            array_push($hsl, $a);
        }
        return$hsl;
    }

    function loadindustri() {
        $db = $this->load->database('default', TRUE);
        $hsl = array();
        $a = '';
        $result = $db->query("SELECT industry_id, industry FROM tb_industry");
        foreach ($result->result_array() as $row) {
            $a = '';
            $a.= "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
            array_push($hsl, $a);
        }
        return $hsl;
    }

    function loadSpesialisasi() {
        $db = $this->load->database('default', TRUE);
        $hsl = array();
        $a = '';
        $result = $db->query("SELECT specialization_id, specialization FROM tb_specialization");
        foreach ($result->result_array() as $row) {
            $a = '';
            $a.= "<option value='{$row['specialization_id']}'>{$row['specialization']}</option>";
            array_push($hsl, $a);
        }
        return $hsl;
    }

    function loadEdukasi() {
        $db = $this->load->database('default', TRUE);
        $hsl = array();
        $a = '';
        $result = $db->query("SELECT education_id, education FROM tb_education");
        foreach ($result->result_array() as $row) {
            $a = '';
            $a.= "<option value='{$row['education_id']}'>{$row['education']}</option>";
            array_push($hsl, $a);
        }
        return $hsl;
    }

    function loadLevel() {
        $db = $this->load->database('default', TRUE);
        $hsl = array();
        $a = '';
        $result = $db->query("SELECT level_id, level FROM tb_level");
        foreach ($result->result_array() as $row) {
            $a = '';
            $a.= "<option value='{$row['level_id']}'>{$row['level']}</option>";
            array_push($hsl, $a);
        }
        return $hsl;
    }

    function exporttopdf($isi, $exportname) {
        $pdf = new mPDF();
        $getcss= base_url(). "css/tableprint.css";
        $css = file_get_contents($getcss);
        $pdf->WriteHTML($css, 1);

        $pdf->WriteHTML($isi);
        $pdf->Output($exportname, 'I');
        
        exit;
    }

}
