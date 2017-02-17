<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of profile_model
 *
 * @author henrikus
 */
class profile_model extends CI_Model{
    //put your code here
    
    function profile_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('db_load');
    }
    
    function view_kursus($id){
        
        
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:m:s');
        $db = $this->load->database('default',TRUE);
                
        $sql="select * from  training_center where id_training='".$id."'";
        
                 $qry = $db->query($sql);
         $num = $qry->num_rows();
//                           print_r($num);die(0);
         $sql2="select * from user where id_user='".$id."'";
         $qry2 = $db->query($sql2);
$html='';
         if ($num > 0) {
             $row = $qry->row_array();
             $user=$qry2->row_array();
             $html.='<div id="head" style="margin-bottom: 20px"><h1>PROFILE</h1></div>

        <form>
            <div class="modal-footer"></div>


            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">

                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama :</label>
                        '.$user['nama'].'
                    <div id="buttonupdate" style="float:right;"><button class="btn btn-default" type="button" onclick="update()">Edit</button></div></div>
                    <div class="form-group">
                    </div>
                </div>

                <!--            <div class="col-xs-6 col-md-4"></div>
                            <div class="imgprofil" >
                
                                <img src="<?php echo base_url(); ?>assets/images/man.jpg" class="img-responsive" alt="Responsive image">
                            </div>-->
            </div><BR>
            <div class="modal-footer"></div>

            <div id="head" style="margin-bottom: 20px"><h4>INDUSTRI </h4></div>
            <div class="row"><div class="col-xs-6 col-md-4"><label class="checkbox-inline"></label>
            
</div>
                
                
            </div><br>
            <div class="modal-footer"></div>
            <!--</div>-->
            <br>
            <div class="row">

                <div class="col-xs-6 col-md-4"> 
                    <div class="form-group">            
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="OTHER">
                    </div>
                </div></div><BR>
            <br>
            <div class="row">

<!--                <div class="col-xs-6 col-md-4"> 
                    <div class="form-group">            
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="OTHER">
                    </div>
                </div>-->
            </div><br>
            <div class="modal-footer"></div>
            <div style="margin-bottom: 20px"><h4>DESCRIPTION</h4></div>
'.$row['descripsi'].'
            <div class="form-group">

               
            </div>
            <div class="row">

                <div class="col-xs-6 col-md-4"> 
                    <div class="form-group">            
                        Website : '.$row['web'].'
                    </div>
                </div>
            </div>
<!--            <div class="modal-footer"></div>
            <button type="submit" class="btn btn-default" onclick="do_register()">Submit</button>-->
        </form>';
             
             
             
             
             return $html;
         } else {
             return 'error';
         }

        
        
                
        
        
        
    }
    
    function view_tki($id){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:m:s');
        $db = $this->load->database('default',TRUE);
        
        $sql="SELECT u.id_user,u.id_sttsuser,u.username,u.nama,u.alamat,u.telp,u.email,e.* FROM `user` u inner join employe e on u.id_user=e.id_employ where u.id_user='".$id."'";
        $query=$db->query($sql);
        
        if($query->num_rows()>0){
            foreach ($query->result_array() as $row){
                
            }
        }
    }
    
}
