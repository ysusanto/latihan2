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
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('ws/registerlogin_model', 'registermodel');
//        $this->load->model('ws/invition_model', 'inviteModel');
        $this->load->model('ws_global_model', 'globalmodel');
//        $this->load->model('ws/home_model', 'homeModel');
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
        $this->load->view("home_view", $data);
    }

    function register() {
//        $this->load->view("home_view", $data);
        $this->load->view('register');
    }

    function inv() {
        $balikan = array();
        $shop_id = $this->uri->segment(3, 0);
        $cond = array(
            'fdelete' => '1',
            '_id' => new MongoId($shop_id)
        );

        $data_toko = $this->globalmodel->getOneRecordWithCond($cond, 'tshop');
        if (sizeof($data_toko) > 0) {
            $balikan['data_toko'] = $data_toko;
        }

        $this->load->view('invition', $balikan);
    }

    function inv2() {
        $balikan = array();
        $shop_id = $this->uri->segment(3, 0);
        $cond = array(
            'fdelete' => '1',
            '_id' => new MongoId($shop_id)
        );

        $data_toko = $this->globalmodel->getOneRecordWithCond($cond, 'tshop');
        if (sizeof($data_toko) > 0) {
            $balikan['data_toko'] = $data_toko;
        }

        $this->load->view('invition2', $balikan);
    }

    function registerurl() {
        $data = array();
//        $respond = 'ok';
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
//        print_r($data);
//        die(0);
        $insertpendinginvite = $this->registermodel->PendingInvite($data);
        if ($insertpendinginvite == '11') {
            $respond = $this->globalmodel->Message('11');
        }
//         $newname = "/installermobile/" . $ins['file'];
//        $path = base_url() . 'installermobile/boleci.apk';
        $path = 'http://installer.seatechmobile.com/boleci/boleci.apk';
//        $datafile = file_get_contents($path);
//        print_r($datafile);
//        die(0);
//        $downloadIntaler = $this->download($path);
        echo $path;

        //masuk ke pending invition
    }

    function geturl() {
        $data = array();
//        $respond = 'ok';
//        foreach ($_POST as $key => $value) {
//            $data[$key] = $value;
//        }
//        print_r($data);
//        die(0);
//        $insertpendinginvite = $this->registermodel->PendingInvite($data);
//        if ($insertpendinginvite == '11') {
//            $respond = $this->globalmodel->Message('11');
//        }
//         $newname = "/installermobile/" . $ins['file'];
//        $path = base_url() . 'installermobile/boleci.apk';
        $path = 'http://installer.seatechmobile.com/boleci/boleci.apk';
//        $datafile = file_get_contents($path);
//        print_r($datafile);
//        die(0);
//        $downloadIntaler = $this->download($path);
        echo $path;

        //masuk ke pending invition
    }

    public function download($path) {

        //load the download helper
        $this->load->helper('download');
        //Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
        $data = file_get_contents($path);
//                $data = file_get_contents("installermobile/image_upload.jpg");
        //Read the file's contents
        $name = 'boleci.noextension';
// print_r($data);
//        die(0);
        //use this function to force the session/browser to download the file uploaded by the user 
        force_download($name, $data);
    }

    function do_upload() {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $upload = $this->globalmodel->uploadfile();
        $data = array('nama' => 'boleci', 'path' => $upload, 'create_date' => $date);
        $insert = $this->globalmodel->insertToDatabase('tupload_installer', $data);
        print_r($upload);
    }

}
