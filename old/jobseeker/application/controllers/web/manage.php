<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @Roberto
 */
class manage extends CI_Controller {

    function manage() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('ws/webregisterlogin_model');
        $this->load->model('ws/webshop_model');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    public function index() {
        $content['username'] = $this->session->userdata('username');
        $content['user_id'] = $this->session->userdata('userid');
        if ($content['username'] == false) {
            redirect('manage/login');
        }else{
            $content['shopdetail'] = $this->webshop_model->getshopdetail($content);
            $content['userdetail'] = $this->webregisterlogin_model->getuserdetail($content);
            //$content['items'] = $this->webshop_model->getallitem($content);
            $this->load->view('web/manageshop',$content);
        }
    }
    
    public function login(){
        $content['username'] = $this->session->userdata('username');
        $this->load->view('web/loginmanage',$content);
    }
    
    public function cekLogin(){
        if ($this->session->userdata('username') == false) {
            $data = array();
            foreach ( $_POST as $key => $value ){
                $data[$key]=$value;
            }
            $reg = $this->webregisterlogin_model->ChekLogin($data);
            if($reg['status'] == "1"){
                $userdata = array(
                    'username' => $reg['data']['userdetail']['username'],
                    'userid' => $reg['data']['userdetail']['user_id']
                );
                $this->session->set_userdata($userdata);
            }
            redirect('manage');
        } else {
            redirect('manage');
        }
    }
    
    public function logout(){
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('userid');
    }
}
