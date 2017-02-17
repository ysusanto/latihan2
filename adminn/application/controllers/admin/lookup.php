<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lookup
 *
 * @author ASUS
 */
class lookup extends CI_Controller {

    function lookup() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('admin/login_model', 'login_model');
//        $this->load->model('ws/invition_model', 'inviteModel');
//        $this->load->model('ws_global_model', 'globalmodel');
        $this->load->model('admin/lookup_model', 'lookupModel');
//        $this->load->model('ws/home_model', 'homeModel');
//        $this->load->model('ws/shop_model', 'shopModel');
//        $this->load->model('ws/product_model', 'itemModel');
//         $this->load->controller('ws/RegisterLogin', 'registerlogin');
//           $this->load->controller('ws/home', 'home');
        // $this->loadConfig();
    }
    function viewkategori(){
         $data['lookup_id'] = $this->input->get('lookup_id');
//            print_r($data);die(0);
        $viewkategory = $this->lookupModel->getkategory($data);

        echo $viewkategory;
    }
    
    function addkategori(){
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
//            print_r($data);die(0);
        $addcategori = $this->lookupModel->addkategori($data);

        echo $addcategori;
    }
    function deletekategori(){
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
//            print_r($data);die(0);
        $addcategori = $this->lookupModel->deletekategori($data);

        echo $addcategori;
    }
    //put your code here
}
