<div class="modal fade bs-example-modal-sm" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#fff">Login</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('login/doLogin'); ?>" id="loginForm" method="POST">
                    <input type="hidden" id="shopid1" name="shopid1" value="<?php echo (isset($shopid) ? $shopid : '') ?>">
                    <div class="form-group">
                        <label for="reg_inputUsername" class="control-label formtext">Username</label><br/>
                        <input type="text" class="form-control formreg" name="username" id="inputUsername" placeholder="Username" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_inputPassword" class="control-label formtext">Password</label><br/>
                        <input type="password" name="password" class="form-control formreg" id="inputPassword" placeholder="Password" required>
                        <div class="help-block with-errors"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Attach a submit handler to the form
$( "#loginForm" ).submit(function( event ) {
  event.preventDefault(); 
  
  var $form = $( this ),
    username = $form.find( "input[name='username']" ).val(),
    pass = $form.find( "input[name='password']" ).val(),
    shopid = $form.find( "input[name='shopid1']" ).val(),
    url = $form.attr( "action" );
 
  var posting = $.post( url, { username:username, password:pass, shopid:shopid }, function(data) {
}, "json");
 
  posting.done(function( data ) {
    if(data.status == 0){
        alert(data.message);
    }else{
        location.reload();
    }
  });
});
</script>