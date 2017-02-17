<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author ASUS
 */
class perusahaan extends CI_Controller {

    function perusahaan() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('admin/login_model', 'login_model');
        $this->load->model('db_load', 'generalmodel');

        $this->load->model('admin/perusahaan_model', 'companymodel');

    }

    function viewperusahaan() {

        $viewdata = $this->companymodel->viewperusahaan();
        echo json_encode($viewdata);
  
    }

    function addperusahaan() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        $createperusahaan = $this->companymodel->registerPerusahaan($data);
        if ($createperusahaan == 1) {
            $balikan = array(
                'status' => '1',
                'msg' => 'Terima kasih telah mendaftar'
            );
        } else {
            $balikan = array(
                'status' => '0',
                'msg' => 'Maaf, pendaftaran gagal.'
            );
        }
        echo json_encode($balikan);
    }

    function addlowker() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        $createlowongan = $this->companymodel->addLowongan($data);
        if ($createlowongan == 1) {
            $balikan = array(
                'status' => '1',
                'msg' => 'Lowongan telah berhasil di tambahkan'
            );
        } else {
            $balikan = array(
                'status' => '0',
                'msg' => 'Maaf, lowongan gagaldi tambahkan.'
            );
        }
        echo json_encode($balikan);
    }

    function detail($id) {
        $content['username'] = $this->session->userdata('username');
        $content['user_id'] = $this->session->userdata('userid');
        $content['profile'] = $this->companymodel->getdetailprofile($id);
        $this->load->view('admin/view_perusahaandetail', $content);
    }

    function getexportpdf() {
        $getdata = $this->companymodel->getperusahaanexport();
        $exportpdf=$this->generalmodel->exporttopdf($getdata,'perusahaan.pdf');
        
    }
    function deleteperusahaan(){
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        
        $delete=$this->companymodel->deleteperusahaan($data);
        
    }
    //put your code here
}
