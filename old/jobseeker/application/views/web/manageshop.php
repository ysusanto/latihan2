<?php $this->load->view('web/header'); ?>

    <div class="container" style="width:100%;height:300px;background-size: auto 300px;background-image: url('<?php echo $shopdetail['shoppict']['path']; ?>');background-size: 100% auto;
    background-repeat: no-repeat;background-position: center;" id="shopcover">
        <div class="profpic">
            <img src="<?php echo base_url('assets/sliced/profpic_default.png'); ?>" style="width:150px;height:150px;" />
        </div>
        <img src="<?php echo base_url('assets/sliced/addnewproduct.png'); ?>" style="position:absolute;z-index: 999;margin-top:318px;margin-left:200px;" />
    </div>

<div class="container" style="width:100%;min-height:200px;background-color: #31b0d5;margin-top:50px;">
    
</div>

<?php $this->load->view('web/footer'); ?>
