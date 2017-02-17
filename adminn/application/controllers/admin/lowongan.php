<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lowongan
 *
 * @author ASUS
 */
class lowongan extends CI_Controller{
    //put your code here
    function lowongan() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('admin/login_model', 'login_model');
        $this->load->model('db_load', 'generalmodel');

        $this->load->model('admin/lowongan_model', 'lowonganmodel');

    }
    
    function viewlowongan(){
         $viewdata = $this->lowonganmodel->viewlowongan();
        echo json_encode($viewdata);
    }
    function detail($id){
         $content['username'] = $this->session->userdata('username');
        $content['user_id'] = $this->session->userdata('userid');
        $content['jobs'] = $this->lowonganmodel->getdetaillowongan($id);
//        print_r($content['jobs']);die(0);
        $this->load->view('admin/view_lowongandetail', $content);
    }
    function getexportpdf() {
        $getdata = $this->lowonganmodel->getlowonganexport();
        $exportpdf=$this->generalmodel->exporttopdf($getdata,'lowongan.pdf');
        
    }
    
    
    
}
