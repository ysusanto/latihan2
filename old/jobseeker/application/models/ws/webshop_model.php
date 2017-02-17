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
        $this->load->model('ws_global_model', 'globalmodel');
    }

    function getshopdetail($condition){
        $condShop = array(
            'user_id' => new MongoId($condition['user_id']),
            'fdelete' => '1'
        );
        $colshop = 'tshop';
        $shopdet = $this->globalmodel->getOneRecordWithCond($condShop, $colshop);
        if (sizeof($shopdet) > 0) {
            $condPictshop = array(
                'shop_id' => new MongoId($shopdet['_id']->{'$id'}),
                'fdelete' => '1'
            );
            $colpictshop = 'tpicture_shop';
            $shoppict = $this->globalmodel->getOneRecordWithCond($condPictshop, $colpictshop);
            
            $condItem = array(
                'shop_id' => new MongoId($shopdet['_id']->{'$id'}),
                'fdelete' => '1'
            );
            $colitem = 'tproduct';
            $shopitem = array();
            $allitem = $this->globalmodel->getRecordWithCondition($colitem, $condItem);
           
            if (sizeof($allitem) > 0) {
                foreach ($allitem as $item) {
                    $item['gambar'] = array();
                    $condItemPict = array('item_id' => $item['_id'], 'fdelete' => '1');
                    $collitempict = 'tpicture_item';
                    $getpictItem = $this->globalmodel->getRecordWithCondition($collitempict, $condItemPict);
                    if (sizeof($getpictItem) > 0) {
                        foreach ($getpictItem as $pict) {
                            $pict['pict_id'] = $pict['_id']->{'$id'};
                            unset($pict['_id']);
                            unset($pict['modified_by']);
                            unset($pict['create_by']);
                            array_push($item['gambar'], $pict);
                        }
                    }
                    array_push($shopitem, $item);
                }
            }
            
            $shopinfo = array(
                'shopdet' => $shopdet,
                'shoppict' => $shoppict,
                'shopitem' => $shopitem
            );
            return $shopinfo;
        }else{
            return 0;
        }
    }
}
