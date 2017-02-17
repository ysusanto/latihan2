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
class useraccess extends CI_Controller {
    function useraccess() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('admin/login_model', 'login_model');
//        $this->load->model('ws/invition_model', 'inviteModel');
//        $this->load->model('ws_global_model', 'globalmodel');
        $this->load->model('admin/user_model','useraccess');
//        $this->load->model('ws/home_model', 'homeModel');
//        $this->load->model('ws/shop_model', 'shopModel');
//        $this->load->model('ws/product_model', 'itemModel');
//         $this->load->controller('ws/RegisterLogin', 'registerlogin');
//           $this->load->controller('ws/home', 'home');
        // $this->loadConfig();
    }
    
//    function registerusercms(){
//       if ($this->session->userdata('username') == false) {
//            $data = array();
//            foreach ( $_POST as $key => $value ){
//                $data[$key]=$value;
//            }
//            $balikan = array();
//            if($data['username'] == '' || $data['password'] == '' ){
//                $balikan = array(
//                    'status' => 0,
//                    'message' => 'Harap lengkapi data registrasi Anda'
//                );
//            }else{
//                $ceklogin = $this->login_model->cekUser($data);
//                if($ceklogin == 0){
//                    $balikan = array(
//                        'status' => 0,
//                        'message' => 'Username sudah digunakan'
//                    );
//                }else{
//                    $data['user_id'] = $this->login_model->createUser($data);
//                    if($data['user_id'] != '11'){
////                        if(isset($data['shopid'])){
////                            $this->webshop_model->followShop($data);
////                        }
//                        $data['user_id']=$data['user_id']->{'$id'};
//                        $userlogin = $this->login_model->createlogin($data);
//                        if($userlogin){
////                            $userdata = array(
////                                'username' => $data['username'],
////                                'userid' => $data['user_id']
////                            );
////                            $this->session->set_userdata($userdata);
//                            $balikan = array(
//                                'status' => 1,
//                                'message' => 'Anda telah berhasil mendaftar'
//                            );
//                        }else{
//                            $balikan = array(
//                                'status' => 0,
//                                'message' => 'Terjadi kesalahan. Silakan coba lagi'
//                            );
//                        }
//                    }else{
//                        $balikan = array(
//                            'status' => 0,
//                            'message' => 'Terjadi kesalahan. Silakan coba lagi'
//                        );
//                    }              
//                }
//                
//            }
//            echo json_encode($balikan);
//        } else {
//            redirect('admin');
//        } 
//    }
    function viewuser(){
//      if ($this->session->userdata('username') == false) {
            $viewdata=$this->useraccess->viewuser();
            echo json_encode($viewdata);
//        } else {
//            redirect('admin');
//        }   
        
        
    }
    function deleteuser(){
        $data = array();
            foreach ( $_POST as $key => $value ){
                $data[$key]=$value;
            }
//            print_r($data);die(0);
            $deleteuser=$this->useraccess->deleteUser($data);
            
            echo $deleteuser;
    }


    //put your code here
}
