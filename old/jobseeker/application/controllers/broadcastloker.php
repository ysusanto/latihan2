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
class broadcastloker extends CI_Controller {

    function broadcastloker() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
//        $this->load->model('registerlogin_model');
        $this->load->model('db_load');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

//
//    public function index() {
//        $content['username'] = $this->session->userdata('username');
//        $content['user_id'] = $this->session->userdata('userid');
//        $this->load->view('web/home', $content);
//    }
//
//    public function login() {
//        $content['username'] = $this->session->userdata('username');
//        $this->load->view('web/loginmanage', $content);

    function loker() {
//        echo 'abc';
//        die(0);
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        print_r($data);
        die(0);

        $savebrocas = $this->broadcastloker_model->SaveBroadcastloker($data);

        echo json_encode($savebrocas);
    }

//public function cheklogin() {
////        print_r('ancuk');die(0);
////        if ($this->session->userdata('username') == false) {
//$data = array();
//foreach ($_POST as $key => $value) {
//$data[$key] = $value;
//}
////                            print_r($data);die(0);
//$reg = $this->registerlogin_model->ChekLogin($data);
////                                        print_r($reg);die(0);
//if ($reg != "error") {
//$userdata = array(
//'userid' => $reg['id_user'],
// 'username' => $reg['username'],
// 'nama' => $reg['nama'],
// 'status' => $reg['id_sttsuser']
//);
//$this->session->set_userdata($userdata);
////                print_r($userdata);die(0);
////            $param['menu'] = $menu = $this->db_load->listmenu($reg['id_sttsuser']);
////
////            $kirim['judul'] = $this->load->view('header2', $param, TRUE);
//////                print_r($param);die(0);
////            $kirim['isi'] = $this->load->view('home_user', $param, TRUE);
//echo 'ok'; // redirect('registerlogin/afterlogin'); //
//} else {
//echo "Username atau password yang anda masukan salah. Harap coba kembali!!";
//}
//
////            
////        } else {
////            print_r('ancuk');
////            redirect('home_view');
////        }
//}
//
//function afterlogin() {
//if ($this->session->userdata('username') == TRUE) {
//$param['menu'] = $menu = $this->db_load->listmenu($this->session->userdata('status'));
//
//$kirim['judul'] = $this->load->view('header2', $param, TRUE);
////                print_r($param);die(0);
//$kirim['isi'] = $this->load->view('home_user', $param, TRUE);
//$this->load->view('template', $kirim);
//} else {
//redirect('home');
//}
//}
//
//public function logout() {
//$this->session->unset_userdata('username');
//$this->session->unset_userdata('userid');
//$this->session->unset_userdata('nama');
//$this->session->unset_userdata('status');
//echo 'ok';
//}
}
