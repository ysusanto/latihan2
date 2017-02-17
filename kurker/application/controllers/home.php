<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author ASUS
 */
class home extends CI_Controller{
    //put your code here
    
    function home() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
//        $this->load->model('ws/registerlogin_model', 'registermodel');
       
    }
    function index(){
        $this->load->view('header.php');
    }
}
