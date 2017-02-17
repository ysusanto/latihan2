<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home_admin
 *
 * @author henrikus
 */
class home_admin extends CI_Controller {
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
//        $this->load->model('ws/registerlogin_model', 'registermodel');
//        $this->load->model('ws/invition_model', 'inviteModel');
//        $this->load->model('ws_global_model', 'globalmodel');
//        $this->load->model('ws/home_model', 'homeModel');
//        $this->load->model('ws/shop_model', 'shopModel');
//        $this->load->model('ws/product_model', 'itemModel');
//         $this->load->controller('ws/RegisterLogin', 'registerlogin');
//           $this->load->controller('ws/home', 'home');
        // $this->loadConfig();
    }

    public function index() {
        $data = array();
        
        $this->load->view('admin/login');
    }
    
}
