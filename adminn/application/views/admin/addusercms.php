<div class="modal fade bs-example-modal-sm" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">

<div class="modal-content" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:#fff">Add User</h4>
    </div>
    <div class="modal-body">
        <!--<form action="<?php echo base_url('login/doLogin'); ?>" id="loginForm" method="POST">-->
        <input type="hidden" id="shopid1" name="shopid1" value="<?php echo (isset($shopid) ? $shopid : '') ?>">
        <div class="form-group">
            <label for="reg_inputUsername" class="col-md-2 control-label">Username</label><br/>
            <input type="text" class="form-control formreg" name="username" id="inputUsername" placeholder="Username" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="reg_inputPassword" class="col-md-2 control-label">Password</label><br/>
            <input type="password" name="password" class="form-control formreg" id="inputpasswd" placeholder="Password" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="reg_inputConfPass" class="col-md-6 control-label">Konfirmasi Password</label><br/>
            <input type="password" class="form-control formreg" name="conf_passwd" id="inputconf_passwd" placeholder="Konfirmasi Password" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="reg_inputNama" class="col-md-2 control-label">Nama</label><br/>
            <input type="text" name="nama" class="form-control formreg" id="inputNama" placeholder="Nama" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="reg_inputAlamat" class="col-md-2 control-label">Alamat</label><br/>
            <textarea type="text" class="form-control formreg" name="alamat" id="inputAlamat" placeholder="Alamat" ></textarea>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="reg_inputTelp" class="col-md-4 control-label">No. Telp</label><br/>
            <input type="text" name="telp" class="form-control formreg" id="inputTelp" placeholder="No. Telp" >
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="adduser()" style="margin-right: 20px;">Add</button><button class="btn btn-lg btn-primary btn-block"  data-dismiss="modal" aria-label="Close">Cancel</button>
        <!--</form>-->
    </div>
</div>
    </div>
</div>

<script>
    function validadd() {
var username = $('#inputUsername').val();
        var password = $('#inputpasswd').val();
        var confpasswd=$('#inputconf_passwd').val();
        var nama = $('#inputNama').val();
        var alamat = $('#inputAlamat').val();
        var telp = $('#inputTelp').val();
        
        
    }
    function adduser() {
        var username = $('#inputUsername').val();
        var password = $('#inputpasswd').val();
        var nama = $('#inputNama').val();
        var alamat = $('#inputAlamat').val();
        var telp = $('#inputTelp').val();
       
//                                         alert(telp);
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>clogin/registerusercms',
            data: "username=" + username + "&password=" + password+ "&nama=" + nama+ "&alamat=" + alamat+ "&telp=" + telp,
//                                            datatype : "JSON",
            beforeSend: validadd(),
            success: function (msg) {
//                alert(msg);
//                                                alert(msg);
//                if (msg == "ok") {
                    location.reload();
//                } else {
//                    location.replace("<?php echo base_url(); ?>wap")
//                }
//                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
//                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
//                                                viewReport(0);
            }

        });
//                                        $('#registerform').trigger('submit');
    }

// Attach a submit handler to the form
//    $("#loginForm").submit(function (event) {
//        event.preventDefault();
//
//        var $form = $(this),
//                username = $form.find("input[name='username']").val(),
//                pass = $form.find("input[name='password']").val(),
//                url = $form.attr("action");
//
//        var posting = $.post(url, {username: username, password: pass}, function (data) {
//        }, "json");
//
//        posting.done(function (data) {
//            if (data.status == 0) {
//                alert(data.message);
//            } else {
//                location.reload();
//            }
//        });
//    });
</script>