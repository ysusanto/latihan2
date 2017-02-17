<?php

/**
 * Description of registerlogin_model
 * create by    : Yohanes 
 * create date  : 09-02-2015
 */
class webshop_model extends CI_Model {

    function webshop_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function getshopdetail($condition) {
        $db = $this->load->database('default', TRUE);
        $shopitem = array();
//        $condShop = array(
//            'user_id' => new MongoId($condition['user_id']),
//            'fdelete' => '1'
//        );
//        $colshop = 'tshop';
//        $shopdet = $this->globalmodel->getOneRecordWithCond($condShop, $colshop);
        $sql = "select shop_id,shop_id2,nama_toko,alamat,fdesc,telp_toko,modified_date from tshop where fdelete='1' and user_id='" . $condition['user_id'] . "'";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $shopdet = $query->row_array();
            $shopdet['shop_id']=($shopdet['shop_id2']!=''? $shopdet['shop_id2']:$shopdet['shop_id']);
            $sqlpict = "select pict_id,shop_id,nama,path,thumb_path,ypos from tpicture_shop where fdelete='1' and shop_id='" . ($shopdet['shop_id2']!='' ? $shopdet['shop_id2']:$shopdet['shop_id']) . "'";
            $querypict = $db->query($sqlpict);
            if ($querypict->num_rows() > 0) {
                $shoppict = $querypict->row_array();
            } else {
                $shoppict = null;
            }

            $sqlitem = "select item_id,item_id2,shop_id,nama,harga,fdesc,is_sold,jumlah,min_jumlah,min_satuan,subcategory_id as 'category_id',modified_date from tproduct where fdelete='1' and shop_id='" . ($shopdet['shop_id2']!='' ? $shopdet['shop_id2']:$shopdet['shop_id']) . "'";
            $queryitem = $db->query($sqlitem);
            if ($queryitem->num_rows() > 0) {
                foreach ($queryitem->result_array() as $item) {
                    $item['gambar'] = array();
//                    $condItemPict = array('item_id' => $item['_id'], 'fdelete' => '1');
//                    $collitempict = 'tpicture_item';
//                    $getpictItem = $this->globalmodel->getRecordWithCondition($collitempict, $condItemPict);
                    $sqlpict = "select pict_id,item_id,nama,path,thumb_path from tpicture_product where fdelete='1' and item_id='" . ($item['item_id2']!=''? $item['item_id2'] : $item['item_id']) . "'";
                    $querypict = $db->query($sqlpict);


                    if ($querypict->num_rows() > 0) {
                        foreach ($querypict->result_array() as $pict) {

                            array_push($item['gambar'], $pict);
                        }
                    }
                    array_push($shopitem, $item);
                }
            }
//print_r($shopitem);die(0);
            $shopinfo = array(
                'shopdet' => $shopdet,
                'shoppict' => $shoppict,
                'shopitem' => $shopitem
            );
            return $shopinfo;
        } else {
            return 0;
        }
    }

    function save_shop($data) {
        $db = $this->load->database('default', TRUE);
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $balikan = array();

        $sql = "select shop_id,nama_toko,alamat,fdesc,telp_toko,modified_date from tshop where fdelete='1' and user_id='" . $data['user_id'] . "'";
        $query = $db->query($sql);

        if ($query->num_rows() > 0) {
            $balikan = array(
                'status' => 2,
                'message' => 'Anda sudah memiliki toko'
            );
        } else {
            $datainsert = array(
                'user_id' => $data['user_id'],
                'nama_toko' => (isset($data['shopname']) ? $data['shopname'] : ''),
                'lokasi_id' => (isset($data['lokasi_id']) ? $data['lokasi_id'] : ''),
                'alamat' => (isset($data['shopaddress']) ? $data['shopaddress'] : ''),
                'desc' => (isset($data['desc']) ? $data['desc'] : ''),
                'fdelete' => '1',
                'create_date' => $tanggal,
                'create_by' => '',
                'modified_date' => $tanggal,
                'modified_by' => ''
            );
            $sql = "insert tshop(user_id,nama_toko,alamat,fdesc,fdelete,create_date,modified_date) values (";
            $sql.="'" . $datainsert['user_id'] . "',";
            $sql.="'" . $datainsert['nama_toko'] . "',";
            $sql.="'" . $datainsert['alamat'] . "',";
            $sql.="'" . $datainsert['desc'] . "',";
            $sql.="'" . $datainsert['fdelete'] . "',";
            $sql.="'" . $datainsert['create_date'] . "',";
            $sql.="'" . $datainsert['modified_date'] . "')";
            $query = $db->query($sql);

//            $insertshop = $this->globalmodel->insertToDatabase('tshop', $datainsert);
            if ($query) {
                
                $sql = "select shop_id from tshop where fdelete='1' and user_id='" . $data['user_id'] . "'";
                $query = $db->query($sql);
                $row = $query->row_array();
                $tabel = "tshop";
                $action = "Insert shop_name : " . $data['shopname'] . ", id : " . $row['shop_id'];
                $stat = " status : Success";
                $msg = $row['shop_id'];
                $balikan = array(
                    'status' => 1,
                    'message' => 'Toko Anda sudah berhasil didaftarkan'
                );
            } else {
                $msg = '11';
                $tabel = "tshop";
                $action = "Insert shop_name : " . $data['shopname'] . ", id : " . $insertshop->{'$id'};
                $stat = " status : Gagal";
                $balikan = array(
                    'status' => 0,
                    'message' => 'Terjadi kesalahan. Silakan coba lagi'
                );
            }
            $datalog = array(
                "tabel" => $tabel,
                "action" => "Insert",
                "desc" => $action,
                "status" => $stat,
                "create_date" => $tanggal
            );
//            $this->globalmodel->insertToDatabase('tlog', $datalog);
        }
        return $balikan;
    }

    function getcategory() {
        $db = $this->load->database('default', TRUE);
        $cond = array(
            'fdelete' => '1'
        );
        $col = 'tsub_lookup';
        $sql = "select id_sublookup,nama_sub,lookup_id from tsub_lookup where fdelete='1'";
        $query = $db->query($sql);

//        $cate = $this->globalmodel->getRecordWithCondition($col, $cond);
        $balikan = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($balikan, $row);
            }
        }
        return $balikan;
    }

    function getsatuan() {
        $db = $this->load->database('default', TRUE);
        $cond = array(
            'fdelete' => '1'
        );
        $sql = "select * from tsatuan where fdelete='1'";
        $query = $db->query($sql);
        $balikan = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                array_push($balikan, $row);
            }
        }
        return $balikan;
    }

    function saveItem($data) {
//        print_r($data);die(0);
        $db = $this->load->database('default', TRUE);
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $balikan = array();
        $datainsert = array(
            'shop_id' => $data['shopid'],
            'nama' => (isset($data['itemname']) ? $data['itemname'] : ''),
            'subcategory_id' => $data['itemcate'],
            'harga' => (isset($data['itemprice']) ? $data['itemprice'] : ''),
            'desc' => (isset($data['itemdesc']) ? $data['itemdesc'] : ''),
            'jumlah' => '0',
            'min_jumlah' => (isset($data['min-jumlah']) ? $data['min-jumlah'] : '1'),
            'min_satuan' => (isset($data['min-satuan']) ? $data['min-satuan'] : 'Satuan'),
            'is_sold' => (isset($data['issold']) ? $data['issold'] : '0'),
            'fdelete' => '1',
            'create_date' => $tanggal,
            'create_by' => '',
            'modified_date' => $tanggal,
            'modified_by' => ''
        );
//        $insertItem = $this->globalmodel->insertToDatabase('tproduct', $datainsert);

        $sql = "insert tproduct(shop_id,nama,subcategory_id,harga,fdesc,jumlah,min_jumlah,min_satuan,is_sold,fdelete,create_date,modified_date) values (";
        $sql.="'" . $datainsert['shop_id'] . "',";
        $sql.="'" . $datainsert['nama'] . "',";
        $sql.="'" . $datainsert['subcategory_id'] . "',";
        $sql.="'" . $datainsert['harga'] . "',";
        $sql.="'" . $datainsert['desc'] . "',";
        $sql.="'" . $datainsert['jumlah'] . "',";
        $sql.="'" . $datainsert['min_jumlah'] . "',";
        $sql.="'" . $datainsert['min_satuan'] . "',";
        $sql.="'" . $datainsert['is_sold'] . "',";
        $sql.="'" . $datainsert['fdelete'] . "',";
        $sql.="'" . $datainsert['create_date'] . "',";
        $sql.="'" . $datainsert['modified_date'] . "')";
        $query = $db->query($sql);
        if ($query) {
            $tabel = "tproduct";
            $action = "Insert item_name : " . $data['itemname'] . ", id : ";
            $stat = " status : Success";
            $select = "select item_id from tproduct where fdelete='1' and nama='" . $datainsert['nama'] . "' and create_date='" . $datainsert['create_date'] . "'";
            $qry = $db->query($select);
            $insertItem = $qry->row_array();
            $msg = $insertItem['item_id'];
            $datalog = array(
                "tabel" => $tabel,
                "action" => "Insert",
                "desc" => $action,
                "status" => $stat,
                "create_date" => $tanggal
            );
//            $this->globalmodel->insertToDatabase('tlog', $datalog);

            $datainsertpict = array(
                'create_by' => '',
                'create_date' => $tanggal,
                'fdelete' => '1',
                'item_id' => $insertItem['item_id'],
                'modified_date' => $tanggal,
                'nama' => (isset($data['namaimage']) ? $data['namaimage'] : ''),
                'path' => (isset($data['mainimage']) ? $data['mainimage'] : ''),
                'status_pict' => '1',
                'thumb_path' => (isset($data['thumbimage']) ? $data['thumbimage'] : '')
            );
            $sql = "insert tpicture_product(item_id,nama,path,thumb_path,status_pict,fdelete,create_date,modified_date) values (";
            $sql.="'" . $datainsertpict['item_id'] . "',";
            $sql.="'" . $datainsertpict['nama'] . "',";
            $sql.="'" . $datainsertpict['path'] . "',";
            $sql.="'" . $datainsertpict['thumb_path'] . "',";
            $sql.="'" . $datainsertpict['status_pict'] . "',";
            $sql.="'" . $datainsert['fdelete'] . "',";
            $sql.="'" . $datainsert['create_date'] . "',";
            $sql.="'" . $datainsert['modified_date'] . "')";
            $query2 = $db->query($sql);
//            $insertPict = $this->globalmodel->insertToDatabase('tpicture_item', $datainsertpict);
            if ($query2) {
                $tabel = "tpicture_item";
                $action = "Insert item_pict : " . $data['itemname'] . ", id : ";
                $stat = " status : Success";
                $msg = $insertItem;
                $datalog = array(
                    "tabel" => $tabel,
                    "action" => "Insert",
                    "desc" => $action,
                    "status" => $stat,
                    "create_date" => $tanggal
                );
//                $this->globalmodel->insertToDatabase('tlog', $datalog);
                $balikan = array(
                    'status' => 1,
                    'message' => 'Upload Item Sukses'
                );
            } else {
                $msg = '11';
                $tabel = "tpicture_item";
                $action = "Insert item_pict : " . $data['itemname'];
                $stat = " status : Gagal";
                $datalog = array(
                    "tabel" => $tabel,
                    "action" => "Insert",
                    "desc" => $action,
                    "status" => $stat,
                    "create_date" => $tanggal
                );
//                $this->globalmodel->insertToDatabase('tlog', $datalog);
                $balikan = array(
                    'status' => 0,
                    'message' => 'Terjadi kesalahan. Silakan coba lagi'
                );
            }
        } else {
            $msg = '11';
            $tabel = "tproduct";
            $action = "Insert item_name : " . $data['itemname'];
            $stat = " status : Gagal";
            $datalog = array(
                "tabel" => $tabel,
                "action" => "Insert",
                "desc" => $action,
                "status" => $stat,
                "create_date" => $tanggal
            );
            $this->globalmodel->insertToDatabase('tlog', $datalog);
            $balikan = array(
                'status' => 0,
                'message' => 'Terjadi kesalahan. Silakan coba lagi'
            );
        }

        return $balikan;
    }

    function deleteItem($data) {
        $db=$this->load->database('default',TRUE);
//        $coll1 = 'tproduct';
//        $cond1 = array(
//            '_id' => new MongoId($data['itemid'])
//        );
//        $set1 = array(
//            '$set' => array(
//                'fdelete' => '0'
//            )
//        );
        $sql="update tproduct set fdelete='0' where item_id='".$data['itemid']."'";
        $qry=$db->query($sql);
//        $deleteitem = $this->globalmodel->UpdateRecordWithCond($cond1, $set1, $coll1);
        if ($qry) {
            $balikan = array(
                'status' => 1,
                'message' => 'Hapus Item Sukses'
            );
        } else {
            $balikan = array(
                'status' => 0,
                'message' => 'Terjadi kesalahan. Silakan coba lagi'
            );
        }
        return $balikan;
    }

    function editItem($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $balikan = array();
//        $coll1 = 'tproduct';
        $db = $this->load->database('default', TRUE);
        $sql = "update tproduct set ";
        $sql.="nama='" . (isset($data['itemname']) ? $data['itemname'] : '') . "', ";
        $sql.="subcategory_id='" . $data['itemcate'] . "', ";
        $sql.="harga='" . (isset($data['itemprice']) ? $data['itemprice'] : '') . "', ";
        $sql.="fdesc='" . (isset($data['itemdesc']) ? $data['itemdesc'] : '') . "', ";
        $sql.="min_jumlah='" . (isset($data['min-jumlah']) ? $data['min-jumlah'] : '1') . "',";
        $sql.="min_satuan='" . (isset($data['min-satuan']) ? $data['min-satuan'] : 'Satuan') . "', ";
        $sql.="is_sold='" . (isset($data['issold']) ? $data['issold'] : '0') . "', ";
        $sql.="modified_date='" . $tanggal . "' ";
        $sql.="where fdelete = '1' and item_id='" . $data['item_id'] . "'";
        $qry=$db->query($sql);
//        $cond1 = array(
//            '_id' => new MongoId($data['item_id']),
//            'fdelete' => '1'
//        );
//        $set1 = array(
//            '$set' => array(
//                'nama' => (isset($data['itemname']) ? $data['itemname'] : ''),
//                'subcategory_id' => new MongoId($data['itemcate']),
//                'harga' => (isset($data['itemprice']) ? $data['itemprice'] : ''),
//                'desc' => (isset($data['itemdesc']) ? $data['itemdesc'] : ''),
//                'min_jumlah' => (isset($data['min-jumlah']) ? $data['min-jumlah'] : '1'),
//                'min_satuan' => (isset($data['min-satuan']) ? $data['min-satuan'] : 'Satuan'),
//                'is_sold' => (isset($data['issold']) ? $data['issold'] : '0'),
//                'modified_date' => $tanggal,
//                'modified_by' => 'seller'
//            )
//        );
//        $updateitem = $this->globalmodel->UpdateRecordWithCond($cond1, $set1, $coll1);
        if ($qry) {
            if ($data['namaimage'] != '') {
//                $cond_del = array(
//                    '_id' => new MongoId($data['oldpic'])
//                );
//                $this->globalmodel->deleteRecordWithCondition('tpicture_item', $cond_del);
                $sql="delete from tpicture_product where pict_id='".$data['oldpic']."'";
                $exe=$db->query($sql);
                
                $sqlins="insert into tpicture_product(nama,path,thumb_path,item_id,create_date,fdelete,status_pict) values('";
                $sqlins.= (isset($data['namaimage']) ? $data['namaimage'] : '')."','";
                $sqlins.= (isset($data['mainimage']) ? $data['mainimage'] : '')."','";
                $sqlins.= (isset($data['thumbimage']) ? $data['thumbimage'] : '')."','";
                $sqlins.= (isset($data['item_id']) ? $data['item_id'] : '')."','";
                $sqlins.= $tanggal."','";
                $sqlins.= "1','";
                $sqlins.= "1')";
                $insertPict=$db->query($sqlins);
                
               

//                $insertPict = $this->globalmodel->insertToDatabase('tpicture_item', $datainsertpict);
                if ($insertPict) {
                    $balikan = array(
                        'status' => 1,
                        'message' => 'Upload Item Sukses'
                    );
                } else {
                    $balikan = array(
                        'status' => 0,
                        'message' => 'Terjadi kesalahan. Silakan coba lagi'
                    );
                }
            } else {
                $balikan = array(
                    'status' => 1,
                    'message' => 'Upload Item Sukses'
                );
            }
        } else {
            $balikan = array(
                'status' => 0,
                'message' => 'Terjadi kesalahan. Silakan coba lagi'
            );
        }

        return $balikan;
    }

    function updateCover($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $db = $this->load->database('default', TRUE);
        $balikan = array();
//        $condShop = array(
//            'shop_id' => new MongoId($data['shopid']),
//            'fdelete' => '1'
//        );
        $sql = "select * from tpicture_shop where fdelete='1' and shop_id='" . $data['shopid'] . "'";
        $query = $db->query($sql);
//        $colshop = 'tpicture_shop';
//        $cekcover = $this->globalmodel->getOneRecordWithCond($condShop, $colshop);
        if ($query->num_rows() > 0) {
            $coll1 = 'tpicture_shop';
//            $cond1 = array(
//                'shop_id' => new MongoId($data['shopid']),
//                'fdelete' => '1'
//            );
//            $set1 = array(
//                '$set' => array(
//                    'modified_date' => $tanggal,
//                    'nama' => (isset($data['namaimage']) ? $data['namaimage'] : ''),
//                    'path' => (isset($data['mainimage']) ? $data['mainimage'] : ''),
//                    'thumb_path' => (isset($data['thumbimage']) ? $data['thumbimage'] : ''),
//                    'ypos' => (isset($data['yposition']) ? $data['yposition'] : '0')
//                )
//            );
//            $updatecover = $this->globalmodel->UpdateRecordWithCond($cond1, $set1, $coll1);
            $sql = "update tpicture_shop set ";
            $sql .="modified_date='" . $tanggal . "', ";
            $sql .="nama='" . (isset($data['namaimage']) ? $data['namaimage'] : '') . "', ";
            $sql .="path='" . (isset($data['mainimage']) ? $data['mainimage'] : '') . "', ";
            $sql .="thumb_path='" . (isset($data['thumbimage']) ? $data['thumbimage'] : '') . "', ";
            $sql .="ypos='" . (isset($data['yposition']) ? $data['yposition'] : '0') . "' ";
            $sql .= "where fdelete='1' and shop_id='" . $data['shopid'] . "'";
            $updatecover = $db->query($sql);
            if ($updatecover) {
                $balikan = array(
                    'status' => 1,
                    'message' => 'Upload Item Sukses'
                );
            } else {
                $balikan = array(
                    'status' => 0,
                    'message' => 'Terjadi kesalahan. Silakan coba lagi'
                );
            }
        } else {
            $datainsert = array(
                'create_by' => 'seller',
                'create_date' => $tanggal,
                'fdelete' => '1',
                'modified_by' => 'seller',
                'modified_date' => $tanggal,
                'nama' => (isset($data['namaimage']) ? $data['namaimage'] : ''),
                'path' => (isset($data['mainimage']) ? $data['mainimage'] : ''),
                'shop_id' => $data['shopid'],
                'status_pict' => '1',
                'thumb_path' => (isset($data['thumbimage']) ? $data['thumbimage'] : ''),
                'ypos' => (isset($data['yposition']) ? $data['yposition'] : '0')
            );
            $sql = "insert tpicture_shop(shop_id,nama,path,thumb_path,status_pict,ypos,fdelete,create_date,modified_date) values (";
            $sql.="'" . $datainsert['shop_id'] . "',";
            $sql.="'" . $datainsert['nama'] . "',";
            $sql.="'" . $datainsert['path'] . "',";
            $sql.="'" . $datainsert['thumb_path'] . "',";
            $sql.="'" . $datainsert['status_pict'] . "',";
            $sql.="'" . $datainsert['ypos'] . "',";
            $sql.="'" . $datainsert['fdelete'] . "',";
            $sql.="'" . $datainsert['create_date'] . "',";
            $sql.="'" . $datainsert['modified_date'] . "')";
            $query = $db->query($sql);
//            $insertCover = $this->globalmodel->insertToDatabase('tpicture_shop', $datainsert);
            if ($query) {
                $balikan = array(
                    'status' => 1,
                    'message' => 'Upload Item Sukses'
                );
            } else {
                $balikan = array(
                    'status' => 0,
                    'message' => 'Terjadi kesalahan. Silakan coba lagi'
                );
            }
        }

        return $balikan;
    }

    function format_to_idr($integer) {
        $string = (string) $integer;
        $i = strlen($string) - 3;
        for ($i; $i > 0; $i-=3) {
            $string = substr_replace($string, '.', $i, 0);
        }
        return $string;
    }

    function addcollection($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $balikan = array();
        $datainsert = array(
            'nama' => 'Kodi',
            'jumlah' => '20',
            'fdelete' => '1',
            'create_date' => $tanggal,
            'create_by' => '',
            'modified_date' => $tanggal,
            'modified_by' => ''
        );

        $this->globalmodel->insertToDatabase('tsatuan', $datainsert);
    }

    function getitemdetail($data) {
        $collitem = "tproduct";
        $db = $this->load->database('default', TRUE);
//        $cond = array(
//            '_id' => new MongoId($data['item_id']),
//            'fdelete' => '1'
//        );
//        $item = $this->globalmodel->getOneRecordWithCond($cond, $collitem);
        $sql = "select * from tproduct where fdelete='1' and item_id='" . $data['item_id'] . "'";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $item = $query->row_array();
            $item['gambar'] = array();

//            $condItemPict = array('item_id' => $item['_id'], 'fdelete' => '1');
//            $collitempict = 'tpicture_item';
//            $getpictItem = $this->globalmodel->getRecordWithCondition($collitempict, $condItemPict);
            $sqlpict = "select * from tpicture_product where fdelete='1' and item_id='" . $item['item_id'] . "'";
            $qry = $db->query($sqlpict);
            if ($qry->num_rows() > 0) {
                foreach ($qry->result_array() as $pict) {
//                    $pict['pict_id'] = $pict['_id']->{'$id'};
//                    unset($pict['_id']);
                    unset($pict['modified_by']);
                    unset($pict['create_by']);
                    array_push($item['gambar'], $pict);
                }
            }
        }
//        print_r($item);die(0);
        return $item;
    }

    function getSingleShopDetail($data) {
        $collshop = "tshop";
        $cond = array(
            '_id' => new MongoId($data['shopid']),
            'fdelete' => '1'
        );
        $shop = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
        if (sizeof($shop) > 0) {
            $shop['gambar'] = array();
            $condShopPict = array('shop_id' => $shop['_id'], 'fdelete' => '1');
            $collshoppict = 'tpicture_shop';
            $getpictShop = $this->globalmodel->getRecordWithCondition($collshoppict, $condShopPict);
            if (sizeof($getpictShop) > 0) {
                foreach ($getpictShop as $pict) {
                    $pict['pict_id'] = $pict['_id']->{'$id'};
                    unset($pict['_id']);
                    unset($pict['modified_by']);
                    unset($pict['create_by']);
                    array_push($shop['gambar'], $pict);
                }
            }
        }
        return $shop;
    }

    function followshop($data) {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d h:i:sa');
        $collshop = "tfollow";
        $cond = array(
            'shop_id_followed' => new MongoId($data['shopid']),
            'user_id_follower' => new MongoId($data['user_id'])
        );
        $cekfollow = $this->globalmodel->getOneRecordWithCond($cond, $collshop);
        if (sizeof($cekfollow) > 0) {
            $balikan = array(
                'status' => 1,
                'message' => 'Follow Toko Sukses'
            );
        } else {
            $coll2 = "tshop";
            $cond2 = array(
                '_id' => new MongoId($data['shopid']),
                'user_id' => new MongoId($data['user_id'])
            );
            $cekownershop = $this->globalmodel->getOneRecordWithCond($cond2, $coll2);
            if (sizeof($cekfollow) > 0) {
                $balikan = array(
                    'status' => 0,
                    'message' => 'Anda tidak dapat memfollow toko Anda sendiri.'
                );
            } else {
                $datainsert = array(
                    'shop_id_followed' => new MongoId($data['shopid']),
                    'user_id_follower' => new MongoId($data['user_id']),
                    'fdelete' => '1',
                    'created_by' => '',
                    'created_date' => $tanggal,
                    'modified_date' => $tanggal,
                    'modified_by' => ''
                );
                $insertFollow = $this->globalmodel->insertToDatabase('tfollow', $datainsert);
                if ($insertFollow != '11') {
                    $balikan = array(
                        'status' => 1,
                        'message' => 'Follow Toko Sukses'
                    );
                } else {
                    $balikan = array(
                        'status' => 0,
                        'message' => 'Terjadi kesalahan. Silakan coba lagi'
                    );
                }
            }
        }
        return $balikan;
    }

}
