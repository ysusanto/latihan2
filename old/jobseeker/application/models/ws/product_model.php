<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product_model
 *
 * @author user
 */
class product_model extends CI_Model {

    //put your code here
    function product_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
        $this->load->model('ws/home_model', 'homeModel');
        $this->load->model('ws/notification', 'notificationModel');
    }

    function save_Item($data) {
        date_default_timezone_set('Asia/Jakarta');

        $createdate = $tanggal = $date = date('Y-m-d h:i:sa');
        $datainsert = array(
            'shop_id' => new MongoId($data['shop_id']),
            'nama' => (isset($data['nama']) ? $data['nama'] : ''),
            'subcategory_id' => (isset($data['subcategory_id']) ? new MongoId($data['subcategory_id']) : ''),
            'harga' => (isset($data['harga']) ? $data['harga'] : '0'),
            'desc' => (isset($data['desc']) ? $data['desc'] : ''),
            'jumlah' => (isset($data['jumlah']) && $data['jumlah'] != '' ? $data['jumlah'] : '1'),
            'fdelete' => '1',
            'create_date' => $createdate,
            'create_by' => '',
            'modified_date' => $createdate,
            'modified_by' => ''
        );

        $insertitem = $this->globalmodel->insertToDatabase('tproduct', $datainsert);
//        print_r($insertitem);die(0);
        if ($insertitem != '11') {
//            print_r($data);die(0);
            if (isset($data['pict']) && $data['pict'] != '') {
//                print_r($data);die(0);
                $x = 1;
                $width = 200;
//                foreach ($data['pict'] as $pict) {
                $date = date('Ymd');
                $folder = 'assets/itempict/';
                $namepict = str_replace(" ", "", $data['nama']) . "_" . $date . ".jpeg";
                $path = $folder;
                $datapict = array(
                    'name' => $namepict,
                    'image' => $data['pict'],
                    'path' => $path,
                    'thumb_path' => $path . "thumb/",
                );
                $uploadpict = $this->globalmodel->uploadpict($datapict);
                $resize = $this->globalmodel->resizePict($datapict, $path . $namepict);
//                    print_r($uploadpict);die(0);
                if ($uploadpict != '11') {
//status 1= pict asli
                    $coll = 'tpicture_item';
                    $datainsert = array(
                        'item_id' => $insertitem,
                        'path' => $path . $namepict,
                        'thumb_path' => $path . "thumb/thumb_" . $namepict,
                        'nama' => $namepict,
                        'status_pict' => '1',
                        'fdelete' => '1',
                        'create_date' => $createdate,
                        'create_by' => '',
                        'modified_date' => $createdate,
                        'modified_date' => ''
                    );
                    $insertpict = $this->globalmodel->insertToDatabase($coll, $datainsert);
                }
//                    $x++;
//                }
            }


            $tabel = "tshop,tpicture_shop";
            $action = "Insert item_name : " . $data['nama'] . ", id : " . $insertitem->{'$id'};
            $stat = " status : Success";



            $msg = $insertitem;
            $datafollow = array('fdelete' => '1',
                'shop_id_followed' => new MongoId($data['shop_id']));
            $chekfollower = $this->homeModel->Follower($datafollow);
            if (sizeof($chekfollower) > 0) {
                foreach ($chekfollower as $cf) {
                    // type 1=new product, 2=konfirmasi, 3=order
                    $datainsertnotif = array(
                        'type' => '1',
                        'user_id' => $cf['user_id_follower'],
                        'detail' => array(
                            'shop_id' => new MongoId($data['shop_id']),
                            'item_id' => $insertitem
                        )
                    );
                    $addmotif = $this->notificationModel->addnotification($datainsertnotif);
                    
                    $cond = array('user_id' => $cf['user_id_follower']);
                    $loadhardware = $this->notificationModel->chekhardware($cond);
                    if(sizeof($loadhardware)>0){
                        foreach($loadhardware as $lh){
                             $dataPush = array('hardwareid' => $lh['hardware_id'], 'token' => $lh['hardware_id']
                        , 'method' => 'client_reg', 'clientid' => '26aa91e7ce904a030088d29eec4b0b91e441d998');
                    $this->post_to_url("push.seatechmobile.com/index.php/push", $dataPush);
                        }
                        
                    }
                    //masih bingung yg ini
                   
                }
            }
        } else {

            $msg = '11';


            $tabel = "tshop,tpicture_shop";
            $action = "Insert shop_name : " . $data['nama'] . ", id : " . $insertshop->{'$id'};
            $stat = " status : Gagal";
        }

        $this->globalmodel->InsertTLog($tabel, $action, $stat);
        return $msg;
    }

    function Get_one_Item($data) {

//        $data['sort'] = $sort = array("create_date" => "1");
//        $limitshop = 20;
        $collshop = "tproduct";
//        $data['limitproduct'] = 5;
        $picture = array();
        $cond = array(
            '_id' => new MongoId($data['item_id']),
//            'shop_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );
        $getshop = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
        if (sizeof($getshop) > 0) {
            $getshop['item_id'] = $getshop['_id']->{'$id'};
            $getshop['shop_id'] = $getshop['shop_id']->{'$id'};
            $getshop['create_date'] = strtotime($getshop['create_date']);
            $getshop['modified_date'] = strtotime($getshop['modified_date']);
            $getshop['harga'] = ($getshop['harga'] == '' ? 0 : (int) $getshop['harga']);
            $getshop['jumlah'] = ($getshop['jumlah'] == '' ? 0 : (int) $getshop['jumlah']);
            if (isset($getshop['keyword'])) {
                unset($getshop['keyword']);
            }
            $condpict = array('item_id' => new MongoId($getshop['item_id']), 'fdelete' => '1');
            $pict = $this->globalmodel->getRecordWithCondition('tpicture_item', $condpict);
//print_r($pict);die(0);
//            $pict = $this->globalmodel->getOneRecordWithCond($condpict,'tpicture_item' );
            if (sizeof($pict) > 0) {
                $picture = array();
                foreach ($pict as $p) {

                    $p['pict_id'] = $p['_id']->{'$id'};
                    $p['item_id'] = $p['item_id']->{'$id'};
                    $p['path'] = base_url() . $p['path'];
                    $p['thumb_path'] = base_url() . $p['thumb_path'];

                    unset($p['_id']);
                    unset($p['fdelete']);
                    unset($p['modified_by']);
                    unset($p['create_by']);
                    unset($p['modified_date']);
                    unset($p['create_date']);
                    unset($p['status_pict']);
                    unset($p['create_by']);
//                    $picture=$pict;
                    array_push($picture, $p);
                }
            }
            $getshop['listpict'] = $picture;
            unset($getshop['create_by']);
            unset($getshop['modified_by']);
            unset($getshop['fdelete']);
//            $getshop['shop_id'] = $getshop['_id']->{'$id'};
            unset($getshop['_id']);
        }
//print_r($getshop);die(0);
        return $getshop;
    }

    function Get_item_detail($data) {
        $collshop = "tproduct";
//        $data['limitproduct'] = 5;

        $cond = array(
            '_id' => new MongoId($data['item_id']),
            'shop_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );
        $gambar = array();
        $getitem = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
        if (sizeof($getitem) > 0) {
            $getitem['item_id'] = $getitem['_id']->{'$id'};
            $cond = array('item_id' => $getitem['_id'], 'fdelete' => '1');
            $coll = 'tpicture_item';
            $getpictItem = $this->globalmodel->getRecordWithCondition($coll, $cond);
            if (sizeof($getpictItem) > 0) {
                foreach ($getpictItem as $pict) {
                    $pict['pict_id'] = $pict['_id']->{'$id'};
                    unset($pict['_id']);
                    unset($pict['modified_by']);
                    unset($pict['create_by']);
                    array_push($gambar, $pict);
                }
            }
            $getitem['picture_list'] = $gambar;
            unset($getitem['_id']);
            $databalikan = array(
                'data' => $getitem,
                'message' => $this->globalmodel->Message('10'),
                'status' => '1'
            );
        } else {
            $databalikan = array(
                'data' => array(),
                'message' => $this->globalmodel->Message('11'),
                'status' => '0'
            );
        }

        return json_encode($databalikan);
    }

    //ari's work
//    function Update_Item($data) {
//        date_default_timezone_set('Asia/Jakarta');
//        $createdate = date('Y-m-d h:i:sa');
////         = date();
//        $isiset = array();
//        $coll = 'tproduct';
//        if (isset($data['pict']) && $data['pict'] != '') {
//            If ($data['nama'] != '') {
//                $nama_item = $data['nama'];
//            } else {
//                $coll = 'tproduct';
//                $cond = array(
//                    '_id' => new MongoId($data['item_id']),
////                    'shop_id' => new MongoId($data['shop_id']),
//                    'fdelete' => '1'
//                );
//                $chek = $this->globalmodel->getOneRecordWithCond($cond, $coll);
//                $nama_item = $chek['nama'];
//            }
//            $date = date('Ymd');
//            $folder = 'assets/itempict/';
//            $namepict = $nama_item . "_" . $date . ".jpeg";
//            $path = $folder;
//            $datapict = array(
//                'name' => $namepict,
//                'image' => $pict,
//                'path' => $path,
//                'thumb_path' => $path . "thumb/",
//            );
//            $chektable = $this->globalmodel->getcollection();
//            if (in_array("tpicture_item", $chektable, TRUE)) {
//                
//            } else {
//
//                $datainsert = array(
//                    'item_id' => new MongoId($data['item_id']),
//                    'path' => $path . $namepict,
//                    'thumb_path' => $path . "thumb/thumb_" . $namepict,
//                    'nama' => $namepict,
//                    'status_pict' => '1',
//                    'fdelete' => '1',
//                    'create_date' => $createdate,
//                    'create_by' => '',
//                    'modified_date' => $createdate,
//                    'modified_date' => ''
//                );
//                $insertpict = $this->globalmodel->insertToDatabase('tpicture_item', $datainsert);
//            }
//            $uploadpict = $this->globalmodel->uploadpict($datapict);
//            $resize = $this->globalmodel->resizePict($datapict, $path . $namepict);
////status 1= coverpicture
//            $coll = 'tpicture_item';
//            $cond = array(
//                'item_id' => new MongoId($data['item_id']),
//                'fdelete' => '1'
//            );
//            $set = array('$set' => array(
//                    'path' => $path . $namepict,
//                    'thumb_path' => $path . "thumb/" . $namepict,
//                    'nama' => $namepict,
//                    'modified_date' => $createdate)
//            );
//            $dataupdate = array($cond, $set);
//            $updatepict = $this->globalmodel->UpdateRecordWithCond($dataupdate, $coll);
//            if ($updatepict) {
//                $tabelpict = ',tpicture_item';
//            } else {
//                $tabelpict = '';
//            }
//        }
//
//
//        $cond = array(
//            '_id' => new MongoId($data['item_id']),
////            'user_id' => new MongoId($data['shop_id']),
//            'fdelete' => '1'
//        );
//        $id = $data['item_id'];
////        foreach ($data as $d) {
////            $data['_id'] = new MongoId($data['item_id']);
//        $data['subcategory_id'] = (isset($data['subcategory_id']) ? new MongoId($data['subcategory_id']) : '' );
//        $data['modified_date'] = $createdate;
//        unset($data['item_id']);
//        unset($data['keyword']);
////            array_push($isiset, $d);
////        }
////print_r($data);die(0);
//         if($data['harga'] ==''){
//             unset($data['harga']);
//         }
//           if($data['desc'] ==''){
//             unset($data['desc']);
//         }
//           if($data['nama'] ==''){
//             unset($data['nama']);
//         }
//          if($data['shop_id'] ==''){
//             unset($data['shop_id']);
//         }
//          if($data['subcategory_id'] ==''){
//             unset($data['subcategory_id']);
//         }
//        $set = array('$set' => $data);
//       
//        $dataupdate = array($cond, $set);
//        $update = $this->globalmodel->UpdateRecordWithCond($cond, $set, 'tproduct');
//        if ($update == '10') {
//
//            //harus handle edit pict kalau ada
//
//            $data['item_id'] = $id;
//            $hsl = $this->Get_one_item($data);
////print_r($data);die(0);
//            $tabel = "tproduct";
//            $action = "update id : " . $id;
//            $stat = " status : Success";
//            $date = $createdate;
//            $msg = '10';
//        } else {
//            $hsl = array();
//            $msg = '11';
//            $tabel = "tproduct";
//            $action = "update id : " . $id;
//            $stat = " status : Error";
//            $date = $createdate;
//        }
//        $this->globalmodel->InsertTLog($tabel, $action, $stat);
////        print_r(array('msg' => $msg, 'data' => $hsl));die(0);
//        return array('msg' => $msg, 'data' => $hsl);
//    }
    //Bismo's Work
    function Update_Item($data) {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d h:i:sa');
//         = date();
//        echo json_encode($data);die(0);
        $isiset = array();
        $coll = 'tproduct';
        if (isset($data['pict']) && $data['pict'] != '') {
            If ($data['nama'] != '') {
                $nama_item = $data['nama'];
            } else {
                $coll = 'tproduct';
                $cond = array(
                    '_id' => new MongoId($data['item_id']),
//                    'shop_id' => new MongoId($data['shop_id']),
                    'fdelete' => '1'
                );
                $chek = $this->globalmodel->getOneRecordWithCond($cond, $coll);
                $nama_item = $chek['nama'];
            }
            $date = date('Ymd');
            $folder = 'assets/itempict/';
            $namepict = str_replace(" ", "_", $nama_item) . "_" . $date . ".png";
            $path = $folder;
            $datapict = array(
                'name' => $namepict,
                'image' => $data['pict'],
                'path' => $path,
                'thumb_path' => $path . "thumb/",
            );
            //untuk sementara hanya bisa 1 gambar per produk

            $datainsert = array(
                'item_id' => new MongoId($data['item_id']),
                'path' => $path . $namepict,
                'thumb_path' => $path . "thumb/thumb_" . $namepict,
                'nama' => $namepict,
                'status_pict' => '1',
                'fdelete' => '1',
                'create_date' => $createdate,
                'create_by' => '',
                'modified_date' => $createdate,
                'modified_date' => ''
            );

            $uploadpict = $this->globalmodel->uploadpict($datapict);
            $resize = $this->globalmodel->resizePict($datapict, $path . $namepict);
//status 1= coverpicture
            $coll = 'tpicture_item';
            $cond = array(
                'item_id' => new MongoId($data['item_id']),
                'fdelete' => '1'
            );
            $set = array('$set' => array(
                    'path' => $path . $namepict,
                    'thumb_path' => $path . "thumb/thumb_" . $namepict,
                    'nama' => $namepict,
                    'modified_date' => $createdate)
            );
            $chekIfEksis = $this->globalmodel->getOneRecordWithCond($cond, "tpicture_item");
//            print_r($chekIfEksis);die(0);
            if (sizeof($chekIfEksis) > 0) {
                $updatepict = $this->globalmodel->UpdateRecordWithCond($cond, $set, 'tpicture_item');
            } else {
                $insertpict = $this->globalmodel->insertToDatabase('tpicture_item', $datainsert);
            }
            $dataupdate = array($cond, $set);

//            if ($updatepict == 10) {
//                $tabelpict = ',tpicture_item';
//            } else {
//                $tabelpict = '';
//            }
            //komen, gajelas buat apaan
        }
        //update Itemnya
        $cond = array(
            '_id' => new MongoId($data['item_id']),
//            'user_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );
        $id = $data['item_id'];
//        foreach ($data as $d) {
//            $data['_id'] = new MongoId($data['item_id']);
        $data['subcategory_id'] = (isset($data['subcategory_id']) ? new MongoId($data['subcategory_id']) : '' );
        $data['shop_id'] = (isset($data['shop_id']) ? new MongoId($data['shop_id']) : '' );
        $data['modified_date'] = $createdate;
        unset($data['item_id']);
        unset($data['keyword']);
        unset($data['pict']);
//            array_push($isiset, $d);
//        }
//print_r($data);die(0);
        if ($data['harga'] == '') {
            unset($data['harga']);
        }
        if ($data['desc'] == '') {
            unset($data['desc']);
        }
        if ($data['nama'] == '') {
            unset($data['nama']);
        }
        if (isset($data["shop_id"]) && ($data['shop_id'] == '')) {
            unset($data['shop_id']);
        }

        if ($data['subcategory_id'] == '') {
            unset($data['subcategory_id']);
        }

        $set = array('$set' => $data);
//       echo json_encode($set);die(0);
        $dataupdate = array($cond, $set);
//s        echo json_encode($data);die(0);
        $update = $this->globalmodel->UpdateRecordWithCond($cond, $set, 'tproduct');
        if ($update == '10') {
            //harus handle edit pict kalau ada
            $data['item_id'] = $id;
            $hsl = $this->Get_one_item($data);
//print_r($hsl);die(0);
            $tabel = "tproduct";
            $action = "update id : " . $id;
            $stat = " status : Success";
            $date = $createdate;
            $msg = '10';
        } else {
            $hsl = array();
            $msg = '11';
            $tabel = "tproduct";
            $action = "update id : " . $id;
            $stat = " status : Error";
            $date = $createdate;
        }
        $this->globalmodel->InsertTLog($tabel, $action, $stat);
//        print_r(array('msg' => $msg, 'data' => $hsl));die(0);
        return array('msg' => $msg, 'data' => $hsl);
    }

    function Delete_item($data) {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = date('Y-m-d h:i:sa');
        $cond = array(
            '_id' => new MongoId($data['item_id']),
        );
        $coll = 'tproduct';

        $set = array('$set' =>
            array('fdelete' => '0'));

        $dataupdate = array($cond, $set);
        $update = $this->globalmodel->UpdateRecordWithCond($cond, $set, $coll);
        if ($update) {
            $cond = array(
                'item_id' => new MongoId($data['item_id']),
            );
            $update = $this->globalmodel->UpdateRecordWithCond($cond, $set, 'tpicture_item');
            //harus handle edit pict kalau ada


            $tabel = "tproduct";
            $action = "update id : " . $data['item_id'];
            $stat = " status : Success";
            $date = $createdate;
            $msg = '10';
        } else {
            $msg = '11';
            $tabel = "tproduct";
            $action = "update id : " . $data['item_id'];
            $stat = " status : Error";
            $date = $createdate;
        }
        $this->globalmodel->InsertTLog($tabel, $action, $stat);
        return $msg;
    }

    function Get_AllItemWithCond($data) {
        $collshop = "tproduct";
//        $data['limitproduct'] = 5;
        $getitem = array();
        $cond = array(
//            '_id' => new MongoId($data['item_id']),
            'shop_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );
        $getshop = $this->globalmodel->getRecordWithCondition($collshop, $cond);
        if (sizeof($getshop) > 0) {
            foreach ($getshop as $item) {
                $item['item_id'] = $item['_id']->{'$id'};
                $item['shop_id'] = $item['shop_id']->{'$id'};
                $item['subcategory_id'] = ($item['subcategory_id'] != '' ? $item['_id']->{'$id'} : '');
                $item['harga'] = ($item['harga'] == '' ? 0 : (int) $item['harga']);
                $item['jumlah'] = ($item['jumlah'] == '' ? 0 : (int) $item['jumlah']);
                $condpict = array('item_id' => $item['_id'], 'fdelete' => '1');
//             print_r($condpict);die(0);
//%pict            $item['subcategory_id'] = $item['subcategory_id']->{'$id'};
                $pict = $this->globalmodel->getRecordWithCondition('tpicture_item', $condpict);
//print_r($pict);die(0);
//            $pict = $this->globalmodel->getOneRecordWithCond($condpict,'tpicture_item' );
                if (sizeof($pict) > 0) {
                    foreach ($pict as $p) {
                        $picture = array();
                        $p['pict_id'] = $p['_id']->{'$id'};
                        $p['item_id'] = $p['item_id']->{'$id'};
                        $p['path'] = base_url() . $p['path'];
                        $p['thumb_path'] = base_url() . $p['thumb_path'];

                        unset($p['_id']);
                        unset($p['fdelete']);
                        unset($p['modified_by']);
                        unset($p['create_by']);
                        unset($p['modified_date']);
                        unset($p['create_date']);
                        unset($p['status_pict']);
                        unset($p['create_by']);
//                    $picture=$pict;
                        array_push($picture, $p);
                    }
                }
                $item['listpict'] = $picture;
                $item['create_date'] = strtotime($item['create_date']);
                $item['modified_date'] = strtotime($item['modified_date']);
                unset($item['_id']);
                unset($item['fdelete']);
                unset($item['modified_by']);
                unset($item['create_by']);
                array_push($getitem, $item);
            }
        }

        return $getitem;
    }

    function Like($data) {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = $tanggal = $date = date('Y-m-d h:i:sa');

        $tabel = "tlike";
        $status = '1';
        $action = "Insert Item_id : " . $data['item_id_liked'] . ", user id yang nge like : " . $data['user_id_liker'];
        $stat = 'Succes';
        $msg = '10';

        $datainsertlike = array(
            'item_id' => (isset($data['item_id_liked']) ? new MongoId($data['item_id_liked']) : ''),
            'user_id' => (isset($data['user_id_liker']) ? new MongoId($data['user_id_liker']) : ''),
            'fdelete' => '1',
            'create_date' => $createdate,
            'create_by' => '',
            'modified_date' => $createdate,
            'modified_by' => ''
        );

        $insertlike = $this->globalmodel->insertToDatabase($tabel, $datainsertlike);
        if (!$insertlike) {
            $msg = '11';

            $stat = "Gagal";
            $status = '0';
        }

        $balikan = array(
            'data' => array(),
            'message' => $this->globalmodel->Message($msg),
            'status' => $status
        );
        return json_encode($balikan);
    }

//    function TodaysHot() {
//        $hasil = array();
//        $cond = array('create_date' => date('Y-m-d'));
//        $index = array('item_id' => null);
//        $coll = 'tproduct';
//        $picturedata = array();
//
//
////        $dataitem = $this->globalmodel->recordWithConditiongroup('tlike', '$item_id');
////        print_r($dataitem);die(0);
//        if (sizeof($dataitem) > 0) {
//
//            foreach ($dataitem as $id) {
//                $conddataitem = array(
//                    'fdelete' => '1',
//                    '_id' => $id['_id']
//                );
//                $dataitemdetail = $this->globalmodel->getOneRecordWithCond($conddataitem, $coll);
//
//                $condpicture = array(
//                    'fdelete' => '1',
//                    'item_id' => $dataitemdetail['_id']
//                );
//                $dataPictItem = $this->globalmodel->getRecordWithCondition('tpicture_product', $condpicture);
//                if (sizeof($dataPictItem) > 0) {
//                    foreach ($dataPictItem as $pict) {
//                        $pict['pict_id'] = $pict['_id']->{'$id'};
//                        unset($pict['_id']);
//                        unset($pict['fdelete']);
//                        unset($pict['create_by']);
//                        unset($pict['modified_by']);
//                        unset($pict['modified_date']);
//                        array_push($picturedata, $pict);
//                    }
//                }
//                $dataitemdetail['pict_list'] = $picturedata;
//                array_push($hasil, $dataitemdetail);
//            }
//        }
//        return $hasil;
//    }

    function unLike($data) {
        date_default_timezone_set('Asia/Jakarta');
        $createdate = $tanggal = $date = date('Y-m-d h:i:sa');

        $tabel = "tlike";
        $status = '1';
        $action = "Insert Item_id : " . $data['item_id_liked'] . ", user id yang nge like : " . $data['user_id_liker'];
        $stat = 'Succes';
        $msg = '10';

        $datainsertlike = array(
            'item_id' => (isset($data['item_id_liked']) ? new MongoId($data['item_id_liked']) : ''),
            'user_id' => (isset($data['user_id_liker']) ? new MongoId($data['user_id_liker']) : ''),
            'fdeleted' => '1'
        );

        $set = array('$set' => array(
                'fdeleted' => '1',
                'modified_date' => $createdate)
        );
        $set = array('fdelete' => '0',
            'modified_date' => $createdate);

        $updatelike = $this->globalmodel->UpdateRecordWithCond($cond, $tabel);
        if (!$insertlike) {
            $msg = '11';

            $stat = "Gagal";
            $status = '0';
        }

        $balikan = array(
            'data' => array(),
            'message' => $this->globalmodel->Message($msg),
            'status' => $status
        );
        return json_encode($balikan);
    }

    function favorite_item($data) {
//        $cond=array('$group'=>array('_id'=>'$item_id','count'=>array('$sum'=>1)));
        $cond = array('fdelete' => '1',
            'user_id' => (isset($data['user_id']) ? new MongoId($data['user_id']) : '' )
        );
        $keys = array("item_id" => 1);
        $item = array();
        $initial = array("liker" => array());
        $reduce = "function (obj, prev) { prev.liker.push(obj.user_id); }";
//        $dataitm=$this->globalmodel->recordWithConditiongroup('tlike', $keys, $initial, $reduce);
        $datalike = $this->globalmodel->getRecordWithCondition('tlike', $cond);
//        print_r($dataitm);die(0);
        foreach ($datalike as $dt) {
//            $dt['item_id'];
//            $dt['count'] = sizeof($dt['liker']);

            $dta['item_id'] = $dt['item_id']->{'$id'};

            $dt['create_date'] = strtotime($dt['create_date']);
            $dt['modified_date'] = strtotime($dt['modified_date']);
            $dataitm = $this->Get_one_Item($dta);
            $dt['item'] = $dataitm;
            $dt['item_id'] = $dt['item_id']->{'$id'};
            $dt['user_id'] = $dt['user_id']->{'$id'};
            unset($dt['_id']);
            unset($dt['fdelete']);
            unset($dt['create_by']);
            unset($dt['modified_by']);
            array_push($item, $dt);
        }
//         print_r($item);die(0);
        return $item;
    }

}
