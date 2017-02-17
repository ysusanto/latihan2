<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shop_model
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class shop_model extends CI_Model {

    private $tanggal;

    //put your code here
    function shop_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
        $this->load->model('ws/product_model', 'itemModel');
    }

    function save_shop($data) {
//        $createdate = date();
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $datainsert = array(
            'user_id' => new MongoId($data['user_id']),
            'nama_toko' => (isset($data['nama_toko']) ? $data['nama_toko'] : ''),
            'lokasi_id' => (isset($data['lokasi_id']) ? $data['lokasi_id'] : ''),
            'alamat' => (isset($data['alamat']) ? $data['alamat'] : ''),
            'desc' => (isset($data['desc']) ? $data['desc'] : ''),
            'fdelete' => '1',
            'create_date' => $tanggal,
            'create_by' => '',
            'modified_date' => $tanggal,
            'modified_by' => ''
        );

        $insertshop = $this->globalmodel->insertToDatabase('tshop', $datainsert);
        if ($insertshop != '11') {
//            print_r($data);die(0);
            if (isset($data['pict']) && $data['pict'] != '') {
                $date = date('Ymd');
                $folder = 'assets/shoppict/';
                $namepict = str_replace(" ", "", $data['nama_toko']) . "_" . $date . ".jpeg";
                $path = $folder;
                $datapict = array(
                    'name' => $namepict,
                    'thumb_path' => $path . "thumb/",
                    'image' => $data['pict'],
                    'path' => $path
                );
                $uploadpict = $this->globalmodel->uploadpict($datapict);
                $resize = $this->globalmodel->resizePict($datapict, $path . $namepict);
//status 1= coverpicture
                $coll = 'tpicture_shop';
                $datainsert = array(
                    'shop_id' => $insertshop,
                    'path' => $path . $namepict,
                    'thumb_path' => $path . "thumb/thumb_" . $namepict,
                    'nama' => $namepict,
                    'status_pict' => '1',
                    'fdelete' => '1',
                    'create_date' => $tanggal,
                    'create_by' => '',
                    'modified_date' => $tanggal,
                    'modified_by' => ''
                );
                $insertpict = $this->globalmodel->insertToDatabase($coll, $datainsert);
            }
            $tabel = "tshop,tpicture_shop";
            $action = "Insert shop_name : " . $data['nama_toko'] . ", id : " . $insertshop->{'$id'};
            $stat = " status : Success";



            $msg = $insertshop;
        } else {

            $msg = '11';


            $tabel = "tshop,tpicture_shop";
            $action = "Insert shop_name : " . $data['nama'] . ", id : " . $insertshop->{'$id'};
            $stat = " status : Gagal";
        }
        $datalog = array(
            "tabel" => $tabel,
            "action" => "Insert",
            "desc" => $action,
            "status" => $stat,
            "create_date" => $tanggal
        );
        $this->globalmodel->insertToDatabase('tlog', $datalog);
        return $msg;
    }

    function Get_one_shop($data) {

        $picture = array();
//        $data['sort'] = $sort = array("create_date" => "1");
//        $limitshop = 20;
        $collshop = "tshop";
//        $data['limitproduct'] = 5;

        $cond = array(
            '_id' => new MongoId($data['shop_id']),
//            'user_id' => (isset($data['user_id']) ? new MongoId($data['user_id']) : ''),
            'fdelete' => '1'
        );
//        print_r($cond);die(0);
        $getshop = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
//        print_r($getshop);die(0);
        if (sizeof($getshop) > 0) {

            $getshop['shop_id'] = $getshop['_id']->{'$id'};
            $getshop['create_date'] = strtotime($getshop['create_date']);
            $getshop['modified_date'] = strtotime($getshop['modified_date']);

            $pict = $this->globalmodel->getOneRecordWithCond(array('shop_id' => $getshop['_id'], 'fdelete' => '1'), 'tpicture_shop');
            if (sizeof($pict) > 0) {
                $pict['pict_id'] = $pict['_id']->{'$id'};
                $pict['path'] = base_url() . $pict['path'];
                $pict['thumb_path'] = base_url() . $pict['thumb_path'];
                unset($pict['create_by']);
                unset($pict['modified_by']);
                unset($pict['create_date']);
                unset($pict['modified_date']);
                unset($pict['shop_id']);
                unset($pict['status_pict']);
                unset($pict['fdelete']);
                unset($pict['create_by']);
                unset($pict['_id']);
                $picture = $pict;
            }
            $getshop['covershop'] = $picture;
            unset($getshop['create_by']);
            unset($getshop['modified_by']);
            unset($getshop['fdelete']);
//                unset($getshop['modified_date']);
//                unset($getshop['shop_id']);
            unset($getshop['_id']);
        }

        return $getshop;
    }

    function Get_one_shopuser($data) {

        $picture = array();
//        $data['sort'] = $sort = array("create_date" => "1");
//        $limitshop = 20;
        $collshop = "tshop";
//        $data['limitproduct'] = 5;

        $cond = array(
            'user_id' => new MongoId($data['user_id']),
//            'user_id' => (isset($data['user_id']) ? new MongoId($data['user_id']) : ''),
            'fdelete' => '1'
        );
//        print_r($cond);die(0);
        $getshop = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
//        print_r($getshop);die(0);
        if (sizeof($getshop) > 0) {

            $getshop['shop_id'] = $getshop['_id']->{'$id'};
            $getshop['user_id'] = $getshop['user_id']->{'$id'};
            $getshop['create_date'] = strtotime($getshop['create_date']);
            $getshop['modified_date'] = strtotime($getshop['modified_date']);

            $pict = $this->globalmodel->getOneRecordWithCond(array('shop_id' => $getshop['_id'], 'fdelete' => '1'), 'tpicture_shop');
            if (sizeof($pict) > 0) {
                $pict['pict_id'] = $pict['_id']->{'$id'};
                $pict['path'] = base_url() . $pict['path'];
                $pict['thumb_path'] = base_url() . $pict['thumb_path'];
                unset($pict['create_by']);
                unset($pict['modified_by']);
                unset($pict['create_date']);
                unset($pict['modified_date']);
                unset($pict['shop_id']);
                unset($pict['status_pict']);
                unset($pict['fdelete']);
                unset($pict['create_by']);
                unset($pict['_id']);
                $picture = $pict;
            }
            $getshop['covershop'] = $picture;
            unset($getshop['create_by']);
            unset($getshop['modified_by']);
            unset($getshop['fdelete']);
//                unset($getshop['modified_date']);
//                unset($getshop['shop_id']);
            unset($getshop['_id']);
        }

        return $getshop;
    }

    function Get_shopwithcondition($data) {
        $getdatashop = array();
//        $data['sort'] = $sort = array("create_date" => "1");
//        $limitshop = 20;
        $collshop = "tshop";
//        $data['limitproduct'] = 5;

        $cond = array(
//            '_id' => new MongoId($data['shop_id']),
            'user_id' => new MongoId($data['user_id']),
            'fdelete' => '1'
        );
        $getshop = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
//        print_r(sizeof($getshop));die(0);
        if (sizeof($getshop) > 0) {
//            foreach ($getshop as $shop) {
            $conditem = array(
//           
                'shop_id' => $getshop['_id']
            );
            $itemlist = $this->itemModel->Get_AllItemWithCond($conditem);
            $getshop['item_list'] = $itemlist;
            $getshop['user_id'] = $getshop['user_id']->{'$id'};
            $getshop['shop_id'] = $getshop['_id']->{'$id'};
            unset($getshop['_id']);
            unset($getshop['fdelete']);
            unset($getshop['create_by']);
            unset($getshop['modified_by']);
            unset($getshop['modified_date']);
            array_push($getdatashop, $shop);
//            }
        }

        return $getdatashop;
    }

    function Update_Shop($data) {
//        print_r($data);die(0);
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $isiset = array();
        $tabelpict = '';
        $coll = 'tshop';
        if (isset($data['pict']) && $data['pict'] != '') {
            If ($data['nama_toko'] != '' && isset($data['user_id'])) {
                $nama = $data['nama_toko'];
            } else {
                $coll = 'tshop';
                $cond = array(
                    '_id' => new MongoId($data['shop_id']),
                    'fdelete' => '1'
                );
                $chek = $this->globalmodel->getOneRecordWithCond($cond, $coll);
                $nama = $chek['nama_toko'];
            }
            $date = date('Ymd');
            $folder = 'assets/shoppict/';
            $namepict = str_replace(" ", "", $data['nama_toko']) . "_" . $date . ".jpeg";
            $path = $folder;
            $datapict = array(
                'name' => $namepict,
                'thumb_path' => $path . "thumb/",
                'image' => $data['pict'],
                'path' => $path
            );
            $chektable = $this->globalmodel->getcollection();
//           
            if (in_array("tpicture_shop", $chektable, TRUE)) {
                
            } else {
                $datainsert = array(
                    'shop_id' => new MongoId($data['shop_id']),
                    'path' => $path . $namepict,
                    'thumb_path' => $path . "thumb/thumb_" . $namepict,
                    'nama' => $namepict,
                    'status_pict' => '1',
                    'fdelete' => '1',
                    'create_date' => $tanggal,
                    'create_by' => '',
                    'modified_date' => $tanggal,
                    'modified_by' => ''
                );
                $insertpict = $this->globalmodel->insertToDatabase('tpicture_shop', $datainsert);
            }


            $uploadpict = $this->globalmodel->uploadpict($datapict);
            $resize = $this->globalmodel->resizePict($datapict, $path . $namepict);
//status 1= coverpicture
//print_r($data);die(0);
            $coll = 'tpicture_shop';
            $condcover = array(
                'shop_id' => new MongoId($data['shop_id']),
                'fdelete' => '1'
            );
            $chek = $this->globalmodel->getOneRecordWithCond($condcover, 'tpicture_shop');
            if (sizeof($chek) > 0) {
                $cond = array(
                    'shop_id' => new MongoId($data['shop_id']),
                    'fdelete' => '1'
                );
                $set = array('$set' => array(
                        'path' => $path . $namepict,
                        'thumb_path' => $path . "thumb/thumb" . $namepict,
                        'nama' => $namepict,
                        'modified_date' => $tanggal)
                );
                $dataupdate = array($cond, $set);
                $updatepict = $this->globalmodel->UpdateRecordWithCond($cond, $set, $coll);
                $update = 'ok';
            } else {
                $datainsert = array(
                    'shop_id' => new MongoId($data['shop_id']),
                    'path' => $path . $namepict,
                    'thumb_path' => $path . "thumb/thumb_" . $namepict,
                    'nama' => $namepict,
                    'status_pict' => '1',
                    'fdelete' => '1',
                    'create_date' => $tanggal,
                    'create_by' => '',
                    'modified_date' => $tanggal,
                    'modified_by' => ''
                );
                $insertpict = $this->globalmodel->insertToDatabase('tpicture_shop', $datainsert);
                $update = 'no';
            }


            if ($update == 'no') {
                $tabelpict = ',tpicture_shop';
            }
        }
        $usr = $value = '';
        if (isset($data['user_id'])) {
            $usr = 'user_id';
            $value = new MongoId($data['user_id']);
        }


        $cond = array(
            '_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );

        $id = $data['shop_id'];
        $data['modified_date'] = $tanggal;
        unset($data['shop_id']);
        unset($data['pict']);
        unset($data['keyword']);
//        foreach ($data as $d) {
//            $d['user_id'] = $chek['user_id'];
////            $d['lokasi_id'] = (isset($d['lokasi_id']) ? new MongoId($d['lokasi_id']):'');
//            $d['modified_date'] = $tanggal;
////            unset($d['shop_id']);
//            
//            array_push($isiset, $d);
//        }
//print_r($data);die(0);
        $set = array('$set' => $data);
        $date = $tanggal;
        $dataupdate = array($cond, $set);
        $update = $this->globalmodel->UpdateRecordWithCond($cond, $set, 'tshop');
//        print_r($update);die(0);
//          print_r($cond);die(0);
        if ($update == '10') {
            $data['shop_id'] = $id;
            //harus handle edit pict kalau ada
//print_r($data);die(0);
            $hsl = $this->Get_one_shop($data);
//            print_r($hsl);die(0);
            $tabel = "tshop" . $tabelpict;
            $action = "update id : " . $id;
            $stat = " status : Success";

            $msg = '10';
        } else {
            $hsl = array();
            $msg = '11';
            $tabel = "tshop" . $tabelpict;
            $action = "update id : " . $id;
            $stat = " status : Error";
        }
        $this->globalmodel->InsertTLog($tabel, $action, $stat);

//        print_r($hsl);die(0);
        return array('msg' => $msg, 'data' => $hsl);
    }

    function Delete_shop($data) {
        $cond = array(
            '_id' => new MongoId($data['shop_id']),
        );
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $coll = 'tshop';
        $set = array('$set' =>
            array('fdelete' => '0'));

        $dataupdate = array($cond, $set);
        $update = $this->globalmodel->UpdateRecordWithCond($dataupdate, $coll);
        if ($update) {

            //harus handle edit pict kalau ada


            $tabel = "tshop";
            $action = "update id : " . $id;
            $stat = " status : Success";
            $date = $tanggal;
            $msg = '10';
        } else {
            $msg = '11';
            $tabel = "tshop";
            $action = "update id : " . $id;
            $stat = " status : Error";
            $date = $tanggal;
        }
        $this->globalmodel->InsertTLog($tabel, $action, $stat);
        return $msg;
    }

}
