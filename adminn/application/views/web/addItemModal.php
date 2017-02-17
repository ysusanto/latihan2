<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#fff">Tambah Produk</h4>
            </div>
            <div class="modal-body" style="min-height:300px;">
                <form action="<?php echo base_url('manage/addItem'); ?>" id="addItemForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="shopid" value="<?php echo $shopdetail['shopdet']['shop_id']; ?>">
                    <div id="itemimageprev" style="width:250px;min-height:50px;float:left;border: solid 1px #9d9d9d;">                        
                        <div id="upload-item-img-container">
                            <input type='file' id="itemimage" name="itemimage" />
                        </div> 
                        <img id="itemimagepreview" src="" style="width:248px;" /> 
                    </div>
                    <div style="width:400px;min-height:350px;float:left">
                        <div class="form-group">
                            <label for="itemname" class="control-label formtext">Nama Produk*</label><br/>
                            <input type="text" class="form-control formreg" name="itemname" id="itemname" placeholder="Nama Produk" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="itemprice" class="control-label formtext">Harga*</label><br/>
                            <input type="number" class="form-control formreg" name="itemprice" id="itemprice" placeholder="Harga" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label for="itemcate" class="control-label formtext">Kategori*</label><br/>
                            <select class="form-control formreg" name="itemcate" id="itemcate" required>
                                <?php 
                                    $x = '';
                                    if($category){
                                        foreach($category as $ct){
                                            $x .= '<option value="'.$ct['id_sublookup'].'">'.$ct['nama_sub'].'</option>';
                                        }
                                    }
                                    echo $x;
                                ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">                            
                            <label for="min-pembelian" class="control-label formtext">Minimum Pembelian*</label><br/>
                            <div class="col-xs-10">
                                <div class="form-inline" style="margin-left:5px;">
                                    <div class="form-group">
                                        <input type="number" class="form-control formreg" name="min-jumlah" id="min-jumlah" placeholder="Jumlah" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control formreg" name="min-satuan" id="min-satuan" required>
                                            <?php 
                                                $x = '';
                                                if($satuan){
                                                    foreach($satuan as $st){
                                                        $x .= '<option value="'.$st['nama'].'">'.$st['nama'].'</option>';
                                                    }
                                                }
                                                echo $x;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group" style="margin-top:55px;">
                            <label for="itemdesc" class="control-label formtext">Deskripsi Produk</label><br/>
                            <textarea class="form-control formreg" name="itemdesc" id="itemdesc" placeholder="Deskripsi Produk" style="height:104px;resize: vertical;"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;">
                            <label for="issold" class="control-label formtext">Sold Out?</label><br/>
                        </div>
                        <div style="width:100%;padding-left:20px;margin-bottom:20px;">
                            <label class="control-label radio-inline">
                                <input id="sold1" type="radio" name="issold" value="1">Yes
                            </label>
                            <label class="control-label radio-inline">
                                <input id="sold2" type="radio" name="issold" value="0" checked>No
                            </label>
                        </div>
                    </div>                        
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="submitAdd">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#itemimagepreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#itemimage").change(function(){
    readURL(this);
});    

var options = { 
    beforeSubmit:  showRequest,
    success:       showResponse,
    dataType:  'json'
}; 

$('#addItemForm').ajaxForm(options); 

function showRequest(formData, jqForm, options) { 
    $('#submitAdd').prop('disabled', true);
    return true; 
} 
 
function showResponse(data) { 
    if(data.status == 1){
        $('#addItemForm').resetForm();
        $('#itemimagepreview').attr('src', '');
        $('#addItemModal').modal('hide');
        alert(data.message);
        location.reload();
    }else if(data.status == 2){
        alert(data.message);
        window.location.replace("<?php echo base_url(''); ?>");
    }else{
        alert(data.message);
        $('#submitAdd').prop('disabled', false);
    }
} 
</script>