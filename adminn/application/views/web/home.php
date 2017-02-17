<?php $this->load->view('web/header'); ?>

<div class="container" style="margin-top:70px;">
    <div id="banner_1">
        <img src="<?php echo base_url('assets/web/laptop.png'); ?>" style="width:600px;margin:0 auto;">
    </div>
    <div id="banner_login">
        <?php if($username){ ?>
            <img src="<?php echo base_url('assets/web/welcome.png'); ?>" style="width:260px;margin:70px auto;">
        <?php }else{ ?>
        <span style="font-size: 20px;">
            Buka Toko, Beli Grosir, dan Banyak Lagi <br/>
        </span>
        <div id="frame_register">
            <form action="<?php echo base_url('register/doRegister'); ?>" id="registerForm" method="POST" data-toggle="validator">
                <div class="form-group">
                    <label for="reg_inputUsername" class="control-label formtext">Username*</label><br/>
                    <input type="text" class="form-control formreg" name="reg_username" id="reg_inputUsername" placeholder="Username" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="reg_inputPassword" class="control-label formtext">Password*</label><br/>
                    <input type="password" name="reg_password" data-minlength="6" data-minlength-error="Password minimal 6 karakter" class="form-control formreg" id="reg_inputPassword" placeholder="Password" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="reg_inputConfPassword" class="control-label formtext">Confirm Password*</label><br/>
                    <input type="password" name="reg_confpassword" class="form-control formreg" id="reg_inputConfPassword" data-match="#reg_inputPassword" data-match-error="Password tidak sama" placeholder="Confirm" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="reg_inputUsername" class="control-label formtext">Nama Pemilik*</label><br/>
                    <input type="text" class="form-control formreg" name="reg_nama" id="reg_inputNama" placeholder="Nama Pemilik" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="reg_inputUsername" class="control-label formtext">Telp/HP*</label><br/>
                    <input type="text" class="form-control formreg" name="reg_telp" id="reg_inputTelp" placeholder="Telp/HP" required >
                    <div class="help-block with-errors"></div>
                </div>
                <input type="image" src="<?php echo base_url('assets/web/but_register.png'); ?>" style="margin-top:5px;width:60%;">
            </form>
        </div>
        <div style="text-align: center;">
            <span style="font-size: 20px;">or </span><span style="font-size: 20px;color: #297dc2;cursor:pointer;" data-toggle="modal" data-target="#loginModal">Login</span>
        </div>
        <?php } ?>
    </div>
</div>

<div class="container" id="areabukatoko">
    <div class="box effect2">
        <div style="width:400px;float:left;padding:20px;text-align: center;">
            <?php if($username){ ?>
                <?php if($haveshop == 0){ ?>
                    <span style="font-size: 20px;">
                        Buka grosirmu sekarang. MUDAH dan GRATIS! <br/><br/>
                        <img src="<?php echo base_url('assets/web/but_bukatoko.png'); ?>" style="cursor:pointer;" data-toggle="modal" data-target="#openShopModal">
                    </span>
                <?php }else{ ?>
                    <span style="font-size: 20px;">
                        Kamu sudah memiliki toko. Atur sekarang. <br/><br/>
                        <a href="<?php echo base_url('manage'); ?>"><img src="<?php echo base_url('assets/web/but_tokosaya.png'); ?>"></a>
                    </span>
                <?php } ?>
            <?php }else{ ?>
                <span style="font-size: 20px;">
                    Bergabung sekarang juga dengan Boleci. <br/><br/>
                </span>
            <?php } ?>
        </div>
        <div style="width:300px;float:right;padding:30px;">
            <img src="<?php echo base_url('assets/web/mobile.png'); ?>">
        </div>
    </div>
</div>

<script>
// Attach a submit handler to the form
$( "#registerForm" ).submit(function( event ) {
  event.preventDefault(); 
  
  var $form = $( this ),
    username = $form.find( "input[name='reg_username']" ).val(),
    pass = $form.find( "input[name='reg_password']" ).val(),
    conf_pass = $form.find( "input[name='reg_confpassword']" ).val(),
     nama = $form.find( "input[name='reg_nama']" ).val(),
    telp = $form.find( "input[name='reg_telp']" ).val(),
    url = $form.attr( "action" );
 
  var posting = $.post( url, { username:username, password:pass, conf_password:conf_pass ,nama:nama, telp:telp}, function(data) {
}, "json");
 
  posting.done(function( data ) {
    if(data.status == 0){
        alert(data.message);
    }else{
        alert(data.message);
        location.reload();
    }
  });
});
</script>

<?php $this->load->view('web/loginModal'); ?>
<?php $this->load->view('web/openShopModal'); ?>
<?php $this->load->view('web/footer'); ?>
