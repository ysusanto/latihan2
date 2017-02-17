<?php $this->load->view('web/header'); ?>

<div class="container" style="margin-top:70px;">
    <div id="banner_1">
        <span style="font-size: 20px;">
            <span style="font-weight: bold"><?php echo $shopdetail['nama_toko']; ?></span> telah mengundang Anda untuk bergabung.<br/><br/>               
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
    <div id="banner_login">
        <div id="frame_register">
            <form action="<?php echo base_url('register/doRegister'); ?>" id="registerForm" method="POST" data-toggle="validator">
                <input type="hidden" id="shopid" name="shopid" value="<?php echo (isset($shopid) ? $shopid : '') ?>">
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
                <input type="image" src="<?php echo base_url('assets/web/but_register.png'); ?>" style="margin-top:5px;width:60%;">
            </form>
        </div>
        <div style="text-align: center;">
            <span style="font-size: 20px;">or </span><span style="font-size: 20px;color: #297dc2;cursor:pointer;" data-toggle="modal" data-target="#loginModal">Login</span>
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
    shopid = $form.find( "input[name='shopid']" ).val(),
    url = $form.attr( "action" );
 
  var posting = $.post( url, { shopid:shopid, username:username, password:pass, conf_password:conf_pass }, function(data) {
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

<?php $this->load->view('web/loginModalFollow'); ?>
<?php $this->load->view('web/footer'); ?>
