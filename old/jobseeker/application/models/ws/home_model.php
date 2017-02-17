<?php

/**
 * Description of home_model
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class home_model extends CI_Model {

    //put your code here db.bios.find().sort( { name: 1 } ).limit( 5 )

    function home_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('ws_global_model', 'globalmodel');
    }

    function get_tabel_limitsort($limit, $sort, $coll) {
        $record = array();
        $m = new Mongo();
        $db = $m->itc;
        $collection = $db->$coll;
        $hasil = $collection->find() . limit($limit) . sort($sort);
        foreach ($hasil as $has) {
            array_push($record, $has);
        }
        return record;
    }

    function get_tabel_conditionlimitsort($cond, $limit, $sort, $coll) {
        $record = array();
        $m = new Mongo();
        $db = $m->itc;
        $collection = $db->$coll;
        $hasil = $collection->find($cond)->limit($limit)->sort($sort);
        foreach ($hasil as $has) {
            array_push($record, $has);
        }
        return $record;
    }

    function Get_shop() {

        $data['sort'] = $sort = array('modified_date' => -1);
        $limitshop = 20;
        $collshop = "tshop";
        $data['limitproduct'] = 5;

        $cond = array(
            'fdelete' => '1'
        );

        $getshop = $this->get_tabel_conditionlimitsort($cond, $limitshop, $sort, $collshop);
//print_r($getshop);die(0);
        $shop = array();
        $dataitem = array();
        if (sizeof($getshop) > 0) {
            foreach ($getshop as $row) {
                $dataitem['cond'] = array(
                    'shop_id' => $row['_id'],
                    'fdelete' => '1'
                );
                $dataitem['sort'] = array('modified_date' => -1);
                $dataitem['limitproduct'] = 20;

                $dataproduct = $this->Get_Item($dataitem);
                $row['shop_id'] = $row['_id']->{'$id'};
                $row['lokasi_id'] = $row['lokasi_id']->{'$id'};
                $row['item_list'] = $dataproduct;

                unset($row['_id']);
                unset($row['fdelete']);
                unset($row['create_by']);
                unset($row['modified_by']);
                unset($row['modified_date']);
                array_push($shop, $row);
            }
        }
        return $shop;
    }

    function Get_shop_withcond($data) {
        $coll = 'tshop';
        $limit = '20';
        $sort = array('create_date' => '1');
        if (isset($data['f_id']) && $data['f_id'] != '') {
            $id = new MongoId($data['f_id']);
            $condchek = array(
                '_id' => $id,
                'fdelete' => '1'
            );
            $getdata = $this->globalmodel->getOneRecordWithCond($condchek, $coll);

            $cond = array(
                'fdelete' => '1',
                'create_date' => array('$gt' => $getdata['create_date'])
            );
        } else if (isset($data['l_id']) && $data['l_id'] != '') {
            $id = new MongoId($data['l_id']);
            $condchek = array(
                '_id' => $id,
                'fdelete' => '1'
            );
            $getdata = $this->globalmodel->getOneRecordWithCond($condchek, $coll);

            $cond = array(
                'fdelete' => '1',
                'create_date' => array('$lt' => $getdata['create_date'])
            );
        } else {
            $cond = array(
                'fdelete' => '1',
            );
        }
//        
        $getdata = $this->get_tabel_conditionlimitsort($cond, $limit, $sort, $coll);
//print_r($getdata);die(0);
        $shop = array();
        if (sizeof($getdata) > 0) {
            foreach ($getdata as $row) {
                $row['user_id'] = $row['user_id']->{'$id'};
                $row['lokasi_id'] = ($row['lokasi_id'] == '' ? '' : $row['lokasi_id']->{'$id'});
                $data['cond'] = array(
                    'shop_id' => $row['_id'],
                    'fdelete' => '1'
                );
                $data['limitproduct'] = 5;
                $data['sort'] = array('create_date' => '1');
//                $covershop = $this->Get_Item($data);
                $covershop = $this->globalmodel->getOneRecordWithCond(array('shop_id' => $row['_id'], 'fdelete' => '1'), 'tpicture_shop');
//                print_r($covershop);die(0);
                if (sizeof($covershop) > 0) {


                    $covershop['cover_id'] = $covershop['_id']->{'$id'};
                    $covershop['shop_id'] = $covershop['shop_id']->{'$id'};
                    $covershop['path'] = base_url() . $covershop['path'];
                    $covershop['thumb_path'] = base_url() . $covershop['thumb_path'];
                    unset($covershop['_id']);
                    unset($covershop['fdelete']);
                    unset($covershop['modified_by']);
                    unset($covershop['create_by']);
                    unset($covershop['modified_date']);
                    unset($covershop['create_date']);
                }
                $row['cover_shop'] = $covershop;
                $dataproduct = $this->Get_Item($data);
                $row['create_date'] = strtotime($row['create_date']);
                $row['modified_date'] = strtotime($row['modified_date']);
                $row['item_list'] = $dataproduct;
                $row['shop_id'] = $row['_id']->{'$id'};

                unset($row['_id']);
                unset($row['fdelete']);
                unset($row['create_by']);
                unset($row['modified_by']);
                unset($row['modified_date']);
                array_push($shop, $row);
            }
        }
        return $shop;
    }

    function Get_Item($data) {
//        print_r($dta);die(0);
        $product = array();
        $picture = array();
        $collproduct = 'tproduct';
        $getitem = $this->get_tabel_conditionlimitsort($data['cond'], $data['limitproduct'], $data['sort'], $collproduct);
//        $getitem = $this->globalmodel->getRecordWithCondition($collproduct, $data['cond']);
        foreach ($getitem as $item) {
            $item['item_id'] = $item['_id']->{'$id'};
            $item['shop_id'] = $item['shop_id']->{'$id'};
            $item['subcategory_id'] = ($item['subcategory_id'] != '' ? $item['_id']->{'$id'} : '');
            $item['harga'] = ($item['harga'] == '' ? 0 : (int) $item['harga']);
            $item['jumlah'] = ($item['jumlah'] == '' ? 0 : (int) $item['jumlah']);
//            $condpict = array('item_id' => $item['_id'], 'fdelete' => '1');
             $condpict = array('item_id' => new MongoId($item['item_id']), 'fdelete' => '1');
//             print_r($condpict);die(0);
//%pict            $item['subcategory_id'] = $item['subcategory_id']->{'$id'};
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
//            print_r($picture);die(0);
            $item['listpict'] = $picture;
            $item['create_date'] = strtotime($item['create_date']);
            $item['modified_date'] = strtotime($item['modified_date']);
            unset($item['_id']);
            unset($item['fdelete']);
            unset($item['modified_by']);
            unset($item['create_by']);
            array_push($product, $item);
        }

        return $product;
    }

    function Get_item_withcond($data) {
        $coll = 'tproduct';
        $limit = '5';
        $sort = array('create_date' => '1');
        if (isset($data['f_id']) && $data['f_id'] != '' && isset($data['shop_id']) && $data['shop_id'] != '') {
            $id = new MongoId($data['f_id']);
            $condchek = array(
                '_id' => $id,
                'shop_id' => new MongoId($data['shop_id']),
                'fdelete' => '1'
            );
            $getdata = $this->globalmodel->getOneRecordWithCond($condchek, $coll);

            $cond = array(
                'fdelete' => '1',
                'create_date' => array('$gt' => $getdata['create_date'])
            );
        } else if (isset($data['l_id']) && $data['l_id'] != '' && $data['shop_id'] != '') {
            $id = new MongoId($data['l_id']);
            $condchek = array(
                '_id' => $id,
                'shop_id' => new MongoId($data['shop_id']),
                'fdelete' => '1'
            );
            $getdata = $this->globalmodel->getOneRecordWithCond($condchek, $coll);

            $cond = array(
                'fdelete' => '1',
                'create_date' => array('$lt' => $getdata['create_date'])
            );
        }
        $getdata = $this->homeModel->get_tabel_conditionlimitsort($cond, $limit, $sort, $coll);
        $item = array();
        if (sizeof($getdata) > 0) {
            foreach ($getdata as $row) {

                $row['_id'] = $row['_id']->{'$id'};
                unset($row['_id']);
                unset($row['fdelete']);
                unset($row['create_by']);
                unset($row['modified_by']);
                unset($row['modified_date']);
                array_push($item, $row);
            }
        }
        return $item;
    }

    function Get_CategoryList($data) {

        $cond = array(
            'fdelete' => '1',
            
            '_id' => new MongoId($data['category_id'])
        );
        $listcategory = $this->globalmodel->getRecordWithCondition('tsub_lookup', $cond);
        foreach($listcategory as $lc){
            $conditem=array();
            $listcategory = $this->globalmodel->getRecordWithCondition('tsub_lookup', $cond);
        }
    }

    function AddFollower($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $add = array(
            'shop_id_followed' => new MongoId($data['shop_id_followed']),
            'user_id_follower' => new MongoId($data['user_id_follower']),
            'fdelete' => '1',
            'created_date' => $tanggal,
            'created_by' => '',
            'modified_date' => $tanggal,
            'modified_by' => '',
        );
//        $datainsert = array_merge($data, $add);
        $insert = $this->globalmodel->insertToDatabase('tfollow', $add);
        if ($insert) {
            return 10;
        } else {
            return 11;
        }
    }

    function Followeruser($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $shop = array();
        $follow = array();
        $cond = array(
            'fdelete' => '1',
            'user_id' => new MongoId($data['user_id'])
        );
//        print_r($cond);die(0);
        $listshop = $this->globalmodel->getRecordWithCondition('tshop', $cond);

        foreach ($listshop as $ls) {
//             $shop=array();
//             unset($ls['_id']);
            $ls['user_id'] = $ls['user_id']->{'$id'};
            $ls['shop_id'] = $ls['_id']->{'$id'};
            unset($ls['fdelete']);
            unset($ls['created_by']);
            unset($ls['created_date']);
            unset($ls['modified_by']);
            unset($ls['modified_date']);
            $condfollow = array(
                'fdelete' => '1',
                'shop_id_followed' => $ls['_id']
            );
//             print_r($condfollow);
//        die(0);
            $listfollow = $this->globalmodel->getRecordWithCondition('tfollow', $condfollow);
            foreach ($listfollow as $lf) {
                $listfollow = $this->globalmodel->getOneRecordWithCond(array('_id' => $lf['user_id_follower'], 'fdeleted' => '1'), 'tuser');

                $lf['shop_id_followed'] = $lf['shop_id_followed']->{'$id'};
                $lf['user_id_follower'] = $lf['user_id_follower']->{'$id'};
                $lf['nama'] = $listfollow['nama'];
                $lf['telp'] = $listfollow['no_telp'];
                $lf['alamat'] = $listfollow['alamat'];
                unset($lf['_id']);
                unset($lf['fdelete']);
                unset($lf['created_by']);
                unset($lf['created_date']);
                unset($lf['modified_by']);
                unset($lf['modified_date']);
                array_push($follow, $lf);
            }
            $ls['listfollower'] = $follow;
            unset($ls['_id']);
            array_push($shop, $ls);
        }
//        print_r($shop);
//        die(0);
//        $datainsert = array_merge($data, $add);
        return $shop;
    }
    function Follower($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $shop = array();
        $follow = array();
        $cond = array(
            'fdelete' => '1',
            'shop_id_followed' => new MongoId($data['shop_id_followed'])
        );
//        print_r($cond);die(0);
        
            $listfollow = $this->globalmodel->getRecordWithCondition('tfollow', $cond);
            foreach ($listfollow as $lf) {
                $listusr = $this->globalmodel->getOneRecordWithCond(array('_id' => $lf['user_id_follower'], 'fdeleted' => '1'), 'tuser');

                $lf['shop_id_followed'] = $lf['shop_id_followed']->{'$id'};
                $lf['user_id_follower'] = $lf['user_id_follower']->{'$id'};
                $lf['nama'] = $listusr['nama'];
                $lf['telp'] = $listusr['no_telp'];
                $lf['alamat'] = $listusr['alamat'];
                unset($lf['_id']);
                unset($lf['fdelete']);
                unset($lf['created_by']);
                unset($lf['created_date']);
                unset($lf['modified_by']);
                unset($lf['modified_date']);
                array_push($follow, $lf);
            }
           
            
        
//        print_r($shop);
//        die(0);
//        $datainsert = array_merge($data, $add);
        return $follow;
    }

    function newrelease() {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $product = array();
        $follow = array();
        $cond = array(
            'fdelete' => '1',
        );
        $sort = array('modified_date' => -1);
//        print_r($cond);die(0);
        $listitem = $this->get_tabel_conditionlimitsort($cond, '10', $sort, 'tproduct');

        foreach ($listitem as $item) {
            $item['item_id'] = $item['_id']->{'$id'};
            $item['shop_id'] = $item['shop_id']->{'$id'};
            $item['subcategory_id'] = ($item['subcategory_id'] != '' ? $item['_id']->{'$id'} : '');
            $item['harga'] = ($item['harga'] == '' ? 0 : (int) $item['harga']);
            $item['jumlah'] = ($item['jumlah'] == '' ? 0 : (int) $item['jumlah']);
//          
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
            array_push($product, $item);
        }
//        die(0);
//        print_r($product);
//        die(0);
//        $datainsert = array_merge($data, $add);
        return $product;
    }

}
