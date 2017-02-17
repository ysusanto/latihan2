<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class sync_model extends CI_Model {

    function sync_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function cheklastupdate() {
        $db = $this->load->database('default', TRUE);
        $userdata = array();
        $sqllast = "select * from tsync order by last_update desc limit 1";
        $qry = $db->query($sqllast);
        if ($qry->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function gedatauser($data) {
        $db = $this->load->database('default', TRUE);
        $userdata = array();
//        $sqllast = "select * from tsync order by last_update desc limit 1";
//        $qry = $db->query($sqllast);
        if ($data != 0) {
            $sqluser = "select us.user_id,us.user_id2,us.nama,us.alamat,us.no_telp,lo.username,lo.password,lo.levelid from tuser us inner join tlogin lo on us.user_id=lo.user_id where us.fdelete='1' and us.modified_date>=(select last_update from tsync order by last_update desc limit 1)";
        } else {
            $sqluser = "select us.user_id,us.user_id2,us.nama,us.alamat,us.no_telp,lo.username,lo.password,lo.levelid from tuser us inner join tlogin lo on us.user_id=lo.user_id where us.fdelete='1'";
        }
//print_r($sqluser);die(0);
        $query = $db->query($sqluser);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $value) {
                $dtshop['user_id'] = $value['user_id'];

                $shop = $this->singleshop($dtshop);
                if (sizeof($shop) > 0) {
                    $value2 = array_merge($value, $shop);
                } else {
                    continue;
                }
                array_push($userdata, $value2);
            }
        }
        return $userdata;
    }

    function singleshop($data) {
        $db = $this->load->database('default', TRUE);


        $sqlshop = "select s.shop_id,s.shop_id2,s.user_id,s.nama_toko,s.alamat,s.fdesc,s.telp_toko,ps.nama as 'nama_cover',ps.path as 'path_cover',ps.thumb_path as 'thumb_path_cover',ps.ypos from tshop s left join tpicture_shop ps on s.shop_id=ps.shop_id  where s.fdelete='1' and s.user_id='" . $data['user_id'] . "' and s.modified_date>=(select last_update from tsync order by last_update desc limit 1)";
        $query = $db->query($sqlshop);
        if ($query->num_rows() > 0) {
            $shop = $query->row_array();
//            $sqlpict = "select pict_id,shop_id,nama,path,thumb_path,ypos from tpicture_shop where fdelete='1' and shop_id='" . $shop['shop_id'] . "'";
//            $qry = $db->query($sqlpict);
//            if ($qry->num_rows() > 0) {
//                $cover = $qry->row_array();
//            } else {
//                $cover = null;
//            }
//            $shop['nama_cover'] = $cover['nama'];
//            $shop['path_cover'] = $cover['path'];
//            $shop['thumb_path_cover'] = $cover['thumb_path'];
//            $shop['ypos'] = $cover['ypos'];
//            $dtitem['shop_id'] = $shop['shop_id'];
//            $item = $this->getitem($dtitem);
//            $shop['list_item'] = $item;
        } else {
            $shop = null;
        }

        return $shop;
    }

    function getitem($data) {
        $db = $this->load->database('default', TRUE);
        $item = array();
        $sqlitem = "select a.item_id,a.item_id2,a.shop_id,a.nama,a.harga,a.fdesc,a.min_jumlah,a.min_satuan,b.nama_sub as 'subcategory_id',a.jumlah,pp.nama as 'nama_pict',pp.path as 'path_pict',pp.thumb_path as 'thumb_path_pict' from tproduct a left join tsub_lookup b on a.subcategory_id=b.id_sublookup inner join tpicture_product pp on a.item_id=pp.item_id  where a.fdelete='1' and a.shop_id='" . $data['shop_id'] . "'";
        $query = $db->query($sqlitem);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
//                $sqlpict = "select nama,path,thumb_path from tpicture_product where fdelete='1' and item_id='" . $row['item_id'] . "'";
//                $qry = $db->query($sqlpict);
//                if ($qry->num_rows() > 0) {
//                    $pict = $qry->row_array();
//                } else {
//                    $pict = null;
//                }
//                $row['nama_pict'] = $pict['nama'];
//                $row['path_pict'] = $pict['path'];
//                $row['thumb_path_pict'] = $pict['thumb_path'];

                array_push($item, $row);
            }
        }
        return $item;
    }

    function getItemUpdate($data) {
        $db = $this->load->database('default', TRUE);
        $item = array();
        
        $sqlitem = "select a.item_id,a.item_id2,a.shop_id,a.nama,a.harga,a.fdesc,a.min_jumlah,a.min_satuan,b.nama_sub as 'subcategory_id',a.jumlah,pp.nama as 'nama_pict',pp.path as 'path_pict',pp.thumb_path as 'thumb_path_pict' from tproduct a left join tsub_lookup b on a.subcategory_id=b.id_sublookup left join tpicture_product pp on a.item_id=pp.item_id or a.item_id2=pp.item_id where a.fdelete='1' and a.modified_date>=(select last_update from tsync order by last_update desc limit 1)";
        
        $query = $db->query($sqlitem);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
//                $sqlpict = "select nama,path,thumb_path from tpicture_product where fdelete='1' and item_id='" . $row['item_id'] . "'";
//                $qry = $db->query($sqlpict);
//                if ($qry->num_rows() > 0) {
//                    $pict = $qry->row_array();
//                } else {
//                    $pict = null;
//                }
//                $row['nama_pict'] = $pict['nama'];
//                $row['path_pict'] = $pict['path'];
//                $row['thumb_path_pict'] = $pict['thumb_path'];

                array_push($item, $row);
            }
        }
        return $item;
    }

    function chekuserlogin($data) {
        $db = $this->load->database('default', TRUE);
        $sqluser = "select us.user_id,us.user_id2,us.nama,us.alamat,us.no_telp,lo.username,lo.password,lo.levelid from tuser us inner join tlogin lo on us.user_id=lo.user_id where us.fdelete='1' and username='" . $data['username'] . "'";
        $query = $db->query($sqluser);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
        } else {
            $row = null;
        }
        return $row;
    }

    function chekshop($data) {
        $db = $this->load->database('default', TRUE);
        $sqlshop = "select * from tshop where LOWER(nama_toko)='" . $data['nama_toko'] . "' or user_id='" . $data['user_id'] . "'";
        $query = $db->query($sqlshop);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
        } else {
            $row = null;
        }
        return $row;
    }

    function updatedata($tabel, $update, $cond) {
        $db = $this->load->database('default', TRUE);
        $update = "update " . $tabel . " set " . $update . " where " . $cond;
        $query = $db->query($update);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    function insertLogin($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $db = $this->load->database('default', TRUE);
        $sql = "insert into tlogin(user_id,username,password,levelid,create_date,modified_date,last_update) values (";
        $sql.="'" . $data['user_id'] . "',";
        $sql.="'" . $data['username'] . "',";
        $sql.="'" . $data['password'] . "',";
        $sql.="'0',";
        $sql.="'" . $data['create_date'] . "',";
        $sql.="'" . $data['modified_date'] . "',";
        $sql.="'" . $date . "')";
        $query = $db->query($sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    function insertUser($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');

        $db = $this->load->database('default', TRUE);
        $sql = "insert into tuser(user_id2,nama,no_telp,alamat,fdelete,create_date,modified_date,last_update) values (";
        $sql.="'" . $data['user_id'] . "',";
        $sql.="'',";
        $sql.="'" . $data['no_telp'] . "','','1',";
        $sql.="'" . $data['create_date'] . "',";
        $sql.="'" . $data['modified_date'] . "',";
        $sql.="'" . $date . "')";

//        print_r($sql);die(0);
        $query = $db->query($sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    function insertShop($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');

        $db = $this->load->database('default', TRUE);

        $sql = "insert tshop(shop_id2,user_id,nama_toko,alamat,fdesc,fdelete,create_date,modified_date,last_update) values (";
        $sql.="'" . $data['shop_id'] . "',";
        $sql.="'" . $data['user_id'] . "',";
        $sql.="'" . $data['nama_toko'] . "',";
        $sql.="'" . $data['alamat'] . "',";
        $sql.="'" . $data['desc'] . "',";
        $sql.="'" . (isset($data['fdelete']) ? $data['fdelete'] : '1') . "',";
        $sql.="'" . $data['create_date'] . "',";
        $sql.="'" . $data['modified_date'] . "',";
        $sql.="'" . $date . "')";
        $query = $db->query($sql);
        if ($query) {
            $sqlpict = "insert tpicture_shop(pict_id2,shop_id,nama,path,thumb_path,status_pict,ypos,fdelete,create_date,modified_date,last_update) values (";
            $sqlpict.="'" . (isset($data['pict_id']) ? $data['pict_id'] : '') . "',";
            $sqlpict.="'" . $data['shop_id'] . "',";
            $sqlpict.="'" . $data['nama'] . "',";
            $sqlpict.="'" . $data['path'] . "',";
            $sqlpict.="'" . $data['thumb_path'] . "',";
            $sqlpict.="'" . (isset($data['status_pict']) ? $data['status_pict'] : '') . "',";
            $sqlpict.="'" . $data['ypos'] . "',";
            $sqlpict.="'" . (isset($data['fdelete']) ? $data['fdelete'] : '1') . "',";
            $sqlpict.="'" . $data['create_date'] . "',";
            $sqlpict.="'" . $data['modified_date'] . "',";
            $sqlpict.="'" . $date . "')";
            $qry = $db->query($sqlpict);
            if ($qry) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function insertItem($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');

        $db = $this->load->database('default', TRUE);
        $deletesql = "delete from tproduct where item_id2='" . $data['item_id'] . "'";
        $querysdelete = $db->query($deletesql);
        if ($querysdelete) {


            $sql = "insert tproduct(item_id2,shop_id,nama,subcategory_id,harga,fdesc,jumlah,min_jumlah,min_satuan,is_sold,fdelete,create_date,modified_date,last_update) values (";
            $sql.="'" . $data['item_id'] . "',";
            $sql.="'" . (isset($data['shop_id']) ? $data['shop_id'] : '') . "',";
            $sql.="'" . $data['nama'] . "',";
            $sql.="'" . $data['subcategory_id'] . "',";
            $sql.="'" . $data['harga'] . "',";
            $sql.="'" . $data['desc'] . "',";
            $sql.="'" . $data['jumlah'] . "',";
            $sql.="'" . $data['min_jumlah'] . "',";
            $sql.="'" . $data['min_satuan'] . "',";
            $sql.="'" . $data['is_sold'] . "',";
            $sql.="'" . (isset($data['fdelete']) ? $data['fdelete'] : '1') . "',";
            $sql.="'" . $data['create_date'] . "',";
            $sql.="'" . $data['modified_date'] . "',";
            $sql.="'" . $date . "')";
            $query = $db->query($sql);
            if ($query) {
                $deletesql = "delete from tpicture_product where item_id='" . $data['item_id'] . "'";
                $querysdelete = $db->query($deletesql);
                $sql2 = "insert tpicture_product(pict_id2,item_id,nama,path,thumb_path,status_pict,fdelete,create_date,modified_date,last_update) values (";
                $sql2.="'" . $data['pict_id'] . "',";
                $sql2.="'" . $data['item_id'] . "',";
                $sql2.="'" . $data['nama_pict'] . "',";
                $sql2.="'" . $data['path'] . "',";
                $sql2.="'" . $data['thumb_path'] . "',";
                $sql2.="'" . (isset($data['status_pict']) ? $data['status_pict'] : '0') . "',";
                $sql2.="'" . (isset($data['fdelete']) ? $data['fdelete'] : '1') . "',";
                $sql2.="'" . $data['create_date'] . "',";
                $sql2.="'" . $data['modified_date'] . "',";
                $sql2.="'" . $date . "')";
                $query2 = $db->query($sql2);

                if ($query2) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    }

    function resizePict($p, $image) {
//          $images = $_FILES["userfile"]["tmp_name"];
//        $new_images = "thumb_" . $data["name"];
        $max_width = 100; // Max thumbnail width.
        $max_height = 250; // Max thumbnail height.
        $quality = 100; // Do not change this if you plan on using PNG images.
//        copy($_FILES,"Photos/".$_FILES["userfile"]["name"]);
        //*** Fix Width & Heigh (Autu caculate) ***//
//        $img = str_replace('data:image/jpg;base64,', '', $data['image']);
//        $img = str_replace(' ', '+', $data['image']);
//        $pic = base64_decode($img);
        $size = GetimageSize($image);
        $width = $size[0];
//        $height = $size[1];
        $height = round($width * $size[1] / $size[0]);
//        $ratio = ($width > $height) ? $max_width / $width : $max_height / $height;
//        geti
//        print_r($size);die(0);
////        $ratio = $width / $height;
//        if ($width > $height) {
//           
//        } else {
//            $width = round($height * 3 / 4);
//        }
//        if ($width > $max_width || $height > $max_height) {
//            $new_width = $width * $ratio;
//            $new_height = $height * $ratio;
//        } else {
//            $new_width = $width;
//            $new_height = $height;
//        }
//        $p = $data['thumb_path'] . $new_images;
//        $images_orig = ImageCreateFromJPEG($image);
        switch (strtolower($size['mime'])) {
            case 'image/png':
//                 $im = imagecreatefromstring($pic);
                imagepng($image, $p);
//                imagejpeg($im, $p);
//                $images_orig = imagecreatefrompng(base_url() . $image);
//                imagecrea
//                $q = 9 / 100;
//                $quality = $q;
//                imagepng(base_url() . $image, "Tes abcder", 9);
                break;
            case 'image/jpeg':
                imagejpeg($image, $p);
//                $images_orig = imagecreatefromjpeg(base_url() . $image);
                break;
//            case 'image/gif':
//                $images_orig = imagecreatefromgif(base_url() . $image);
//                break;
            default: die();
        }
//        $images_orig = imagecreatefromjpeg(base_url() . $image);
//        $photoX = ImagesX($images_orig);
//        $photoY = ImagesY($images_orig);
//        $images_fin = ImageCreateTrueColor($width, $height);
//        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
//        ImageDestroy($images_orig);
        ImageDestroy($image);
    }

    function insertkategori($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
//echo json_encode($data);die(0);
        $db = $this->load->database('default', TRUE);
        if (sizeof($data) > 0) {
            foreach ($data as $dt) {
//                 print_r($dt);die(0);
                $chek = "select * from tsub_lookup where LOWER(nama_sub)='" . strtolower($dt->nama_sub) . "'";
                $qry = $db->query($chek);
                if ($qry->num_rows() < 1) {
                    $sql = "insert into tsub_lookup(id_sublookup2,lookup_id,nama_sub,fdelete,create_date,modified_date) values (";
                    $sql.="'" . (isset($dt->_id) ? $dt->_id->{'$id'} : '') . "',";
                    $sql.="'" . (isset($dt->lookup_id) ? $dt->lookup_id->{'$id'} : '') . "',";
                    $sql.="'" . $dt->nama_sub . "',";
                    $sql.="'" . $dt->fdelete . "',";
                    $sql.="'" . $dt->create_date . "',";
                    $sql.="'" . $dt->modified_date . "')";

//        print_r($sql);die(0);
                    $query = $db->query($sql);
//                    return 'ok'; 
                }
            }
        }
    }

    function insertlastupdate() {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
//echo json_encode($data);die(0);
        $db = $this->load->database('default', TRUE);

        $sql = "insert into tsync(last_update) values('";
        $sql.= $date . "');";
        $query = $db->query($sql);
    }

    function lastUpdate() {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
//echo json_encode($data);die(0);
        $db = $this->load->database('default', TRUE);
        $sql = "select last_update from tsync order by last_update desc limit 1";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $hsl = $row['last_update'];
        } else {
            $hsl = '';
        }
        return $hsl;
    }

    function deleteproduct($data) {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
//echo json_encode($data);die(0);
        $db = $this->load->database('default', TRUE);
        $sql = "delete from product where shop_id='" . $data['shop_id'] . "'";
        $query = $db->query($sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

}
