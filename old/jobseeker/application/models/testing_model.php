<?php

class testing_model extends CI_Model {

    private $mongo;
    private $db;

    function testing_model() {
        parent::__construct();
//        $this->load->library('session');
        $this->load->helper('date');
        $this->mongo = new Mongo();
        $this->db = $this->mongo->itc;
    }

    function listCollections() {
        $html = '';
        $collections = $this->db->listCollections();
        foreach ($collections as $collection) {
            $html .= "<a href='" . base_url() . "testing/seeInsideCollection/" . $collection->getName() . "'>" . $collection->getName() . "</a><br>";
        }
        return $html;
    }

    function seeInsideCollection($collectionName) {
        $html = '';
        $collection = $this->db->$collectionName;
        $data = $collection->find();
        foreach ($data as $d) {
            $html .= json_encode($d) . "<a href='" . base_url() . "testing/deleteRecord/" . $collectionName . "/" . $d['_id']->{'$id'} . "'>delete</a><br><br>";
        }
        $html .= '<a href="' . base_url() . 'testing/listCollections">Collections</a>';
        return $html;
    }

    public function deleteRecord($collectionName, $id) {
        $collection = $this->db->$collectionName;
        $condition = array('_id' => new MongoId($id));
        $collection->remove($condition, 1);
        redirect("testing/seeInsideCollection/$collectionName");
    }

    function getCollectionData($collectionName, $userid = 1, $page = 1) {
        $collection = $this->db->$collectionName;
        //'$ne' not equal
        $conditionuserid = array("userid" => array('$ne' => new MongoId($userid)));
        $record = $collection->find($conditionuserid)->skip(($page != 1 ? ($page * 8) : 0))->limit(8);
        return $record;
    }

    function getAllChannel() {
        $record = array();
        $collection = $this->db->channel;
        $record = $collection->find();
        return $record;
    }

    function getCollectionDataEcho($collectionName, $page = 1, $userid = '') {

        $content = array();
        $userids = array();
        $channelid = array();
        $catalogueid = array();
        $data = array();
        $numberofChannel = 0;

        $collection = $this->db->$collectionName;
        $recordArray = array();
        $paging = (($page - 1) * 8);
        //'$ne' not equal
        $conditionuserid = array("userid" => array('$ne' => new MongoId($userid)));
//        $record = $collection->find( $conditionuserid )->skip( (($page-1)*8) )->limit( 8 );
        $record = $this->getAllChannel();

//        foreach($record as $r){
//            array_push( $recordArray, $r );
//        }
//        
//        $data["user"] = $this->session->userdata('user');
        $data['channels'] = $record;
//        
//        foreach( $data['channels'] as $channel ){
//            ++$numberofChannel;
//        }
//        
//        foreach( $data['channels'] as $d ){
//            array_push( $userids,$d['userid']->{'$id'} );
//            array_push( $channelid,$d['_id']->{'$id'} );
//        }
//        
//        $data['numberofchannel'] = $numberofChannel;
//        $data['userdata'] = $this->getUserData( $userids );
//        $data['catalogue'] = $this->getUserCatalogue( $channelid );
//        $data['userid'] = $data["user"]["userid"];
//        
//        foreach( $data['catalogue'] as $catalogue ){
//            array_push( $catalogueid, $catalogue['_id']->{'$id'} );
//        }
//        
//        $data['product'] = $this->getCatalogueProduct($catalogueid);
//        
//        $content['header'] = $this->load->view('header',$data,TRUE);
//        $content['main'] = $this->load->view('channel_list_page',$data,TRUE);
//        
//        $this->load->view('template',$content);
        foreach ($data['channels'] as $channel) {
            ++$numberofChannel;
        }
        foreach ($data['channels'] as $d) {
            array_push($userid, $d['userid']->{'$id'});
            array_push($channelid, $d['_id']->{'$id'});
        }
        $data['numberofchannel'] = $numberofChannel;
        $data['catalogue'] = $this->getUserCatalogue($channelid);
        $data['userid'] = $data["user"]["userid"];
        foreach ($data['catalogue'] as $catalogue) {
            array_push($catalogueid, $catalogue['_id']->{'$id'});
        }

        //experimental
        for ($i = 0; $i <= $paging; $i++) {
            unset($catalogueid[$i]);
        }
        $data['product'] = $this->getCatalogueProduct($catalogueid);
        foreach ($data['product'] as $prod) {
            array_push($productid, $prod['_id']->{'$id'});
        }
        $data['channels'] = $this->getProductChannel($productid);
        $data['userdata'] = $this->getProductOwner($data['product']);
        $category = array();
        $getcategory = $this->boleci_model->getCategory();
        foreach ($getcategory as $categoryLopp) {
            array_push($category, $categoryLopp);
        }
        $data['category'] = $category;

        $content['header'] = $this->load->view('header', $data, TRUE);
        $content['main'] = $this->load->view('channel_list', $data, TRUE);
        $this->load->view('template', $content);
    }

    function getUserData($userids = array()) {
        $record = array();
        $collection = $this->db->user;

        foreach ($userids as $userid) {
            $condition = array("_id" => new MongoId($userid));
            $mongouserresult = $collection->findOne($condition);
            if (sizeof($mongouserresult) > 0)
                array_push($record, $mongouserresult);
        }

//        return $record;
        return $record;
    }

    function getUserCatalogue($channelids = array()) {
        $record = array();
        $collection = $this->db->catalog;

        foreach ($channelids as $channelid) {
            $condition = array('channelid' => new MongoId($channelid));
            $mongoresult = $collection->findone($condition);
            if (sizeof($mongoresult) > 0)
                array_push($record, $mongoresult);
        }

        return $record;
    }

    function getCatalogFromChannel($channelid) {
        $record = array();
        $collection = $this->db->catalog;
        $condition = array('channelid' => new MongoId($channelid));
        $mongoresult = $collection->findOne($condition);
        if (sizeof($mongoresult) > 0)
            array_push($record, $mongoresult);

        return $record;
    }

    /** getCatalogueProduct
     * 
     *  get one catalogue product
     */
    function getCatalogueProduct($catalogueIds = array()) {
        //$catalogueid= array();
        $record = array();
        $collection = $this->db->product;
        //echo json_encode($catalogueIds);die(0);
        foreach ($catalogueIds as $catalogueid) {

            $condition = array('catalogid' => new MongoId($catalogueid));

            $mongoresult = $collection->findone($condition);

            if (sizeof($mongoresult) > 0) {
                array_push($record, $mongoresult);
            }
        }
        // echo json_encode($catalogueid);die(0);
        //echo json_encode($record);die(0);
        return $record;
    }

    function getCataProduct($catalogueIds = array()) {
        //$catalogueid= array();
        $record = array();
        $collection = $this->db->product;
        //echo json_encode($catalogueIds);die(0);
//        foreach ($catalogueIds as $catalogueid) {

        $condition = array('catalogid' => array('$in' => new MongoId($catalogueIds)));

        $mongoresult = $collection->find($condition);

        if (sizeof($mongoresult) > 0) {
            array_push($record, $mongoresult);
        }
        echo json_encode($record);
        die(0);
//        }
        // echo json_encode($catalogueid);die(0);
        //echo json_encode($record);die(0);
        return $record;
    }

    /**
     * get several catalogue products
     * @var array $catalogueids
     */
    function getCatalogueProducts($catalogueids = array()) {
        $record = array();
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->product;
        //echo json_encode($catalogueids);die(0);
        foreach ($catalogueids as $catalogueid) {
            $condition = array('catalogid' => new MongoId($catalogueid));
            $mongoresult = $collection->find($condition);
            if (sizeof($mongoresult) > 0) {
                array_push($record, $mongoresult);
            }
        }

        // echo json_encode($record);die(0);
        return $record;
    }

    function getProductOwner($product) {
        $record = array();
        $channelIdArray = array();
        $userdata = array();
        $useridArray = array();
        $catalogCollection = $this->db->catalog;

        foreach ($product as $p) {
            $condition = array('_id' => $p['catalogid']);
            $record = $catalogCollection->find($condition);
            foreach ($record as $r) {
                array_push($channelIdArray, $r['channelid']);
            }
        }


        $channelCollection = $this->db->channel;
        foreach ($channelIdArray as $chanid) {
            $condition = array('_id' => $chanid);
            $record = $channelCollection->find($condition);
            foreach ($record as $r) {
                array_push($useridArray, $r['userid']);
            }
        }


        $userCollection = $this->db->user;
        foreach ($useridArray as $uid) {
            $condition = array('_id' => $uid);
            $record = $userCollection->find($condition);
            foreach ($record as $r) {
                array_push($userdata, $r);
            }
        }
        return $userdata;
    }

    function getProductChannel($productid) {
        $channelcollection = $this->db->channel;
        $cataloguecollection = $this->db->catalog;
        $productcollection = $this->db->product;
        $catalogueids = array();
        $channelids = array();
        $result = array();

        foreach ($productid as $id) {
            $condition = array("_id" => new MongoId($id));
            $mongoproductresult = $productcollection->findOne($condition);
            if (sizeof($mongoproductresult) > 0)
                array_push($catalogueids, $mongoproductresult['catalogid']->{'$id'});
        }
//        print_r($catalogueids);die();
        foreach ($catalogueids as $id) {
            $condition = array("_id" => new MongoId($id));
            $mongocatalogueresult = $cataloguecollection->findOne($condition);
            if (sizeof($mongocatalogueresult) > 0)
                array_push($channelids, $mongocatalogueresult['channelid']->{'$id'});
        }
//        print_r($channelids);die();
        foreach ($channelids as $id) {
            $condition = array("_id" => new MongoId($id));
            $mongochannelresult = $channelcollection->findOne($condition);
            if (sizeof($mongochannelresult) > 0)
                array_push($result, $mongochannelresult);
        }
        return $result;
    }

    function getCatalogueOwner($channelids) {
        $record = array();
        $userids = array();
        $userdata = array();
        $channelCollection = $this->db->channel;
        foreach ($channelids as $p) {
            $condition = array('_id' => new MongoId($p));
            $record = $channelCollection->find($condition);
            foreach ($record as $r) {
                array_push($userids, $r['userid']);
            }
        }
        $userCollection = $this->db->user;
        foreach ($userids as $id) {
            $condition = array('_id' => new MongoId($id));
            $record = $userCollection->find($condition);
            foreach ($record as $r) {
                array_push($userdata, $r);
            }
        }
        return $userdata;
    }

    function getRandomUserChannelCatalogueItem() {
        $record = array();
        $channelIdArray = array();
        $catalogIdArray = array();
        $catalogueIdArrayReverse = array();
        $product = array();
        $sizeofCollection = 0;
        $randomNumber = 0;

        $userCollection = $this->db->user;

        $channelCollection = $this->db->channel;
        $record = $channelCollection->find()->limit(50);
        foreach ($record as $r) {
            array_push($channelIdArray, $r['_id']);
        }


        $catalogCollection = $this->db->catalog;
        foreach ($channelIdArray as $ci) {
            $condition = array('channelid' => $ci);
            $record = $catalogCollection->find($condition)->limit(50);
            foreach ($record as $r) {
                array_push($catalogIdArray, $r['_id']);
            }
        }

        shuffle($catalogIdArray);
        $productCollection = $this->db->product;
        foreach ($catalogIdArray as $ci) {
            $condition = array('catalogid' => $ci, "hidestatus" => "0");
            $record = $productCollection->find($condition)->limit(5);
            foreach ($record as $r) {
                array_push($product, $r);
            }
        }

        return $product;
    }

    function getSearchResult($searchkey) {
        $data = array();

        $catalogueCollection = $this->db->catalog;
        $productCollection = $this->db->product;
        $channelCollection = $this->db->channel;
        $regex = new MongoRegex("/" . $searchkey . "/i");
//       $regex = "/".$searchkey."/";
//print_r($regex);die(0);
//echo json_encode($regex);die(0);
        $condition = array('catalogname' => $regex);
        $catalogueResult = $catalogueCollection->find($condition);
        $data['catalogue'] = $catalogueResult;

        $condition = array('$or' => array(array('productName' => $regex), array('descpro' => $regex)));
        $productResult = $productCollection->find($condition);
        $data['product'] = $productResult;

        $condition = array('$or' => array(array('channelname' => $regex), array('channeldesc' => $regex)));
        $channelResult = $channelCollection->find($condition);
        $data['channel'] = $channelResult;

        return $data;
    }

    function setBannerImage() {
//        print_r($_FILES);
        if (!empty($_FILES['file']['name'])) {
            $pathfile = pathinfo($_FILES['file']['name']);
            $config['upload_path'] = 'assets/banner/';
            $config['allowed_types'] = 'jpg|jpeg';
            $config['max_size'] = '0';
            $config['remove_space'] = TRUE;
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            // $_FILES['file']['name'] = "banner_$." . $pathfile['extension'];

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $nilai = array('upload_data' => $this->upload->data());
                $collection = $this->db->banner;
                $filepath = base_url() . $config['upload_path'] . $_FILES['file']['name'];
//                if( $collection->findOne() )
//                    $collection->update( array('name'=>'1'),array('name'=>'1','banner'=>$filepath) );
//                else
                $collection->insert(array('banner' => $filepath));

                print_r('Succeed');
            } else {
                print_r($this->upload->display_errors('', ''));
            }
        }
    }

//create by yohanes -- 2014-05-06 --
    function setcategory($data) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->category;
        //  echo json_encode($data);die(0);
        if ($collection->insert($data)) {
            //$newDocID = $data['_id'];

            echo "ok";
        } else {
            echo "Error occured. Please try again.";
        }
    }

    function setadmin($data) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->admin;
        if ($collection->insert($data)) {
            //$newDocID = $data['_id'];

            echo "ok";
        } else {
            echo "Error occured. Please try again.";
        }
    }

    function cekadminlogin($condition) {
        $m = new Mongo();
        $db = $m->db_boleci;
        $collection = $db->admin;
        $result = $collection->findOne($condition);
        return $result;
    }

    function getBanner() {
        $collection = $this->db->banner;
        return $collection->find();
    }

}

?>
