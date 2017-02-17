<?php

/**
 * Description of ws_global
 * create by    : Yohanes 
 * create date  : 10-02-2015
 */
class item_model extends CI_Controller {

    //put your code here

    function item_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    function save_Item($data) {
        $createdate = date();
        $datainsert = array(
            'shop_id' => new MongoId($data['shop_id']),
            'nama' => (isset($data['nama']) ? $data['nama'] : ''),
            'subcategory_id' => new MongoId($data['subcategory_id']),
            'harga' => (isset($data['harga']) ? $data['alamat'] : ''),
            'desc' => (isset($data['desc']) ? $data['desc'] : ''),
            'jumlah' => (isset($data['jumlah']) ? $data['desc'] : ''),
            'fdelete' => '1',
            'create_date' => $createdate,
            'create_by' => '',
            'modified_date' => $createdate,
            'modified_date' => ''
        );

        $insertitem = $this->globalmodel->insertToDatabase('tproduct', $datainsert);
        if ($insertshop != '11') {
            if (isset($data['pict'])) {
                foreach ($data['pict'] as $pict) {
                    $date = date('Ymd');
                    $folder = 'assets/itempict/';
                    $namepict = $data['nama'] . "_" . $date . ".jpeg";
                    $path = $folder . $namepict;
                    $datapict = array(
                        'image' => $pict,
                        'path' => $path
                    );
                    $uploadpict = $this->globalmodel->uploaditem($datapict);
//status 1= pict asli
                    $coll = 'tpicture_item';
                    $datainsert = array(
                        'shop_id' => $insertshop,
                        'path' => $path,
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
            }


            $tabel = "tshop,tpicture_shop";
            $action = "Insert item_name : " . $data['nama'] . ", id : " . $insertitem->{'$id'};
            $stat = " status : Success";
            $date = date();


            $msg = '10';
        } else {

            $msg = '11';


            $tabel = "tshop,tpicture_shop";
            $action = "Insert shop_name : " . $data['nama'] . ", id : " . $insertshop->{'$id'};
            $stat = " status : Gagal";
            $date = date();
        }

        $this->globalmodel->InsertTLog($tabel, $action, $stat);
        return $msg;
    }

    function Get_one_Item($data) {

//        $data['sort'] = $sort = array("create_date" => "1");
//        $limitshop = 20;
        $collshop = "tproduct";
//        $data['limitproduct'] = 5;

        $cond = array(
            '_id' => new MongoId($data['item_id']),
            'shop_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );
        $getshop = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
        if (sizeof($getshop) > 0) {
            $getshop['shop_id'] = $getshop['_id']->{'$id'};
            unset($getshop['_id']);
        }

        return $getshop;
    }

    function Update_Item($data) {
        $createdate = date();
        $isiset = array();
        $coll = 'tproduct';
        if (isset($data['pict']) && $data['pict'] != '') {
            If ($data['nama'] != '') {
                $nama = $data['nama'];
            } else {
                $coll = 'tshop';
                $cond = array(
                    '_id' => new MongoId($data['item_id']),
                    'user_id' => new MongoId($data['shop_id']),
                    'fdelete' => '1'
                );
                $chek = $this->globalmodel->getOneRecordWithCond($cond, $coll);
                $nama_item = $chek['nama'];
            }
            $date = date('Ymd');
            $folder = 'assets/shoppict/';
            $namepict = $nama_item . "_" . $date . ".jpeg";
            $path = $folder . $namepict;
            $datapict = array(
                'image' => $data['pict'],
                'path' => $path
            );
            $uploadpict = $this->globalmodel->uploaditem($datapict);
//status 1= coverpicture
            $coll = 'tpicture_item';
            $cond = array(
                'item_id' => new MongoId($data['item_id']),
                'fdelete' => '1'
            );
            $set = array('$set' => array(
                    'path' => $path,
                    'nama' => $namepict,
                    'modified_date' => $createdate)
            );
            $dataupdate = array($cond, $set);
            $updatepict = $this->globalmodel->UpdateRecordWithCond($dataupdate, $coll);
            if ($updatepict) {
                $tabelpict = ',tpicture_item';
            } else {
                $tabelpict = '';
            }
        }


        $cond = array(
            '_id' => new MongoId($data['item_id']),
            'user_id' => new MongoId($data['shop_id']),
            'fdelete' => '1'
        );
        $id = $data['item_id'];
        foreach ($data as $d) {
            $d['shop_id'] = new MongoId($d['shop_id']);
            $d['subcategory_id'] = new MongoId($d['subcategory_id']);
            $d['modified_date'] = $createdate;
            unset($d['item_id']);
            array_push($isiset, $d);
        }

        $set = array('$set' => $isiset);

        $dataupdate = array($cond, $set);
        $update = $this->globalmodel->UpdateRecordWithCond($dataupdate, $coll);
        if ($update) {

            //harus handle edit pict kalau ada


            $tabel = "tproduct" . $tabelpict;
            $action = "update id : " . $id;
            $stat = " status : Success";
            $date = date();
            $msg = '10';
        } else {
            $msg = '11';
            $tabel = "tproduct" . $tabelpict;
            $action = "update id : " . $id;
            $stat = " status : Error";
            $date = date();
        }
        $this->globalmodel->InsertTLog($tabel, $action, $stat);
        return $msg;
    }

    function Delete_shop($data) {
        $cond = array(
            '_id' => new MongoId($data['item_id']),
        );
        $coll = 'tproduct';

        $set = array('$set' =>
            array('fdelete' => '0'));

        $dataupdate = array($cond, $set);
        $update = $this->globalmodel->UpdateRecordWithCond($dataupdate, $coll);
        if ($update) {

            //harus handle edit pict kalau ada


            $tabel = "tshop" . $tabelpict;
            $action = "update id : " . $id;
            $stat = " status : Success";
            $date = date();
            $msg = '10';
        } else {
            $msg = '11';
            $tabel = "tshop" . $tabelpict;
            $action = "update id : " . $id;
            $stat = " status : Error";
            $date = date();
        }
        $this->globalmodel->InsertTLog($tabel, $action, $stat);
        return $msg;
    }

}
