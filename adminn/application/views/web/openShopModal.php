<div class="modal fade bs-example-modal-sm" id="openShopModal" tabindex="-1" role="dialog" aria-labelledby="openShopModal" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#fff">Buka Toko</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('shop/openShop'); ?>" id="openShopForm" method="POST">
                    <div class="form-group">
                        <label for="shopname" class="control-label formtext">Nama Toko*</label><br/>
                        <input type="text" class="form-control formreg" name="shopname" id="shopname" placeholder="Nama Toko" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="shopaddress" class="control-label formtext">Alamat Toko*</label><br/>
                        <textarea class="form-control formreg" name="shopaddress" id="shopaddress" placeholder="Alamat Toko" required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Attach a submit handler to the form
$( "#openShopForm" ).submit(function( event ) {
  event.preventDefault(); 
  
  var $form = $( this ),
    shopname = $form.find( "input[name='shopname']" ).val(),
    shopaddress = $form.find( "textarea[name='shopaddress']" ).val(),
    url = $form.attr( "action" );
 
  var posting = $.post( url, { shopname:shopname, shopaddress:shopaddress }, function(data) {
}, "json");
 
  posting.done(function( data ) {
    if(data.status == 0){
        alert(data.message);
    }else{
        alert(data.message);
        window.location.replace("<?php echo base_url('manage'); ?>");
    }
  });
});
</script>