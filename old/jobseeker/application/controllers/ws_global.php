<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of ws_global
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class ws_global extends CI_Controller {

    function ws_global() {

        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file', 'cookie'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('image_lib');

        $this->load->library('email');
        $this->load->model('ws/registerlogin_model', 'registermodel');
        $this->load->model('ws_global_model', 'globalmodel');
        $this->load->model('ws/invition_model', 'inviteModel');
        $this->load->model('ws/home_model', 'homeModel');
        $this->load->model('ws/shop_model', 'shopModel');
        $this->load->model('ws/product_model', 'itemModel');
          $this->load->model('ws/notification', 'notifModel');
//         $this->load->controller('ws/RegisterLogin', 'registerlogin');
//           $this->load->controller('ws/home', 'home');
        // $this->loadConfig();
    }

    public function index() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
//print_r($data);die(0);
        switch (strtolower($data['keyword'])) {
            case 'register':
                $content = $this->Register($data, "regist");
                echo $content;
                //$content;
                break;
            case 'verify':
                $content = $this->Register($data, "verify");
                echo $content;
                break;
            case 'profile':
//                print_r($data);die(0);
                $content = $this->Register($data, "profile");
                echo $content;
                break;
            case 'chek_user':
//                 print_r($data);die(0);
                $content = $this->registermodel->ChekUSer($data);
                echo $content;
                break;
            case 'login':
                $content = $this->Login($data, 'login');
                echo $content;
                break;
            case 'confirm_login':
                $content = $this->Login($data, 'konfirm');
                echo $content;
                break;
            case 'get_shop':
                $content = $this->Get_shop($data);
                echo $content;
                break;

            case 'get_item':
                $content = $this->Get_item($data);
                echo $content;
                break;
            case 'get_item_detail':
                $content = $this->itemModel->Get_item_detail($data);
                echo $content;
                break;
            case 'newrelease':
                $content = $this->newrelease();
                echo $content;
                break;
            case 'like':
                $content = $this->itemModel->Like($data);
                echo $content;
                break;
            case 'dislike':
                $content = $this->itemModel->unLike($data);
                echo $content;
                break;
            case 'favorite':
                $content = $this->Favorite($data);
                echo $content;
                break;
            case 'addfollow':
                $content = $this->Follow($data);
                echo $content;
                break;
            case 'follower':
                $content = $this->Follower($data);
                echo $content;
                break;
            case 'invite':
                $content = $this->Invite($data);
                echo $content;
                break;
            case 'save_shop':
                $content = $this->profile_shop($data, 'c');
                echo $content;
                break;
            case 'edit_shop':
                $content = $this->profile_shop($data, 'e');
                echo $content;
                break;
            case 'save_item':
                $content = $this->profile_item($data, 'c');
                echo $content;
                break;
            case 'edit_item':
                $content = $this->profile_item($data, 'e');
                echo $content;
                break;
            case 'get_lookup':
                $content = $this->Get_lookup($data);
                echo $content;
                break;
            case 'add_lookup':
                $content = $this->insert_lookup($data);
                echo $content;
                break;
            case 'add_sublookup':
                $content = $this->insert_sublookup($data);
                echo $content;
                break;
            case 'get_category':
                $content = $this->get_listCategory($data);
                echo $content;
                break;
            case 'change_is_soldout':
                $content = $this->edit_is_soldout($data);
                echo $content;
                break;
            case 'notif':
                 $content = $this->cheknotif($data);
//                $content = $this->notifModel->cheknotif($data);
                echo $content;
                break;
        }
    }
    function cheknotif($data) {
        $hasil = array();
        $notif = $this->notifModel->cheknotif($data);
        if (sizeof($notif) > 0) {
            $hasil = $notif;

            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $balikan = array(
            'data' => $hasil,
            'message' => $msg,
            'status' => $status
        );
        return json_encode($balikan);
    }
    //Momo
    function edit_is_soldout($data){
        $databalikan = array();
         date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d h:i:sa');
        //get data item dan detail item
         $cond = array(
                '_id' => new MongoId($data['item_id']),
                'fdelete' => '1'
            );
      
        $dataItem = $this->globalmodel->getOneRecordWithCond($cond, "tproduct");
      
        if (count($dataItem) > 0)
        {
            $isSoldOut = "1";
            if (array_key_exists("is_sold", $dataItem))
            {
                if ($dataItem["is_sold"] == "1")
                    $isSoldOut = "0";
                else
                    $isSoldOut = "1";
            }
            else{
                $isSoldOut = "0";
            }
            $set = array(
                    '_id' => new MongoId($data['item_id']),
                    'subcategory_id' => new MongoId($dataItem['subcategory_id']),
                    'shop_id' => new MongoId($dataItem['shop_id']),
                    'nama' => $dataItem['nama'],
                    'modified_date' => $createdate,
                     'jumlah' => $dataItem['jumlah'],
                    'harga' => $dataItem['harga'],
                    'fdelete' => "1",
                    'desc' => $dataItem['desc'],
                    'create_date' => $dataItem['create_date'],
                    'create_by'=>$dataItem['create_by'],
                    'is_sold'=>$isSoldOut)
            ;
//            $set = array('$set' => $set);
       
        $dataupdate = array($cond, $set);
//        echo json_encode($set);d
        $update = $this->globalmodel->UpdateRecordWithCond($cond, $set, 'tproduct');
        
        }
        
          
        
        $databalikan = array(
                "data" => array(),
                "message" => "Sukses",
                "status" => "1"
            );
        return json_encode($databalikan);
    }

    function Register($data, $type) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $hasil = array();
        if (strtolower($type) == 'regist') {
            $data['kode_verify'] = $this->registermodel->Verifikasi($data);


            $insertverivikasi = $this->registermodel->InsertVerifikasi($data);


            if ($insertverivikasi != '11') {

                $tabel = "temp_verifikasi";
                $action = "Insert telp : " . $data['no_telp'];
                $stat = " status : Success";



                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message($insertverivikasi);
                $status = "0";

                $tabel = "temp_verifikasi";
                $action = "Insert telp : " . $data['no_telp'];
                $stat = " status : Gagal";
            }
            $insertlog = $this->globalmodel->InsertTLog($tabel, $action, $stat);


            $databalikan = array(
                "data" => array(
                    "kode_verifikasi" => $data['kode_verify']
                ),
                "message" => $msg,
                "status" => $status
            );
        } else if (strtolower($type) == 'verify') {

            $syarat = array(
                "telp" => $data['no_telp'],
                "kode_verify" => $data['kode_verifikasi']
            );
            $chekverify = $this->globalmodel->getRecordWithCondition('temp_verifikasi', $syarat);
            if (sizeof($chekverify) > 0) {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
                //merchant list belum 
                $cond = array('no_telp' => $data['no_telp']);
                $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, 'tuser');
//                print_r($cheklogin);die(0);
                if (sizeof($cheklogin) > 0) {
                    $msg = $this->globalmodel->Message('10');
                    $status = "1";
                    $hasil = array(
                        'user_id' => $cheklogin['_id']->{'$id'}
                    );
                    $condshop = array(
                        'user_id' => $cheklogin['_id']
                    );
                    $cheklgn = $this->globalmodel->getOneRecordWithCond($condshop, 'tlogin');
                    $chekshop = $this->shopModel->Get_one_shopuser($condshop);
//                    print_r($chekshop);die(0);
                    if (sizeof($chekshop) > 0) {
                        $hsl = $chekshop;
                    } else {
                        //momo mark
                        $hsl = NULL;
//                        $hsl = array();
                    }
                    $hasil = array(
                        'username' => (isset($cheklgn['username']) ? $cheklgn['username'] : ''),
                        'user_id' => $cheklogin['_id']->{'$id'}
                    );
                    $hasil['listshop'] = $hsl;
                } else {

                    $saveuser = $this->registermodel->InsertUser($data);
                    $data['user_id']=$saveuser;
                     $savemobile = $this->registermodel->InsertmobileData($data);
                    if ($saveuser != '11') {
                        $msg = $this->globalmodel->Message('10');
                        $status = "1";
                        $tabel = "tuser";
                        $action = "Insert fnama :  " . " " . ", telp : " . $data['no_telp'] . ", alamat : " . "";
                        $stat = " status : success";
                        $date = $date;

                        $data['user_id'] = $saveuser;
                        $chekpendinginvite = $this->inviteModel->ChekPendingInvite($data);
                        if (sizeof($chekpendinginvite) > 0) {
                            foreach ($chekpendinginvite as $add) {
                                $dt = array(
                                    'shop_id_followed' => $add['shop_id_inviter'],
                                    'user_id_follower' => $add['userdata']['user_id']
                                );

                                $follower = $this->homeModel->AddFollower($dt);
                            }
                        }
                        //handle pending invition

                        $hasil = array(
                            'user_id' => $saveuser->{'$id'}
                        );
                        //momo mark
                        $hasil['listshop'] = null;
//                        $hasil['listshop'] = array();
                        $insertlog = $this->globalmodel->InsertTLog($tabel, $action, $stat);
                    } else {
                        $msg = $this->globalmodel->Message('11');
                        $status = "0";
                    }
                }
            } else {
                $msg = $this->globalmodel->Message('12');
                $status = "0";
            }


            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        } else {
//            print_r($data);die(0);
            $cond = array(
//                'username' => strtolower($data['username']),
                'user_id' => new MongoId($data['user_id'])
//                'password'=> md5($data['password'])
                );
            $cheklogin = $this->globalmodel->getOneRecordWithCond($cond, 'tlogin');
              
            if (sizeof($cheklogin) > 0) {
                $msg = $this->globalmodel->Message('14');
                $status = "0";
            } else {
                //status level msh ragu dari client ato server

                $savelogin = $this->registermodel->InsertLogin($data);
               
//                print_r($savelogin);die(0);
//                 print_r($savelogin);die(0);
                $shoplist = array();
                if ($savelogin != '11') {
                    $msg = $this->globalmodel->Message('10');
                    $status = "1";

                    $condchekshop = array(
                        'user_id' => $data['user_id']
                    );
                    $chekshop = $this->shopModel->Get_shopwithcondition($condchekshop);
//                    print_r($chekshop);die(0);
                    if (sizeof($chekshop) > 0) {
                        $shoplist = $chekshop;
                    }
                    $cond = array('telp' => $data['no_telp']);
                    $set = array('$set' => array('fdelete' => '0'));
                    $kondisi = array($cond, $set);
                    $deleteverivikasi = $this->registermodel->DeleteVerifikasi($cond);
//                     $deleteverivikasi = $this->registermodel->DeleteVerifikasi($condchekshop);
                    $hasil = array(
                        'user_id' => $data['user_id'],
                        'shop_list' => $shoplist
                    );


                    $tabel = "tlogin";
                    $action = "Insert username :  " . $data['username'] . ", password : " . md5($data['password']);
                    $stat = " status : success";

                    $insertlog = $this->globalmodel->InsertTLog($tabel, $action, $stat);
                } else {
                    $msg = $this->globalmodel->Message('11');
                    $status = "0";

                    $tabel = "tlogin";
                    $action = "Insert username :  " . $data['username'] . ", password : " . md5($data['password']);
                    $stat = " status : error";

                    $insertlog = $this->globalmodel->InsertTLog($tabel, $action, $stat);
                }
            }
           
            
            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        }

        return json_encode($databalikan);
//        $getallmarket = $this->shopmodel->getallmarket($data);
    }

    function Login($data, $type) {

        if ($type == 'login') {
            if (isset($data['no_telp']) && $data['no_telp'] != '') {
                $nameindex = 'telp';
                $dttlp = $data['no_telp'];
            } else {
                $nameindex = '';
                $dttlp = '';
            }
            $syarat = array(
                "username" => $data['username'],
                "password" => $data['password'],
                $nameindex => $dttlp
            );
            $chekLogin = $this->registermodel->ChekLogin($syarat);
            $databalikan = array(
                "data" => $chekLogin['data'],
                "message" => $chekLogin['msg'],
                "status" => $chekLogin['status']
            );
        } else {
            $chekLogin = $this->registermodel->ConfirmLogin($data);
            $databalikan = $chekLogin;
        }


        return json_encode($databalikan);
    }

    function Get_shop($data) {
        if (isset($data['l_id']) && isset($data['f_id']) && $data['f_id'] == '' && $data['l_id'] == '') {


            $getdata = $this->homeModel->Get_shop();
            if (sizeof($getdata) > 0) {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $hasil = array();
            $hasil['shop'] = $getdata;
            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        } else {

            $getdata = $this->homeModel->Get_shop_withcond($data);
            if (sizeof($getdata) > 0) {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $hasil = array();
            $hasil['shop'] = $getdata;
            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        }
        return json_encode($databalikan);
    }

    function Get_Item($data) {
        if (!isset($data['l_id']) || !isset($data['f_id'])) {
//            print_r('abc');die(0);
            $dataitem = array();
            $dataitem['cond'] = array(
                'fdelete' => '1',
                'shop_id' => new MongoId($data['shop_id'])
            );
            $dataitem['limitproduct'] = 30;
            $dataitem['sort'] = array('modified_date' => -1);
            $getdata = $this->homeModel->Get_Item($dataitem);
            if (sizeof($getdata) > 0) {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $hasil = array();
            $hasil['item'] = $getdata;
            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        } else {

            $getdata = $this->homeModel->Get_item_withcond($data);
            if (sizeof($getdata) > 0) {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $hasil = array();
//            echo json_encode($getdata);die(0);/
            $hasil['item'] = $getdata;
            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        }
        return json_encode($databalikan);
    }

    function Profile_shop($data, $type) {
//        $databalikan=array();
        $hasil = array();
        if ($type == 'c' && isset($data['user_id']) && $data['user_id'] != '') {
            $saveshop = $this->shopModel->save_shop($data);
            if ($saveshop != '11') {
                $hasil = $saveshop;
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $hasil = array(
                'shop_id' => $saveshop->{'$id'}
            );

            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        } else if ($type == 'e' && isset($data['shop_id']) && $data['shop_id'] != '') {
            $hasil = array();
            $updateshop = $this->shopModel->Update_Shop($data);
//            print_r('aaa');die(0);
            if ($updateshop['msg'] != '11') {

                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $databalikan = array(
                "data" => $updateshop['data'],
                "message" => $msg,
                "status" => $status
            );
        }
//        else if ($type == 'e' && isset($data['shop_id']) && $data['shop_id'] != '') {
//            $hasil = array();
//            $chekshop = $this->shopModel->Get_one_shop($data);
//            if (sizeof($chekshop) > 0) {
//                $hasil = $chekshop;
//                $msg = $this->globalmodel->Message('10');
//                $status = "1";
//            } else {
//                $msg = $this->globalmodel->Message('13');
//                $status = "0";
//            }
//            $databalikan = array(
//                "data" => $hasil,
//                "message" => $msg,
//                "status" => $status
//            );
//        }
        return json_encode($databalikan);
    }

//    ari's work
//    function Profile_item($data, $type) {
//        $databalikan = array();
//        $hasil = array();
//        if ($type == 'c' && isset($data['shop_id']) && $data['shop_id'] != '') {
//            $saveitem = $this->itemModel->save_Item($data);
//            if ($saveitem != '11') {
//                $hasi = $saveitem;
//                $msg = $this->globalmodel->Message('10');
//                $status = "1";
//            } else {
//                $msg = $this->globalmodel->Message('13');
//                $status = "0";
//            }
//            $hasil = array('item_id' => $saveitem->{'$id'});
//
//            $databalikan = array(
//                "data" => $hasil,
//                "message" => $msg,
//                "status" => $status
//            );
//        } else if ($type == 'e' && isset($data['item_id']) && $data['item_id'] != '') {
//            $hasil = array();
//            $updateitem = $this->itemModel->Update_Item($data);
//            if ($updateitem['msg'] == '10') {
//                $msg = $this->globalmodel->Message('10');
//                $status = "1";
//                $hasil = $updateitem;
//            } else {
//                $msg = $this->globalmodel->Message('13');
//                $status = "0";
//            }
//            $databalikan = array(
//                "data" => $hasil,
//                "message" => $msg,
//                "status" => $status
//            );
//        }
////        else if ($type == 'e' && isset($data['item_id']) && $data['item_id'] != '') {
////            $hasil = array();
////            $chekitem = $this->itemModel->Get_one_Item($data);
////            if (sizeof($chekitem) > 0) {
////                $hasil = $chekitem;
////                $msg = $this->globalmodel->Message('10');
////                $status = "1";
////            } else {
////                $msg = $this->globalmodel->Message('13');
////                $status = "0";
////            }
////            $databalikan = array(
////                "data" => $hasil,
////                "message" => $msg,
////                "status" => $status
////            );
////        }
//        return json_encode($databalikan);
//    }
    
   //Momo Work kalo ga ngerti pukulin aja Bismonya 
    function Profile_item($data, $type) {
        $helperArray = array();
        $returnedData = array();
        $hasil = array();
        if ($type == 'c' && isset($data['shop_id']) && $data['shop_id'] != '') {
            $saveitem = $this->itemModel->save_Item($data);
            if ($saveitem != '11') {
                $hasil = $saveitem;
                $msg = $this->globalmodel->Message('10');
                $status = "1";
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $hasil = array('item_id' => $saveitem->{'$id'});

            $databalikan = array(
                "data" => $hasil,
                "message" => $msg,
                "status" => $status
            );
        } else if ($type == 'e' && isset($data['item_id']) && $data['item_id'] != '') {
            $hasil = array();
            $updateitem = $this->itemModel->Update_Item($data);
            if ($updateitem['msg'] == '10') {
                $msg = $this->globalmodel->Message('10');
                $status = "1";
                $hasil = $updateitem;
            } else {
                $msg = $this->globalmodel->Message('13');
                $status = "0";
            }
            $databalikan = array(
                "message" => $msg,
                "status" => $status,
                "data" => $updateitem["data"]
            );
//            print_r($updateitem["data"]);die(0);
//            array_merge($databalikan,$updateitem);
        }
//        else if ($type == 'e' && isset($data['item_id']) && $data['item_id'] != '') {
//            $hasil = array();
//            $chekitem = $this->itemModel->Get_one_Item($data);
//            if (sizeof($chekitem) > 0) {
//                $hasil = $chekitem;
//                $msg = $this->globalmodel->Message('10');
//                $status = "1";
//            } else {
//                $msg = $this->globalmodel->Message('13');
//                $status = "0";
//            }
//            $databalikan = array(
//                "data" => $hasil,
//                "message" => $msg,
//                "status" => $status
//            );
//        }
        return json_encode($databalikan);
    }

    function Get_lookup($data) {
        $coll = 'tlookup';
        $hasil = array();
        $lk = array();
        //type=1 lokasi,2=kategory,3=jenis inveite,4=negara


        if ($data['type'] != '2') {
            $cond = array(
                'fdelete' => '1',
                'type' => $data['type']);
            $getdt = $this->globalmodel->getRecordWithCondition($coll, $cond);
            $sub = array();
            foreach ($getdt as $dt) {
                $dt['lookup_id'] = $dt['_id']->{'$id'};
                if ($data['type'] == '2') {
                    $cond = array(
                        'fdelete' => '1',
                        'lookup_id' => $dt['_id']);
                    $getdtsub = $this->globalmodel->getRecordWithCondition('tsub_lookup', $cond);
                    $sub = array();
                    foreach ($getdtsub as $sb) {
                        $sb['sub_lookup_id'] = $dt['_id']->{'$id'};
                        unset($sb['fdelete']);
                        unset($sb['_id']);
                        unset($sb['create_date']);
                        unset($sb['modified_date']);
                        unset($sb['lookup_id']);
                        array_push($sub, $sb);
                    }
                }

                $dt['sub_lookup'] = $sub;
                unset($dt['fdelete']);
                unset($dt['_id']);
                unset($dt['create_date']);
                unset($dt['modified_date']);
                unset($dt['type']);
                array_push($lk, $dt);
            }
        } else {
            $cond = array(
                'fdelete' => '1',
            );
            $getdtsub = $this->globalmodel->getRecordWithCondition('tsub_lookup', $cond);
            $sub = array();
            foreach ($getdtsub as $sb) {
                $sb['lookup_id'] = $sb['_id']->{'$id'};
                $sb['nama'] = $sb['nama_sub'];
                unset($sb['fdelete']);
                unset($sb['_id']);
                unset($sb['create_date']);
                unset($sb['modified_date']);
                unset($sb['nama_sub']);
//                    unset($sb['lookup_id']);
                array_push($sub, $sb);
            }
            $lk = $sub;
        }
        if (sizeof($lk) > 0) {
            $hasil = $lk;
            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $databalikan = array(
            "data" => $hasil,
            "message" => $msg,
            "status" => $status
        );
        return json_encode($databalikan);
    }

    function insert_lookup($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $coll = 'tlookup';
        $hasil = array();
        //type=1 lokasi,2=kategory,3=jenis inveite,4=negara

        $datainsert = array(
            'nama' => $data['nama'],
            'type' => $data['type'],
            'fdelete' => '1',
            'create_date' => $date,
            'modified_date' => $date
        );
        $inst = $this->globalmodel->insertToDatabase($coll, $datainsert);
        if ($inst != '11') {
            $hasil = $inst;
            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $databalikan = array(
            "data" => $hasil,
            "message" => $msg,
            "status" => $status
        );
        return json_encode($databalikan);
    }

    function insert_sublookup($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d h:i:sa');
        $coll = 'tsub_lookup';
        $hasil = array();
        //type=1 lokasi,2=kategory,3=jenis inveite,4=negara

        $datainsert = array(
            'nama_sub' => $data['nama_sub'],
            'lookup_id' => new MongoId($data['lookup_id']),
            'fdelete' => '1',
            'create_date' => $date,
            'modified_date' => $date
        );
        $inst = $this->globalmodel->insertToDatabase($coll, $datainsert);
        if ($inst != '11') {
            $hasil = $inst;
            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $databalikan = array(
            "data" => $hasil,
            "message" => $msg,
            "status" => $status
        );
        return json_encode($databalikan);
    }

    function Todays_hot() {
        $hasil = array();
        $todayshot = $this->itemModel->TodaysHot();
        if (sizeof($todayshot) > 0) {
            $hasil = $todayshot;

            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $balikan = array(
            'data' => $hasil,
            'message' => $msg,
            'status' => $status
        );
        return json_encode($balikan);
    }

    function Favorite($data) {
        $hasil = array();
        $favoriteitem = $this->itemModel->favorite_item($data);
        if (sizeof($favoriteitem) > 0) {
            $hasil = $favoriteitem;

            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $balikan = array(
            'data' => $hasil,
            'message' => $msg,
            'status' => $status
        );
        return json_encode($balikan);
    }

    function invite($data) {

        $url = array();

        $url['url'] = trim(base_url() . "home/inv/" . $data['shop_id']);
        $balikan = array(
            'data' => $url,
            'message' => 'succes',
            'status' => '1'
        );
        return json_encode($balikan);
    }

    function Follow($data) {
        $hasil = array();
        $followshop = $this->homeModel->AddFollower($data);
        if ($followshop == '10') {
            $hasil = array();

            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $balikan = array(
            'data' => $hasil,
            'message' => $msg,
            'status' => $status
        );
        return json_encode($balikan);
    }

    function Follower($data) {
        $hasil = array();
//        print_r($data);die(0);
        $followshop = $this->homeModel->Follower($data);
        if (sizeof($followshop) > 0) {
            $hasil = $followshop;

            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $balikan = array(
            'data' => $hasil,
            'message' => $msg,
            'status' => $status
        );
        return json_encode($balikan);
    }

    function newrelease() {
        $hasil = array();
//        print_r($data);die(0);
        $newrelease = $this->homeModel->newrelease();
        if (sizeof($newrelease) > 0) {
            $hasil = $newrelease;

            $msg = $this->globalmodel->Message('10');
            $status = "1";
        } else {
            $msg = $this->globalmodel->Message('13');
            $status = "0";
        }
        $balikan = array(
            'data' => $hasil,
            'message' => $msg,
            'status' => $status
        );
        return json_encode($balikan);
    }

    //put your code here
}
