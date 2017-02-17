<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home_admin
 *
 * @author ASUS
 */
class home_admin extends CI_Controller {

    function home_admin() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('admin/home_model', 'homemodel');
        $this->load->model('db_load', 'loadmodel');

    }

    //put your code here
    function index() {

        $content['username'] = $this->session->userdata('username');
        $content['user_id'] = $this->session->userdata('userid');
//        $content['level'] = $this->session->userdata('level');
        if ($content['username'] == false) {
            redirect('admin');
        } else {
            $content['content'] = '';
//            print_r($content);die(0);
//            $content['category'] = $this->webshop_model->getcategory();
//            $content['userdetail'] = $this->webregisterlogin_model->getuserdetail($content);
//            $content['satuan'] = $this->webshop_model->getsatuan();
            $this->load->view('admin/home_cms', $content);
        }
    }

    function registercms() {
        $this->load->view('admin/addusercms');
    }

    function login() {
        $this->load->view('admin/login');
    }

    function useraccess() {
        if ($this->session->userdata('username') == TRUE) {
            $content['username'] = $this->session->userdata('username');
            $content['user_id'] = $this->session->userdata('userid');
            $content['level'] = $this->session->userdata('level');
            $content['menu'] = $this->homemodel->menu($content);

            $this->load->view('admin/user_access', $content);
        } else {
            redirect('admin');
        }
    }

    function viewperusahaan() {
        if ($this->session->userdata('username') == TRUE) {
            $content['username'] = $this->session->userdata('username');
            $content['user_id'] = $this->session->userdata('userid');
            $content['level'] = $this->session->userdata('level');
            $content['lokasi'] = $this->loadmodel->loadlokasi();
            $content['industri'] = $this->loadmodel->loadindustri();
            $content['edukasi'] = $this->loadmodel->loadEdukasi();
            $content['spesialisasi'] = $this->loadmodel->loadSpesialisasi();
            $content['level'] = $this->loadmodel->loadLevel();
//            $content['satuan'] = $this->webshop_model->getsatuan();
            $this->load->view('admin/view_perusahaan', $content);
        } else {
            redirect('admin');
        }
    }

    function viewlowongan() {
        if ($this->session->userdata('username') == TRUE) {
           $content['username'] = $this->session->userdata('username');
            $content['user_id'] = $this->session->userdata('userid');
            $content['level'] = $this->session->userdata('level');
            $content['lokasi'] = $this->loadmodel->loadlokasi();
            $content['industri'] = $this->loadmodel->loadindustri();
            $content['edukasi'] = $this->loadmodel->loadEdukasi();
            $content['spesialisasi'] = $this->loadmodel->loadSpesialisasi();
            $content['level'] = $this->loadmodel->loadLevel();

            $this->load->view('admin/view_lowongan', $content);
        } else {
            redirect('admin');
        }
    }

    function viewpekerja() {
        if ($this->session->userdata('username') == TRUE) {
           $content['username'] = $this->session->userdata('username');
            $content['user_id'] = $this->session->userdata('userid');
            $content['level'] = $this->session->userdata('level');
            $content['lokasi'] = $this->loadmodel->loadlokasi();
            $content['industri'] = $this->loadmodel->loadindustri();
            $content['edukasi'] = $this->loadmodel->loadEdukasi();
            $content['spesialisasi'] = $this->loadmodel->loadSpesialisasi();
            $content['level'] = $this->loadmodel->loadLevel();

            $this->load->view('admin/view_pekerja', $content);
        } else {
            redirect('admin');
        }
    }
    
    function viewkursus() {
        if ($this->session->userdata('username') == TRUE) {
           $content['username'] = $this->session->userdata('username');
            $content['user_id'] = $this->session->userdata('userid');
            $content['level'] = $this->session->userdata('level');
            $content['lokasi'] = $this->loadmodel->loadlokasi();
            $content['industri'] = $this->loadmodel->loadindustri();
            $content['edukasi'] = $this->loadmodel->loadEdukasi();
            $content['spesialisasi'] = $this->loadmodel->loadSpesialisasi();
            $content['level'] = $this->loadmodel->loadLevel();

            $this->load->view('admin/view_training', $content);
        } else {
            redirect('admin');
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('userid');
        redirect('admin');
    }

}
