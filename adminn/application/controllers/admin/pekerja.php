<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pekerja
 *
 * @author ASUS
 */
class pekerja extends CI_Controller{
    function pekerja() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('admin/login_model', 'login_model');
        $this->load->model('db_load', 'generalmodel');

        $this->load->model('admin/pekerja_model', 'seekermodel');

    }
    
    function viewpekerja(){
         $viewdata = $this->seekermodel->viewpekerja();
        echo json_encode($viewdata);
    }
    function detail($id){
         $content['username'] = $this->session->userdata('username');
        $content['user_id'] = $this->session->userdata('userid');
        $content['profile'] = $this->seekermodel->getdetailpekerja($id);
//        print_r($content['profile']);die(0);
        $this->load->view('admin/view_pekerjadetail', $content);
    }
    function getexportpdf() {
        $getdata = $this->seekermodel->getpekerjaexport();
        $exportpdf=$this->generalmodel->exporttopdf($getdata,'calon.pdf');
        
    }
}
