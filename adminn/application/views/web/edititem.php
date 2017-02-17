<?php $this->load->view('web/header'); ?>

<div class="container" id="areaedititem" style="padding:0px;">
    <div class="container" id="headeritemdetail">
        <h4 id="myModalLabel" style="color:#fff">Edit Produk</h4>
    </div>
    <div class="container" style="width:700px;margin-top:20px;">
        <form action="<?php echo base_url('manage/editItem'); ?>" id="editItemForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="shopid" value="<?php echo $itemdetail['shop_id']; ?>">
        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
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
            <div style="width:100%;padding-left:20px;">
                <label class="control-label radio-inline">
                    <input id="sold1" type="radio" name="issold" value="1">Yes
                </label>
                <label class="control-label radio-inline">
                    <input id="sold2" type="radio" name="issold" value="0" checked>No
                </label>
            </div>
        </div>
    </div>
    <div class="container" style="width:660px;min-height:40px;margin-top:20px;margin-bottom:20px;text-align: center;">
        <img src="<?php echo base_url('assets/web/but_hapus.png'); ?>" style="float:left;margin-top:5px;margin-left:5px;margin-right:5px;cursor:pointer;" onclick="deleteItem('<?php echo $item_id; ?>')">
        <a href="<?php echo base_url('manage'); ?>"><img src="<?php echo base_url('assets/web/but_cancel.png'); ?>" style="float:left;margin-top:5px;margin-left:5px;margin-right:5px;"></a>
        <input type="image" src="<?php echo base_url('assets/web/but_save.png'); ?>" style="float:left;margin-top:5px;margin-left:5px;margin-right:5px;">
    </div>
    </form>
</div>

<script>
$(document).ready(function(){
    <?php 
        if(isset($itemdetail['gambar'][0]['thumb_path'])){
            echo "$('#itemimagepreview').attr('src', '".base_url().$itemdetail['gambar'][0]['thumb_path']."');";
        }else{
            if(isset($itemdetail['gambar'][0]['path'])){
                echo "$('#itemimagepreview').attr('src', '".base_url().$itemdetail['gambar'][0]['path']."');";
            }
        }
    ?>
    $("#itemname").val("<?php echo $itemdetail['nama']; ?>");
    $("#itemprice").val("<?php echo $itemdetail['harga']; ?>");
    $("#itemcate").val("<?php echo $itemdetail['subcategory_id']; ?>");
    $("#min-jumlah").val("<?php echo (isset($itemdetail['min_jumlah']) ? $itemdetail['min_jumlah'] : '1'); ?>");
    $("#min-satuan").val("<?php echo (isset($itemdetail['min_satuan']) ? $itemdetail['min_satuan'] : 'Satuan'); ?>");
    $("#itemdesc").val("<?php echo $itemdetail['fdesc']; ?>");
    <?php 
        $rad = '';
        $sold = isset($itemdetail['is_sold']) ? $itemdetail['is_sold'] : '0'; 
        if($sold == "0"){
            $rad .= '$("#sold0").prop("checked", true);';
        }else{
            $rad .= '$("#sold1").prop("checked", true);';
        }
        echo $rad;
    ?>
});

function deleteItem(id){
    var r = confirm("Apakah Anda yakin?\nProduk yang sudah dihapus tidak akan bisa dikembalikan.");
    if (r == true) {
        $.ajax({ 
            url: '<?php echo base_url('manage/deleteItem'); ?>', 
            method: "POST",
            data: { itemid : id }, 
            dataType: 'json', 
        })
        .done(function(msg) { 
            if(msg.status == 1){
                alert(msg.message);
                window.location.replace("<?php echo base_url('manage'); ?>");                
            }else if(msg.status == 2){
                alert(msg.message);
                location.reload();
            }
        });
        return false;
    }
}

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

$('#editItemForm').ajaxForm(options); 

function showRequest(formData, jqForm, options) { 
    $('#submitAdd').prop('disabled', true);
    return true; 
} 
 
function showResponse(data) { 
    if(data.status == 1){
        alert(data.message);
        window.location.replace("<?php echo base_url('manage'); ?>");
    }else if(data.status == 2){
        alert(data.message);
        window.location.replace("<?php echo base_url(''); ?>");
    }
} 
</script>

<?php $this->load->view('web/footer'); ?>
