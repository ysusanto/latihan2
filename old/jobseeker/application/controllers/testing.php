<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class testing extends CI_Controller {

//    private $mongo;
//    private $db;

    function testing() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('url', 'file'));
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('testing_model');
        $this->load->model('boleci_model');

//        $this->mongo = new Mongo();
//        $this->db = $this->mongo->db_boleci;
    }

    public function index() {
        $this->load->view('test/home');
    }

    function channel2($channelid) {
        $data['user'] = $this->session->userdata('user');
        print_r($data['user']);
        die(0);
    }

    function listCollections() {
        echo $this->testing_model->listCollections();
//        $collections = $this->db->listCollections();
//        foreach($collections as $collection){
//            print_r("<a href='".base_url()."testing/seeInsideCollection/".$collection->getName()."'>".$collection->getName()."</a><br>");
//        }
    }

    function seeInsideCollection($collectionName) {
        echo $this->testing_model->seeInsideCollection($collectionName);
//        $collection = $this->db->$collectionName;
//        $data = $collection->find();
//        foreach($data as $d){
//            print_r(json_encode($d)."<a href='".base_url()."testing/deleteRecord/".$collectionName."/".$d['_id']->{'$id'}."'>delete</a><br><br>");
//        }
//        print_r('<a href="'.base_url().'testing/listCollections">Collections</a>');
    }

    public function deleteRecord($collectionName, $id) {
        $this->testing_model->deleteRecord($collectionName, $id);
//        $collection = $this->db->$collectionName;
//        $condition = array( '_id' => new MongoId( $id ) );
//        $collection->remove($condition,1);
//        redirect( "testing/seeInsideCollection/$collectionName" );
    }

    function getCollectionData($collectionName, $userid = 1, $page = 1) {
        return $this->testing_model->getCollectionData($collectionName, $userid, $page);
//        $collection = $this->db->$collectionName;
//        //'$ne' not equal
//        $conditionuserid = array( "userid" => array( '$ne' => new MongoId($userid) ) );
//        $record = $collection->find( $conditionuserid )->skip( ($page!=1?($page*8):0) )->limit( 8 );
//        return $record;
    }

    function getCollectionDataEcho($collectionName, $page = 1, $userid = '') {

        $this->testing_model->getCollectionDataEcho($collectionName, $page, $userid);
//        $content = array();
//        $userids = array();
//        $channelid = array();
//        $catalogueid = array();
//        $data = array();
//        $numberofChannel = 0;
//        
//        $collection = $this->db->$collectionName;
//        $recordArray = array();
//        //'$ne' not equal
//        $conditionuserid = array( "userid" => array( '$ne' => new MongoId($userid) ) );
//        $record = $collection->find( $conditionuserid )->skip( (($page-1)*8) )->limit( 8 );
//        
//        foreach($record as $r){
//            array_push( $recordArray, $r );
//        }
//        
////        print_r( $recordArray );
//        
//        $data["user"] = $this->session->userdata('user');
//        $data['channels'] = $record;
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
    }

    function getUserData($userids = array()) {
        return $this->testing_model->getUserData($userids);
//        $record = array();
//        $collection = $this->db->user;
//        
//        foreach( $userids as $userid ){
//            $condition = array( "_id" => new MongoId($userid) );
//            array_push($record, $collection->findOne($condition));
//        }
//        
//        return $record;
    }

    function getUserCatalogue($channelids = array()) {
        return $this->testing_model->getUserCatalogue($channelids);
//        $record = array();
//        $collection = $this->db->catalog;
//        
//        foreach($channelids as $channelid){
//            $condition = array( 'channelid' => new MongoId( $channelid ) );
//            array_push( $record, $collection->findOne($condition) );
//        }
//        
//        return array_filter($record);
    }

    /**
     * get one product from each catalogue
     * 
     */
    function getCatalogueProduct($catalogueIds = array()) {
        return $this->testing_model->getCatalogueProduct($catalogueIds);
//        $record = array();
//        $collection = $this->db->product;
//        
//        foreach( $catalogueIds as $catalogueid ){
//            $condition = array( 'catalogid' => new MongoId($catalogueid) );
//            array_push( $record, $collection->findOne($condition) );
//        }
//        
//        return $record;
    }

    /**
     * get several catalogue products
     * @var array $catalogueids
     */
    function getCatalogueProducts($catalogueids) {
        return $this->testing_model->getCatalogueProducts($catalogueids);
    }

    function getRandomUserChannelCatalogueItem($condition) {
        return $this->testing_model->getRandomUserChannelCatalogueItem($conditon);
    }

    function getProductOwner($product) {
        return $this->testing_model->getProductOwner($product);
    }

    function getProductChannel($productid) {
        return $this->testing_model->getProductChannel($productid);
    }

    function getCatalogueOwner($channelids) {
        return $this->testing_model->getCatalogueOwner($channelids);
    }

    function getSearchResult() {
        $searchresult = array();
        $html = '';
//        $viewStyle = 'float:right;padding-right:3px;margin-top:-10px;';
        $notfoundstyle = 'style="margin-bottom:40px;"';
        $dheight = 227;
        $dwidth = 224;
        $sheight = $dheight;
        $swidth = $dwidth;
        $searchkey = $this->input->post('skey');

        $data["user"] = $this->session->userdata('user');
        $search = $this->testing_model->getSearchResult($searchkey);


        //product
        $count = 0;
        foreach ($search['product'] as $se) {
            array_push($searchresult, $se);
        }
        $userdata = $this->getProductOwner($searchresult);

//        echo json_encode($userdata);
//        echo json_encode($searchresult);die(0);
        $product = $searchresult;
        $count = 0;
        foreach ($userdata as $ud) {
            $product[$count]['userproduct'] = $ud;

            $count++;
        }
        // echo json_encode($product);die(0);
        $html .= '<div class="divcontentclass" ><div class="inputstyle" style="font-size:14px;font-family:Gothic;">Search Result(s) for  " ' . $searchkey . ' " </div></div>';
        $data ['searchkey'] = $html;



        $html = '';
        $html .= '<div class="divcontentclass" style="margin-bottom:30px;"><div class="inputstyle" style="font-size:16px;font-family:Gothic;">Items</div>
                    <div style="border:1px solid black;margin-bottom:17px;"></div>
                    <div id="divcontentproduct" ' . ( sizeof($product) <= 0 ? $notfoundstyle : '' ) . '>';
        foreach ($product as $c) {
            $image = base_url() . $c['thumb'];
            // $c['userproduct'] = $userdata;
            if ($c['thumb'] != '') {
                $size = getimagesize($image);
                $sheight = $size[1];
                $swidth = $size[0];
            }
            if ($swidth > $sheight) {
                $margin = (50 - ($sheight * (50 / $swidth))) * 2;
                $style = 'width:' . $dwidth . 'px;height:auto;margin-top:' . ($margin + 1) . 'px;margin-bottom:26px;';
            } else if ($swidth < $sheight) {
                $margin = (50 - ($swidth * (50 / $sheight))) * 2;
                $style = 'width:auto;height:' . $dheight . 'px;margin-left:' . ($margin + 2) . 'px';
            } else {
                $style = 'width:' . $dwidth . 'px;height:' . $dheight . 'px;padding-left:1px;';
            }
            if (isset($c['userproduct'])) {
                $html .= '<a href="' . base_url() . 'detailproduct/' . $c['userproduct']['_id'] . '/' . $c['_id'] . '" class="productlink"><div class="itemcontainer itemcontainerproduct"><div class="divstylemargin">
                        <!--<div>-->
                            <img class="imageclass" style="' . $style . '" src="' . $image . '" />';
                if (!isset($c['producttype']) || $c['producttype'] == '0') {
                    $html .= '         <div class="pricediv" >
                                  <img src="' . base_url() . 'assets/money2.png" style="height:16px;float:left;" /><p class="price" title="' . number_format((integer) $c['price'], 0, ',', '.') . '">Rp ' . number_format((integer) $c['price'], 0, ',', '.') . '</p>
                               </div>';
                }
                $html .= '  <!--</div>-->
                        <div class="absoluteposition">
                            <p class="itemparagraph2" style="width:217px;" title="' . ($c['productName'] != '' ? $c['productName'] : 'No Description') . '">' . ($c['productName'] != '' ? ( strlen($c['productName']) >= 30 ? substr($c['productName'], 0, 26) . '....' : $c['productName'] ) : 'No Description') . '</p>                            
                            <img class="viewstyle" style="float:none;" src="' . base_url() . 'assets/view_item.png"/>
                        </div>';
                $html .='
                    </div></div></a>';
            }
            ++$count;
            // echo json_encode($c);die(0);
        }

        if (sizeof($product) <= 0) {
            $html .= '<div style="margin-bottom:20px;">No result found</div>';
        }
        $html .= '</div>
                </div>';
        $data['product'] = $html;


        //channel
        $html = '';
        $searchresult = array();
        $userids = array();
        $channelid = array();
        $catalogid = array();
        $channelprod = array();
        $productid = array();
        $count = 0;
        foreach ($search['channel'] as $se) {
            array_push($userids, $se['userid']->{'$id'});
            array_push($searchresult, $se);
            array_push($channelid, $se['_id']->{'$id'});
        }

        $catachannel = $this->getUserCatalogue($channelid);
//
//
        foreach ($catachannel as $catalogue) {
            array_push($catalogid, $catalogue['_id']->{'$id'});
        }
// 
        $products = $this->getCatalogueProduct($catalogid);
//
        if ($products != null) {
            foreach ($products as $prod) {
                array_push($productid, $prod['_id']->{'$id'});
                array_push($channelprod, $prod);
            }
        }
//
//
        $searchresult = $this->getProductChannel($productid);
//
//
//
        $i = 0;
        foreach ($searchresult as $channeldata) {

            $condichnekchannelcover = array("userid" => $channeldata['userid']->{'$id'});
//            array_push( $data['channels'],$channeldata);
            $chekchannelcover = $this->boleci_model->getSingleRecord("coverchannel", $condichnekchannelcover);
            $searchresult[$i]['coverchannels'] = $chekchannelcover;


            $i++;
        }
        $i = 0;
        foreach ($channelprod as $cp) {
            $searchresult[$i]['sample'] = $cp;

            $i++;
        }

        $userdatas = $this->getUserData($userids);
        $channel = $searchresult;
        //  echo json_encode($channel);die(0);
        $html .= '<div class="divcontentclass"><div class="inputstyle" style="font-size:16px;font-family:Gothic;">Channels</div>
                    <div style="border:1px solid black;margin-bottom:17px;"></div>
                    <div id="divcontentchannel" ' . ( sizeof($channel) <= 0 ? $notfoundstyle : '' ) . '>';
        foreach ($channel as $c) {
            if ($c['coverchannels'] != null) {
                $image = base_url() . $c['coverchannels']['pathcover'];
//            } else if (isset($userdata[$count]['image']) && $userdata[$count]['image'] != '') {
//                $image = base_url() . $userdata[$count]['image'];
            } else {
                $image = base_url() . $c['sample']['thumb'];
            }

            if ($image != '') {
                $size = getimagesize($image);
                $sheight = $size[1];
                $swidth = $size[0];
            }
            if ($swidth > $sheight) {
                $margin = (50 - ($sheight * (50 / $swidth))) * 2;
                $style = 'width:' . $dwidth . 'px;height:auto;margin-top:' . ($margin + 1) . 'px;margin-bottom:26px;';
            } else if ($swidth < $sheight) {
                $margin = (50 - ($swidth * (50 / $sheight))) * 2;
                $style = 'width:auto;height:' . $dheight . 'px;margin-left:' . ($margin + 2) . 'px';
            } else {
                $style = 'width:' . $dwidth . 'px;height:' . $dheight . 'px;padding-left:8px;';
            }

            $html .= '<a href="' . base_url() . 'channel/' . $c['userid']->{'$id'} . '" class="productlink"><div class="itemcontainer itemcontainerchannel"><div class="divstylemargin">
                        <img class="imageclass" style="' . $style . '" src="' . $image . '" />
                        <div class="absoluteposition">
                            <p class="itemparagraph2" style="width:217px;" title="' . ($c['channelname'] != '' ? $c['channelname'] : 'No Description') . '">' . ($c['channelname'] != '' ? ( strlen($c['channelname']) >= 30 ? substr($c['channelname'], 0, 26) . '....' : $c['channelname'] ) : 'No Description') . '</p>
                            <img class="viewstyle" style="float:none;" src="' . base_url() . 'assets/view_channel.png"/>
                        </div>
                    </div></div></a>';
            ++$count;
        }
        if (sizeof($channel) <= 0) {
            $html .= '<div style="margin-bottom:20px;">No result found</div>';
        }
        $html .= '</div>
                </div>';
        $data['channel'] = $html;


        //catalogue
        $html = '';
        $searchresult = array();
        $count = 0;
        $catalogueids = array();
        $channelids = array();
        foreach ($search['catalogue'] as $se) {
            array_push($catalogueids, $se['_id']->{'$id'});
            array_push($channelids, $se['channelid']->{'$id'});
            array_push($searchresult, $se);
        }
        $userdatass = $this->getCatalogueOwner($channelids);
        $products = $this->getCatalogueProducts($catalogueids);
        $catalogue = $searchresult;
        $html .= '<div class="divcontentclass" style="padding-left:17px;padding-right:17px;"><div class="inputstyle" style="font-size:16px;font-family:Gothic;">Catalogs</div>
                    <div style="border:1px solid black;margin-bottom:17px;"></div>
                    <div id="divcontentcatalogue" ' . ( sizeof($catalogue) <= 0 ? $notfoundstyle : '' ) . '>';
        foreach ($catalogue as $c) {

//            if (!$prod)
//            {
//                $cataPrint .="<a href=".base_url().'addproduct/'.$cata['_id'].">";
//                $cataPrint .='<img src="'.base_url().'assets/add_item.png" alt="Submit" sytle="cursor: pointer;" /></a>';
//            }
//            foreach ($prod as $prodeach){
//                //cetak gambar
//                $cataPrint .='<div class="singleitem">';
//                $cataPrint .="<a href=".base_url().'detailproduct/'.$channelid.'/'.$prodeach['_id'].">";
//                $cataPrint .='<img width=70px height=70px src="'.base_url().$prodeach['thumb'].'" alt="Submit" sytle="cursor: pointer;" /></a></div>';
//                if ($i == count ($prod)-1) {
//                    if ($status=='own'){
//                        $cataPrint .="<a href=".base_url().'addproduct/'.$cata['_id'].">";
//                        $cataPrint .='<img src="'.base_url().'assets/add_item.png" alt="Submit" sytle="cursor: pointer;" /></a>';
//                    }
//                }
//                $i++;
//
//            }
//            $cataPrint .="</div>";
//            $cataPrint .= '<div class="singlealbumtitle">'.$cata['catalogname'].'</div>';
//            $cataPrint .="<a href=".base_url().'catalogdetail/'.$channelid.'/'.$cata['_id'].">";
//            $cataPrint .= '<div class="singlealbumviewmore"><img src="'.base_url().'assets/view_catalog.png" /></div></div>';

            $html .= '<div class="itemcontainer itemcontainercatalogue"><div class="divstylemargin" style="width:230px;">';
            $html .= '<div class="peekitem">';
            foreach ($products[$count] as $p) {

                $html .= '<div class="singleitem"><a href="' . base_url() . 'detailproduct/' . $userdata[$count]['_id']->{'$id'} . '/' . $p['_id']->{'$id'} . '"><img width=70px height=70px src="' . $p['thumb'] . '" alt="Submit" sytle="cursor: pointer;" /></a></div>';
            }
            $html .= '</div>';
            $html .= '<div class="absoluteposition">
                        <p class="itemparagraph2" style="width:217px;" title="' . ($c['catalogname'] != '' ? $c['catalogname'] : 'No Description') . '">' . ($c['catalogname'] != '' ? ( strlen($c['catalogname']) >= 30 ? substr($c['catalogname'], 0, 26) . '....' : $c['catalogname'] ) : 'No Description') . '</p>';
            if (!empty($userdatass[$count]['_id'])) {
                $html .= '<a href="' . base_url() . 'catalogdetail/' . $userdatass[$count]['_id']->{'$id'} . '/' . $c['_id']->{'$id'} . '" class="viewstyle" style="float:none;"><img src="' . base_url() . 'assets/view_catalog.png"/></a>';
            }
            $html .= ' </div>
                    </div></div>';
            if ($count >= 9) {
                break;
            } else {
                $count++;
            }
        }
        if (sizeof($catalogue) <= 0) {
            $html .= '<div style="margin-bottom:20px;">No result found</div>';
        }
        $html .= '</div>
                </div>';
        $data['catalogue'] = $html;
//echo json_encode( $data['catalogue']);die(0);
        $category = array();
        $getcategory = $this->boleci_model->getCategory();
        foreach ($getcategory as $categoryLopp) {
            array_push($category, $categoryLopp);
        }
        $data['category'] = $category;

        $content['header'] = $this->load->view('header', $data, TRUE);
        $content['main'] = $this->load->view('search_result', $data, TRUE);
        $content['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('template', $content);
    }

    function ngecek() {
        echo "AKSOAKOSAKS";
    }

    function channel_list() {
        $content = array();
        $userid = array();
        $channelid = array();
        $catalogueid = array();
        $productid = array();
        $channelbaru = array();
        $channelprod = array();

        $data = array();
        $numberofChannel = 0;

        $data["user"] = $this->session->userdata('user');
        $user = $this->boleci_model->getRecordWithCondition("user", array('status' => '1'));
        foreach ($user as $u) {
            $data['channels'] = $this->boleci_model->getRecordWithCondition("channel", array("userid" => $u['_id']));
            foreach ($data['channels'] as $d) {
                array_push($userid, $d['userid']->{'$id'});

                if (isset($data['user']['channelid'])) {
                    if ($d['_id']->{'$id'} != $data['user']['channelid']) {
                        array_push($channelid, $d['_id']->{'$id'});
                    }
                } else {
                    array_push($channelid, $d['_id']->{'$id'});
                }
                ++$numberofChannel;
            }
        }
//        $data['channels'] = $this->boleci_model->getRecordWithCondition("channel");
        // echo json_encode($data['channels']);die(0);
        //$data['channelid']= $channe
//     
//        foreach ($data['channels'] as $d) {
//            array_push($userid, $d['userid']->{'$id'});
//
//            if (isset($data['user']['channelid'])) {
//                if ($d['_id']->{'$id'} != $data['user']['channelid']) {
//                    array_push($channelid, $d['_id']->{'$id'});
//                }
//            } else {
//                array_push($channelid, $d['_id']->{'$id'});
//            }
//            ++$numberofChannel;
//        }

        $data['catalogue'] = $this->getUserCatalogue($channelid);

        $products = array();
        foreach ($data['catalogue'] as $catalogue) {
//          
            array_push($catalogueid, $catalogue['_id']->{'$id'});
        }
//      
        $data['userid'] = $data["user"]["userid"];
//    
        $data['product'] = $this->getCatalogueProduct($catalogueid);

        if ($data['product'] != null) {
            foreach ($data['product'] as $prod) {
                array_push($productid, $prod['_id']->{'$id'});
                array_push($channelprod, $prod);
            }
        }
        $i = 0;
        $data['numberofchannel'] = $numberofChannel;
        $coverchannel = array();
        $data['channels'] = $this->getProductChannel($productid);

        foreach ($data['channels'] as $channeldata) {

            $condichnekchannelcover = array("userid" => $channeldata['userid']->{'$id'});
//            array_push( $data['channels'],$channeldata);
            $chekchannelcover = $this->boleci_model->getSingleRecord("coverchannel", $condichnekchannelcover);
            $data['channels'][$i]['coverchannels'] = $chekchannelcover;


            $i++;
        }
        $i = 0;
        foreach ($channelprod as $cp) {

//            $condichnekchannelcover = array("userid" => $cp['userid']);
//            $chekchannelcover = $this->boleci_model->getSingleRecord("coverchannel", $condichnekchannelcover);
//            if(isset($chekchannelcover['pathcover'])){
//                $data['channels'][$i]['coverchannel']=$chekchannelcover['pathcover'];
//            }else{
//            $data['channels'][$i]['coverchannel'] = '';
//            }
            $data['channels'][$i]['sample'] = $cp;

            $i++;
        }
//        foreach ($data['channels'] as $channeldata) {
////            
//            $condichnekchannelcover = array("userid" => $channeldata['userid']->{'$id'});
////            array_push( $data['channels'],$channeldata);
//            $chekchannelcover = $this->boleci_model->getSingleRecord("coverchannel", $condichnekchannelcover);
//           if($channeldata['userid']->{'$id'} == $chekchannelcover['userid']){
//               unset($channeldata['sample']);
//           }
//          
//            if (sizeof($chekchannelcover) > 0){
//            $channeldata['pathcoverchannel']=$chekchannelcover['pathcover'];
//             
//             
//             
//            }
//            array_push($data['channels'],$channeldata);  
////         array_push($data['channels'],$channeldata);
////            
//        }
//      echo json_encode(  $data['channels'] );die(0);
        //   echo json_encode(  $data );die(0);
        $data['userdata'] = $this->getProductOwner($data['product']);
        //  echo json_encode( $data['userdata'] );die(0);
        $category = array();
        $getcategory = $this->boleci_model->getCategory();
        foreach ($getcategory as $categoryLopp) {
            array_push($category, $categoryLopp);
        }
        $data['category'] = $category;
//   echo json_encode(  $data );die(0);
        $content['header'] = $this->load->view('header', $data, TRUE);
        $content['main'] = $this->load->view('channel_list', $data, TRUE);
        $content['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('template', $content);
    }

    function view_home() {
        //random 16 biji

        $content = array();
        $userid = array();
        $channelid = array();
        $catalogueid = array();
        $data = array();
        $numberofChannel = 0;

        $data["user"] = $this->session->userdata('user');
        $data['channels'] = $this->getCollectionData('channel', $data["user"]["userid"]);

        foreach ($data['channels'] as $channel) {
            ++$numberofChannel;
        }
        $usercondition = array("status" => "1");
        $data['product'] = $this->getRandomUserChannelCatalogueItem($usercondition);
        $data['userdata'] = $this->getProductOwner($data['product']);
        echo json_encode($data['userdata']);
        die(0);
        foreach ($data['channels'] as $d) {
            if ($d['userid']->{'$id'} == $data['userdata']['_id'] && $data['userdata']['status'] == "1") {
                array_push($userid, $d['userid']->{'$id'});
                array_push($channelid, $d['_id']->{'$id'});
            }
        }

        $data['numberofchannel'] = $numberofChannel;
//        $data['userdata'] = $this->getUserData( $userid );
        $data['catalogue'] = $this->getUserCatalogue($channelid);
        $data['userid'] = $data["user"]["userid"];

        foreach ($data['catalogue'] as $catalogue) {
            array_push($catalogueid, $catalogue['_id']->{'$id'});
        }



        $category = array();
        $getcategory = $this->boleci_model->getCategory();
        foreach ($getcategory as $categoryLopp) {
            array_push($category, $categoryLopp);
        }
        $data['category'] = $category;
        $data['banner'] = $this->getBanner();
        $content['header'] = $this->load->view('header', $data, TRUE);
        $content['main'] = $this->load->view('home_view', $data, TRUE);
        $content['footer'] = $this->load->view('footer', $data, TRUE);
        $this->load->view('template', $content);
    }

    function setbanner() {
        $content = array();
        $bannerid = array();
        $data["admin"] = $this->session->userdata('admin');
        //  $data["admin"] = $this->session->userdata('admin');
        $data['banner'] = $this->boleci_model->getAllRecord('banner');

        foreach ($data['banner'] as $b) {
            array_push($bannerid, $b['_id']->{'$id'});
            $data['bannerid'] = $bannerid;
        }
        //  
        // $data['bannerid'] = $bannerid;
        //   echo json_encode($data);die(0);
        $content['header'] = $this->load->view('admin/header2', $data, TRUE);
        $content['main'] = $this->load->view('setbanner', $data, TRUE);
        $this->load->view('admin/template2', $content);

        // $content['main']= $this->load->view('setbanner', $data);
    }

    function deletebanner($bannerid) {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        //  $condi = array('_id' => new MongoId($data['bannerid']));
        $delete = $this->deleteRecord('banner', $data['bannerid']);
//                if($delete){
//                    echo "ok";
//                }
    }

    function deletecategory($categoryid) {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        echo json_encode($data['categoryid']);
        die(0);
        //  $condi = array('_id' => new MongoId($data['bannerid']));
        $delete = $this->deleteRecord('category', $data['categoryid']);
//                if($delete){
//                    echo "ok";
//                }
    }

    function setBannerImage() {
        $this->testing_model->setBannerImage();
    }

    function getAllChannel() {
        return $this->testing_model->getAllChannel();
    }

    function getCatalogList($data, $status) {

        //$channelId = array("channelid" => new MongoId($data['_id']->{'$id'}));
        //get catalog yang dia punya
        $catalogList = $this->boleci_model->getCatalogList($channelId, "catalog", "product", "additionalImage", $status);

        //   $getcatalogid = $this->boleci_model->getSingleRecord("catalog", $channelid);
//        $catalogid= array("catalogid" => $getcatalogid['_id']);
//        $getstatus=$this->boleci_model->getSingleRecord("product", $catalogid);
//        $hidestatus=array("hidestatus" => $getstatus['hidestatus']);
//        array_merge($cataloglist,$h
//        idestatus);
        //echo json_encode($catalogList);die(0);
        return $catalogList;
    }

    function setcategory() {
        $content = array();
        $bannerid = array();
        $data["admin"] = $this->session->userdata('admin');
        //  $data["admin"] = $this->session->userdata('admin');
        $data['category'] = $this->boleci_model->getAllRecord('category');

        foreach ($data['category'] as $b) {
            array_push($bannerid, $b['_id']->{'$id'});
            // $data['categoryid'] = $bannerid;
        }
        //  
        // $data['bannerid'] = $bannerid;
        //   echo json_encode($data);die(0);
        $content['header'] = $this->load->view('admin/header2', $data, TRUE);
        $content['main'] = $this->load->view('setcategory', $data, TRUE);
        $this->load->view('admin/template2', $content);

        //  $this->load->view('setcategory');
    }

    function setadmin() {
        $this->load->view('admin/setadmin');
    }

    function adminlogin() {

        $this->load->view('admin/login');
    }

//
//
    function insertcategory() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        // echo $data['categoryname'];die(0);
        $datacategory = array('categoryname' => $data['categoryname']);
        //echo json_encode($datacategory);die(0);
        $this->testing_model->setcategory($datacategory);
    }

    function admin() {
        $sesion = $this->session->userdata('admin');
        if (!$sesion) {
            $this->load->view('admin/login');
        } else {
            $this->load->view('admin/admin_home');
        }
    }

    function insertadmin() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        // echo $data['categoryname'];die(0);
        $dataadmin = array('username' => $data['uname'], 'pass' => md5($data['pass']));
        //echo json_encode($datacategory);die(0);
        $this->testing_model->setadmin($dataadmin);
    }

    function cekadminlog() {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        // echo json_encode($data['uname']);"<br>";
        //   echo json_encode($data);die(0);
//        if ($data['uname'] = "") {
//            echo "Your Username Empty";
//        } else if ($data['pass'] = "") {
//            echo "Your Password Empty";
//        } else {

        $condition = array("username" => $data['uname'], "pass" => md5($data['pass']));
        $result = $this->testing_model->cekadminlogin($condition);
        //  echo json_encode($condition);die(0);
        if ($result) {
            $sess = array();
            $sess = array('username' => $result['username']);
            $this->session->set_userdata('admin', $sess);
//            $this->getreportchannel();
            $content['header'] = $this->load->view('admin/header2', $data, TRUE);
            $content['main'] = $this->load->view('admin/admin_home', $data, TRUE);
            $this->load->view('admin/template2', $content);
        } else {
            echo "Username or password not valid";
        }
        //}
    }

    function home_admin() {

        $content = array();
        $userid = array();
        $channelid = array();
        $catalogueid = array();
        $data = array();
        $product = array();

        $numberofChannel = 0;

        $data["admin"] = $this->session->userdata('admin');
        $data['channels'] = $this->getAllChannel();




        $content['header'] = $this->load->view('admin/header2', $data, TRUE);
        $content['main'] = $this->load->view('admin/admin_home', $data, TRUE);
        $this->load->view('admin/template2', $content);
    }

    function getreportchannel() {
        $content = array();
        $userid = array();
        $channelid = array();
        $catalogueid = array();
        $data = array();
        $product = array();
        $i = 0;
        $data["admin"] = $this->session->userdata('admin');

        // $data["admin"] = $this->session->userdata('admin');
        $data['channels'] = $this->boleci_model->getAllRecord('channel');
        foreach ($data['channels'] as $d) {
            array_push($userid, $d['userid']->{'$id'});
            array_push($channelid, $d['_id']->{'$id'});
        }
        foreach ($userid as $id) {
            $condition = array('_id' => new MongoId($id));
            $data['channels'][$i]['user'] = $this->boleci_model->getSingleRecord("user", $condition);
            $condition5 = array('userid' => $id);
            $data['channels'][$i]['coverchannel'] = $this->boleci_model->getSingleRecord("coverchannel", $condition5);
            $i++;
        }

//            $data2= json_encode($data);
//        die(0);
        $content['header'] = $this->load->view('admin/header2', $data, TRUE);
        $content['main'] = $this->load->view('admin/report_product', $data, TRUE);
        $this->load->view('admin/template2', $content);

        // $dataMerge = array_merge($data['channels'], array("user" => $data['userdata']));
//       ///
    }

    function banneduser($userid) {
        $data = array();
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

//         "_id": {
//        "$id": "5369b4a9ee5da81902000000"
//    },
//    "firstname": "etty",
//    "lastname": "roestiasih",
//    "gender": "male",
//    "birthdate": "05-08-1958",
//    "email": "etty@boleci.com",
//    "password": "66a433a7528605e1389f7dc86d1fb1e7",
//    "image": "",
//    "contact": "02141808750",
//    "status": "1",
//    "channelstatus": "0"
        $userid = $data['userid'];
        $condition = array('_id' => new MongoId($userid));
        $getuser = $this->boleci_model->getSingleRecord("user", $condition);
        $dataupdate = array("firstname" => $getuser['firstname'], "lastname" => $getuser['lastname'],
            "gender" => $getuser['gender'], "birthdate" => $getuser['birthdate'],
            "email" => $getuser['email'], "password" => $getuser['password'],
            "image" => $getuser['image'], "contact" => $getuser['contact'],
            "contact" => $getuser['contact'], "status" => $getuser['status'], "channelstatus" => "1");
        $this->boleci_model->updateonly("user", $condition, $dataupdate);
    }

    function logout1() {
        $productid = array();
        $log = $this->session->unset_userdata('admin');
        session_destroy();
      
        header('Location: '.base_url().'admin');
    }

    function reportallproduct() {
        $productid = array();
        $catalogid = array();
        $allproduct = array();
        $data = array();
        $productresult = array();
        $data["admin"] = $this->session->userdata('admin');
        $data['data'] = $this->boleci_model->getAllRecord('product');



        $c = 0;
        foreach ($data['data'] as $ap) {

            array_push($productid, $ap['_id']->{'$id'});
            array_push($catalogid, $ap['catalogid']->{'$id'});
        }
        $c = 0;
        foreach ($catalogid as $ci) {
            $conditioncatalog = array('_id' => new MongoId($ci));
            $catalogproduct = $this->boleci_model->getSingleRecord("catalog", $conditioncatalog);
            $data['data'][$c]['catalogname'] = $catalogproduct['catalogname'];
            $channelproduct = $this->boleci_model->getSingleRecord("channel", array('_id' => $catalogproduct['channelid']));
            $userproduct = $this->boleci_model->getSingleRecord("user", array('_id' => $channelproduct['userid']));
            $data['data'][$c]['useruploaded'] = $userproduct['firstname'] . " " . $userproduct['lastname'];
            unset($data['data'][$c]['catalogproduct']['_id']);
            $c++;
        }


        $content['header'] = $this->load->view('admin/header2', $data, TRUE);
        $content['main'] = $this->load->view('admin/allproduct', $data, TRUE);
        $this->load->view('admin/template2', $content);
    }

//    function allproduct() {
//        
//        $content['header'] = $this->load->view('admin/header2',$data);
//        $content['main'] = $this->load->view('admin/allproduct',$data);
//        $this->load->view('admin/template2', $content);
//    }
}

/* End of file testing.php */
/* Location: ./application/controllers/welcome.php */