<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author user
 */
class home extends CI_Controller {

    //put your code here
    function home() {

        parent::__construct();
        $this->load->helper('string');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('text');

        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('ws/registerlogin_model', 'registermodel');
//        $this->load->model('ws/invition_model', 'inviteModel');
        $this->load->model('ws_global_model', 'globalmodel');
        $this->load->model('profile_model', 'profile');
//        $this->load->model('ws/shop_model', 'shopModel');
//        $this->load->model('ws/product_model', 'itemModel');
//         $this->load->controller('ws/RegisterLogin', 'registerlogin');
//           $this->load->controller('ws/home', 'home');
        // $this->loadConfig();
    }

    public function index() {
        $data = array();
//            print_r($this->session->all_userdata());die();
//        if ($this->session->userdata('unitid') != null) {
//            $data['unitid'] = $this->session->userdata('unitid');
//        }
//        if ($this->session->userdata("function") != null) {
//            $data['function'] = $this->session->userdata("function");
//        }
//        if ($this->session->userdata("access") != null) {
//            $data['access'] = $this->session->userdata("access");
//        } else {
//            $data['access'] = '-1';
//        }
////            print_r($this->session->all_userdata());
//        if ($this->session->userdata('userid') != null) {
//            $userid = $this->session->userdata('userid');
//            $param['mainmenu'] = $this->loadMainModule($this->loadSubModule($userid));
//            $param['submenu'] = $this->loadSubModule($userid);
////            $param['unit'] = $this->loadUnit($userid);
////                print_r($data['unit']);die();
//            $param['userid'] = $this->session->userdata('userid');
////            $param['unitid'] = $this->session->userdata('unitid');
//            $data['HEADERTOP'] = $this->load->view('home_after_login', $param, TRUE);
//        } else {
//            $data['gotologin'] = true;
//        }
//            print_r($data['unit']);die();
//            print_r($data['unitid']);die();
//            print_r($this->session->all_userdata());die();
//        echo 'berhaasil'; die(0);
//        $this->load->view("home_view", $data);
        $param = array();
        $data['judul'] = $this->load->view('header', $param, TRUE);
        $data['isi'] = $this->load->view('home_view', $param, TRUE);
//        print_r($data);die(0);
        $this->load->view('template', $data);
    }

    public function register() {
//        $data=array();
        $param = array();
        if ($this->session->userdata('userid') != null) {
            $userid = $this->session->userdata('userid');
            $param['mainmodule'] = $this->loadMainModule($this->loadSubModule($userid));
            $param['submodule'] = $this->loadSubModule($userid);
            $param['unit'] = $this->loadUnit($userid);
            $param['userid'] = $this->session->userdata('userid');
            $param['unitid'] = $this->session->userdata('unitid');
            $data['HEADERTOP'] = $this->load->view('header_view', $param, TRUE);
        }
        $data['judul'] = $this->load->view('header', $param, TRUE);
        $data['isi'] = $this->load->view('register', $param, TRUE);

//        print_r($data);die(0);
        $this->load->view('template', $data);
    }

    public function profiltki() {
//        $data=array();
        $param = array();
        if ($this->session->userdata('userid') != null) {
            $userid = $this->session->userdata('userid');
            $param['mainmodule'] = $this->loadMainModule($this->loadSubModule($userid));
            $param['submodule'] = $this->loadSubModule($userid);
            $param['unit'] = $this->loadUnit($userid);
            $param['userid'] = $this->session->userdata('userid');
            $param['unitid'] = $this->session->userdata('unitid');
            $data['HEADERTOP'] = $this->load->view('header_view', $param, TRUE);
        }
        $data['judul'] = $this->load->view('header', $param, TRUE);
        $data['isi'] = $this->load->view('update_profiil_tki', $param, TRUE);

//        print_r($data);die(0);
        $this->load->view('template', $data);
    }

    public function profile_kursus() {
//        $data=array();
        $param = array();
        if ($this->session->userdata('userid') != null) {
            $userid = $this->session->userdata('userid');
            $param['menu'] = $this->db_load->listmenu($this->session->userdata['status']);
            $param['view'] = $this->profile->view_kursus($userid);
            $param['industri'] = $this->db_load->load_industri();
//            $param['nama'] = $this->session->userdata('nama');
//            $param['unitid'] = $this->session->userdata('unitid');
//            $data['HEADERTOP'] = $this->load->view('header_view', $param, TRUE);
//        } 
            $data['judul'] = $this->load->view('header2', $param, TRUE);
            $data['isi'] = $this->load->view('update_kursus', $param, TRUE);

//        print_r($data);die(0);
            $this->load->view('template', $data);
        } else {
            redirect('home');
        }
    }

    public function profilpt() {
//        $data=array();
        $param = array();
        if ($this->session->userdata('userid') != null) {
            $userid = $this->session->userdata('userid');
            $param['mainmodule'] = $this->loadMainModule($this->loadSubModule($userid));
            $param['submodule'] = $this->loadSubModule($userid);
            $param['unit'] = $this->loadUnit($userid);
            $param['userid'] = $this->session->userdata('userid');
            $param['unitid'] = $this->session->userdata('unitid');
            $data['HEADERTOP'] = $this->load->view('header_view', $param, TRUE);
        }
        $data['judul'] = $this->load->view('header', $param, TRUE);
        $data['isi'] = $this->load->view('update_profil_pt', $param, TRUE);

//        print_r($data);die(0);
        $this->load->view('template', $data);
    }

    public function loker() {
//        $data=array();
        $param = array();
        if ($this->session->userdata('userid') != null) {
            $status=$this->session->userdata('status');
            $param['menu'] = $this->db_load->listmenu($status);
            $param['industri'] = $this->db_load->load_industri();
//        $userid = $this->session->userdata('userid');
            $param['bidang'] = $this->db_load->load_bidang();
            $param['lokasi'] = $this->db_load->load_lokasi();
            $param['status'] =$this->session->userdata('status');

//         print_r($param);
//                  die(0);
//        }
            $data['judul'] = $this->load->view('header2', $param, TRUE);
            $data['isi'] = $this->load->view('broadcast_loker', $param, TRUE);

//        print_r($data);die(0);
            $this->load->view('template', $data);
        }
    }

    function profile_employe() {
//        print_r($this->session->userdata('userid'));die(0);
        $param = array();
        if ($this->session->userdata('userid') != null) {
//             print_r($this->session->userdata('status'));die(0);
            $status=$this->session->userdata('status');
            $userid=$this->session->userdate('userid');
            $param['menu'] = $this->db_load->listmenu($status);
//            print_r($param);die(0);
            $param['industri'] = $this->db_load->load_industri();
//        $userid = $this->session->userdata('userid');
            $param['bidang'] = $this->db_load->load_bidang();
           
//            $param['lokasi'] = $this->db_load->load_lokasi();
//            $param['profile']=$this->profile->view_tki($userid);
$param['nama']=$this->session->userdata('nama');
//         print_r($param);
//                  die(0);
//        }
            $data['judul'] = $this->load->view('header2', $param, TRUE);
//            $data['judul'] = $this->load->view('header', $param, TRUE);
        $data['isi'] = $this->load->view('update_profiil_tki', $param, TRUE);

        print_r($param);die(0);
            $this->load->view('template', $data);
        }
    }

}
