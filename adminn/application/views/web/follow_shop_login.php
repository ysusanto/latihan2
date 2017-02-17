<?php $this->load->view('web/header'); ?>

<div class="container" style="margin-top:70px;">
    <div id="banner_1" style="width:65%">
        <span style="font-size: 20px;">    
            <span style="font-weight: bold"><?php echo $shopdetail['nama_toko']; ?></span><br/><br/>               
        </span>
        <div style="width:100%;min-height:100px;float:left;">
            <img src="<?php 
            if(isset($shopdetail['gambar'][0]['path'])){
                echo base_url().$shopdetail['gambar'][0]['path'];
            }else{
                if(isset($shopdetail['gambar'][0]['thumb_path'])){
                    echo base_url().$shopdetail['gambar'][0]['thumb_path'];
                }else{
                    echo base_url('assets/web/default_cover.png');
                }
            }            
            ?>" style="width:200px;border:solid 2px;">
        </div>
    </div>
    <div id="banner_login" style="width:35%">
        <div id="frame_register" style="padding-left:5px;padding-right:5px;min-height: 100px;margin-top:30px;">
            <span style="font-size: 20px;">    
                Anda telah berhasil memfollow <span style="font-weight: bold"><?php echo $shopdetail['nama_toko']; ?></span><br/><br/>               
            </span>
        </div>
    </div>
</div>

<?php $this->load->view('web/loginModalFollow'); ?>
<?php $this->load->view('web/footer'); ?>
