<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class boleci_model extends CI_Model {

    function boleci_model() {
        parent::__construct();
        $this->load->helper('date');
    }

    function getAllRecord2($coll) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $balikan = array();
        $collection = $db->$coll;
        $hasil = $collection->find();
        foreach ($hasil as $has) {
            array_push($balikan, $has);
        }
//        die(0); 
        //uncomment this for liat hasil
        return $balikan;
    }

    function getRecord($coll) {
        $m = new Mongo();
        $db = $m->db_boleci;
        //  $balikan = array();
        $collection = $db->$coll;
        $hasil = $collection->find();

//        die(0); 
        //uncomment this for liat hasil
        return $hasil;
    }

    function getAllRecord($coll) {
        $record = array();
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find();
        foreach ($hasil as $has) {
            array_push($record, $has);
        }
//        die(0); 
        //uncomment this for liat hasil
        return $record;
    }

    function wipeDatabase($coll) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->remove();
    }

    function deleteRecordWithCondition($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->remove($cond);
        return "ok";
    }

    function insertToDatabase($coll, $data) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->insert($data);
        if ($hasil) {
            return "ok";
        }
    }

    function editProfile($coll, $userId, $cond, $coll2, $dataUser, $dataContact) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $contactColl = $db->$coll2;
//        echo json_encode($dataUser);
//        $hasil=$collection->update($cond,$dataUser);
        $hasil = $collection->update($cond, $dataUser, false);

        for ($i = 0; $i < count($dataContact["contactType"]); $i++) {
            $condition = array("channelId" => $dataContact['channelId'], "contactType" => $dataContact['contactType'][$i]);
            $update = array("channelId" => $dataContact['channelId'], "contactType" => $dataContact['contactType'][$i], "contactnumber" => $dataContact['contactNumber'][$i]);
//            echo json_encode($condition);die(0);
            $hasilContact = $contactColl->update($condition, $update, true);
        }
        echo "ok";
    }

    function editProduct($coll, $dataProduct, $coll2) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $contactColl = $db->$coll2;
        $tempPhoto = $dataProduct['currentimage'];
        $conditionProduct = array("_id" => new MongoId($dataProduct['productid']));

        if ($dataProduct['producttype'] == "1") {
            $dataUpdateProduct = array("producttype" => $dataProduct['producttype'], "catalogid" => new MongoId($dataProduct['catalogid']),
                "productName" => $dataProduct['productName'], "descpro" => $dataProduct['descpro'], "price" => ""
                , "thumb" => $dataProduct['thumb'], "categoryid" => $dataProduct['categoryid'], "timestamp" => $dataProduct['timestamp'], 'hidestatus' => $dataProduct['hidestatus']);
        } else {
            $dataUpdateProduct = array("producttype" => $dataProduct['producttype'], "catalogid" => new MongoId($dataProduct['catalogid']),
                "productName" => $dataProduct['productName'], "descpro" => $dataProduct['descpro'], "price" => $dataProduct['price']
                , "thumb" => $dataProduct['thumb'], "categoryid" => new MongoId($dataProduct['categoryid']), "timestamp" => $dataProduct['timestamp'], 'hidestatus' => $dataProduct['hidestatus']);
        }

        $hasil = $collection->update($conditionProduct, $dataUpdateProduct, FALSE);

        if ($hasil) {
            foreach ($tempPhoto as $image) {
                $conditionImage = array();
//            $conditionImage=array("_id"=>new MongoId($image['imageid']));
                $conditionImage = array("additionalphoto" => $image);
                echo json_encode($conditionImage);
                $insert = array();
//            echo json_encode($conditionImage);die(0);
                $dataUpdateImage = array_merge($insert, array("productid" => new MongoId($dataProduct['productid']), "additionalphoto" => $image));
                $insertMongo = $contactColl->update($conditionImage, $dataUpdateImage, true);
            }
        }

        echo "ok";
    }

    function getRecordWithCondition($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find($cond);
        return $hasil;
    }

    function getRecordWithCondition2($coll, $cond1, $cond2) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find($cond1, $cond2);
        return $hasil;
    }

    function recorddistict($coll, $id, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find($cond);
        $hasil2 = $collection->distict($id, $cond);
        return $hasil2;
    }

    function getRecordWithConditionWithLimit($coll, $cond, $startpoint, $limit) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find($cond)->limit($limit)->skip($startpoint);
        return $hasil;
    }

    function countWithCondition($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find($cond);
        return $hasil->count(true);
    }

    function getTestimony($startpoint, $limit, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->reputation;
        $hasil = $collection->find($cond)->limit($limit)->skip($startpoint);
        return $hasil;
    }

    function getOneRecordWithConditionAndsorttime($coll, $cond, $sort) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $hasil = $collection->find($cond)->sort($sort);
        return $hasil;
    }

    function getCatalogList($cond, $coll, $coll2, $coll3, $status) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $hasil = array();
        $tampungCat = array();
        $collectionCatalog = $db->$coll;
        $collectionProduct = $db->$coll2;
        $collectionAddImage = $db->$coll3;

        $catalog = $collectionCatalog->find($cond);
        foreach ($catalog as $eachCat) {
//            array_push($tampungCat, $eachCat);
//            echo json_encode($eachCat);
            $tampungImage = array();

            $tampungProd = array();
            if ($status == "other") {
                $catalogId = array("catalogid" => new MongoId($eachCat['_id']->{'$id'}), "hidestatus" => "0");
                $product = $collectionProduct->find($catalogId);
            } else {
                $catalogId = array("catalogid" => new MongoId($eachCat['_id']->{'$id'}));
                $product = $collectionProduct->find($catalogId);
            }

            foreach ($product as $eachProduct) {

//                 array_push($tampungProd, $eachProduct);

                $productId = array("productid" => new MongoId($eachProduct['_id']->{'$id'}));
                $addImage = $collectionAddImage->find($productId);
                foreach ($addImage as $eachImage) {
                    array_push($tampungImage, $eachImage);
//                   $hasil=  array_merge(array("catalog"=>$tampungCat,"product"=>$tampungProd,"image"=>$tampungImage));
                }
                $merge = array_merge($eachProduct, array("additionalImage" => $tampungImage));
                array_push($tampungProd, $merge);
            }
            $mergeCat = array_merge($eachCat, array("product" => $tampungProd));
            array_push($hasil, $mergeCat);
        }
//die(0);
//        echo json_encode($hasil);die(0);
        return $hasil;
    }

    function getCatalogList2($cond, $coll, $coll2, $coll3, $status) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $hasil = array();
        $tampungCat = array();
        $collectionCatalog = $db->$coll;
        $collectionProduct = $db->$coll2;
        $collectionAddImage = $db->$coll3;

        $catalog = $collectionCatalog->find($cond);
        foreach ($catalog as $eachCat) {
            $eachCata = array(
                'catalogid' => $eachCat['_id']->{'$id'},
                'catalogname' => $eachCat['catalogname']
            );

//            array_push($tampungCat, $eachCat);
//            echo json_encode($eachCat);
            $tampungImage = array();

            $tampungProd = array();
            if ($status == "other") {
                $catalogId = array("catalogid" => new MongoId($eachCat['_id']->{'$id'}), "hidestatus" => "0");
                $product = $collectionProduct->find($catalogId);
            } else {
                $catalogId = array("catalogid" => new MongoId($eachCat['_id']->{'$id'}));
                $product = $collectionProduct->find($catalogId);
            }

            foreach ($product as $eachProduct) {
                $eachProd = array(
                    'productid' => $eachProduct['_id']->{'$id'},
                    'producttype' => $eachProduct['producttype'],
                    'productname' => $eachProduct['productName'],
                    'productdesc' => $eachProduct['descpro'],
                    'category' => $eachProduct['categoryid'],
                    'price' => $eachProduct['price'],
                    'mainimage' => base_url() . $eachProduct['thumb'],
                    'uploaddate' => $eachProduct['timestamp'],
                    'hidestatus' => $eachProduct['hidestatus']
                );

                $productId = array("productid" => new MongoId($eachProduct['_id']->{'$id'}));
                $addImage = $collectionAddImage->find($productId);
                foreach ($addImage as $eachImage) {
                    $eachAdd = array(
                        'imageid' => $eachImage['_id']->{'$id'},
                        'url' => base_url() . $eachImage['additionalphoto']
                    );
                    array_push($tampungImage, $eachAdd);
//                   $hasil=  array_merge(array("catalog"=>$tampungCat,"product"=>$tampungProd,"image"=>$tampungImage));
                }
                $merge = array_merge($eachProd, array("additionalimage" => $tampungImage));
                array_push($tampungProd, $merge);
            }
            $mergeCat = array_merge($eachCata, array("product" => $tampungProd));
            array_push($hasil, $mergeCat);
        }
//die(0);
//        echo json_encode($hasil);die(0);
        return $hasil;
    }

    function getSingleRecord($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;

        $result = $collection->findOne($cond);
        return $result;
    }

    function insertCatalog($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        if ($collection->insert($cond)) {
            $newDocID = $cond['_id'];
            return $newDocID;
        } else {
            echo "Error occured. Please try again.";
        }
    }
   

    function insertProductDetail($coll, $data, $additionalPhoto) {

        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
//        echo json_encode($data);die(0);
        $update = $collection->insert($data);
        if ($update) {
            $newDocID = $data['_id'];
            if ((count($additionalPhoto) == 0) || (!$additionalPhoto))
                return "ok";
            else {
                $this->insertImageDetail("additionalImage", $newDocID, $additionalPhoto);
                return "ok";
            }
        } else {
            echo "Error occured. Please try again.";
        }
    }

    function insertProductDetail2($coll, $data, $additionalPhoto) {

        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
//        echo json_encode($data);die(0);
        $update = $collection->insert($data);
        if ($update) {
            $newDocID = $data['_id'];
            if ((count($additionalPhoto) == 0) || (!$additionalPhoto))
                return $newDocID->{'$id'};
            else {
                $this->insertImageDetail("additionalImage", $newDocID, $additionalPhoto);
                return $newDocID->{'$id'};
            }
        } else {
            echo "error";
        }
    }

    function insertImageDetail($coll, $cond, $additionalPhoto) {

        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
//        echo json_encode($cond);die(0);
        foreach ($additionalPhoto as $image) {
            $insert = array();
            $helper = array_merge($insert, array("productid" => $cond, "additionalphoto" => $image));
//        echo json_encode($helper);
//        echo "  ";
            $insertMongo = $collection->insert($helper);
        }
//        die(0);
        if ($insertMongo) {
            return "ok";
        } else {
            echo "Error occured. Please try again.";
        }
    }

    function insertUser($data) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->user;
        $res = $collection->insert($data);
        if ($collection->insert($data)) {
            $newDocID = $data['_id'];
            return $newDocID;
        } else {
            echo "Error occured. Please try again.";
        }
    }

    function insertContact($data) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->like;
        if ($collection->insert($data)) {
            echo "ok";
        } else {
            echo "Error occured. Please try again.";
        }
    }

    //lain kali ngecheck pake fungsi ini aja
    //
    function cekdatabase($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        $result = $collection->findOne($cond);
        return $result;
    }

    //3 ini bsa dioptimasi jadi 1, ntar aja yak
    function cekUser($condition) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->user;
        $result = $collection->findOne($condition);
        return $result;
    }

    function cekFollow($condition) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->follow;
        $result = $collection->findOne($condition);
        return $result;
    }

    function cekLike($condition) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->like;
        $result = $collection->findOne($condition);
        return $result;
    }

    function cekEmailAvailability($condition) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->user;
        $result = $collection->findOne($condition);
        return $result;
    }

    function getAlbum($condition) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->album;
        $hasil = $collection->find($condition);
        return $hasil;
    }

    function getcategory() {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->category;
        $hasil = $collection->find();
        return $hasil;
    }

    function getcontacttype() {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->contacttype;
        $hasil = $collection->find();
        return $hasil;
    }

    function gethotitem() {

        $balikan = array();
        $condition = array();
        $hasilarray = array();
//        $condition['timestamp']= array('$gt'=>strtotime("-1 day"."00:00:00"),'$lt'=>strtotime("-1 day"."23:59:59"));
        $condition['timestamp'] = array('$gt' => strtotime("-1 day" . "00:00:00"), '$lt' => strtotime("-1 day" . "23:59:59"));

        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->like;

        //susun Array
        $keys = array('productid' => 1);
        $initial = array("count" => 0);
        $reduce = 'function(obj, prev) {
        if (obj.productid != null) if (obj.productid instanceof Array) prev.count += obj.productid.length;
        else prev.count++;}';
        //Eksekusi MongoQuery
        $hasil = $collection->group($keys, $initial, $reduce);
//        echo json_encode($hasil);die(0);
        return $hasil['retval'];
    }

    function insertandreturnid($coll, $cond) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;
        if ($collection->insert($cond)) {
            $newDocID = $cond['_id'];
            return $newDocID;
        } else {
            echo "Error occured. Please try again.";
        }
    }

    function updateonly($coll, $cond, $dataupdate) {
        //hanya diupdate bila record ada
        //kalo mau dia ngnambah jika kondisi ga terpenuhi cukup ganti falsenya jadi true
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->$coll;

        $hasil = $collection->update($cond, $dataupdate, false);
        if ($hasil)
            return "ok";
    }

}

