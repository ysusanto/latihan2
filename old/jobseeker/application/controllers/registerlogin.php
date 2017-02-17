<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @ari
 */
class registerlogin extends CI_Controller {

    function registerlogin() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('registerlogin_model');
        $this->load->model('db_load');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    public function index() {
        $content['username'] = $this->session->userdata('username');
        $content['user_id'] = $this->session->userdata('userid');
        $this->load->view('web/home', $content);
    }

    public function login() {
        $content['username'] = $this->session->userdata('username');
        $this->load->view('web/loginmanage', $content);
    }

    function register() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
//        print_r($data);die(0);
        if($data['username']=='' || $data['password']=='' || $data['email']=='' || $data['nama']==""){
            $balikan = array('status' => '0',
                    'pesan' => "data tidak lengkap harap di chek kembali");
        }else{
//            print_r('smpini');die(0);
        $chekusername = $this->registerlogin_model->chekuser($data);
//        print_r($chekusername);die(0);
        if ($chekusername == '0') {
            $balikan = array('status' => '0',
                'pesan' => "username sudah ada, silahkan coba kembali");
        } else {
            $savereg = $this->registerlogin_model->SaveRegister($data);
            if ($savereg == 'ok') {
                $balikan = array('status' => '1',
                    'pesan' => "register Sukses");
            } else {
                $balikan = array('status' => '0',
                    'pesan' => "Ada Kesalahan dalam penyimpanan harap coba lagi");
            }
        }
        }

        echo json_encode($balikan);
    }

    public function cheklogin() {
//        print_r('ancuk');die(0);
//        if ($this->session->userdata('username') == false) {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
//                            print_r($data);die(0);
        $reg = $this->registerlogin_model->ChekLogin($data);
//                                        print_r($reg);die(0);
        if ($reg != "error") {
            $userdata = array(
                'userid' => $reg['id_user'],
                'username' => $reg['username'],
                'nama' => $reg['nama'],
                'status' => $reg['id_sttsuser']
            );
//            print_r($userdata);die(0);
            $this->session->set_userdata($userdata);
//                print_r($userdata);die(0);
//            $param['menu'] = $menu = $this->db_load->listmenu($reg['id_sttsuser']);
//
//            $kirim['judul'] = $this->load->view('header2', $param, TRUE);
////                print_r($param);die(0);
//            $kirim['isi'] = $this->load->view('home_user', $param, TRUE);
            echo 'ok'; // redirect('registerlogin/afterlogin'); //
        } else {
            echo "Username atau password yang anda masukan salah. Harap coba kembali!!";
        }

//            
//        } else {
//            print_r('ancuk');
//            redirect('home_view');
//        }
    }

    function afterlogin() {
        if ($this->session->userdata('username') == TRUE) {
            $param['menu'] = $menu = $this->db_load->listmenu($this->session->userdata('status'));

            $kirim['judul'] = $this->load->view('header2', $param, TRUE);
//                print_r($param);die(0);
            $kirim['isi'] = $this->load->view('home_user', $param, TRUE);
            $this->load->view('template', $kirim);
        } else {
            redirect('home');
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('status');
        echo 'ok';
    }

}
