<?php $this->load->view('web/header'); ?>

<script>
$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#covertoko').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#bgphotoimg").change(function(){
        readURL(this);
        $('#areauploadcover').hide();
        $('#cancelCover').show();
        $('#submitCover').show();
        $('#covertoko').css('margin-top','0px');
        $('#timelineBackground').imagedrag({
          input: "#output",
          position: "middle",
          attribute: "html"
        });
    });
    
    var options = { 
        beforeSubmit:  showRequest,
        success:       showResponse,
        dataType:  'json'
    }; 

    $('#bgimageform').ajaxForm(options); 

    function showRequest(formData, jqForm, options) { 
//        $('#submitCover').prop('disabled', true);
        return true; 
    } 

    function showResponse(data) { 
        if(data.status == 1){
            alert(data.message);
            location.reload();
        }else{
            alert(data.message);
            location.reload();
        }
    } 
});

function cancelupload(){
    location.reload();
}
</script>
<div class="container" id="containercover">
    <div id="timelineContainer">
        <div id="timelineBackground">
            <img src="<?php 
            if($shopdetail['shoppict']['path']!=''){
                echo $shopdetail['shoppict']['path'];    
            }else{
                echo base_url('assets/web/default_cover.png');    
            } 
            ?>" class="bgImage" id="covertoko" style="width:940px;<?php 
                if(isset($shopdetail['shoppict']['ypos'])){
                    echo "margin-top:".$shopdetail['shoppict']['ypos'];    
                } 
            ?>">
        </div>

        <div id="timelineShade">
            <form id="bgimageform" method="post" enctype="multipart/form-data" action="<?php echo base_url('manage/uploadCover'); ?>">
                <div class="uploadFile timelineUploadBG" id="areauploadcover">
                    <input type="file" name="photoimg" id="bgphotoimg" class="custom-file-input">
                </div>
                <input type="hidden" id="yposition" name="yposition">
                <input type="hidden" id="shopid" name="shopid" value="<?php echo $shopdetail['shopdet']['shop_id']; ?>">                
                <button class="btn btn-primary" type="submit" id="submitCover" style="float:right;margin-right:10px;margin-top:50px;display:none;">Save</button>
            </form>
                <button class="btn" id="cancelCover" onclick="cancelupload();" style="float:right;margin-right:10px;margin-top:50px;display:none;">Cancel</button>
        </div>
    </div>
</div>

<div class="container" id="areaitem" style="padding:10px;">
    <span id="output" style="display:none;"></span>
    <div class="additemblock" data-toggle="modal" data-target="#addItemModal" style="text-align: center;"><img src="<?php echo base_url('assets/web/but_addproduct.png'); ?>" style="margin-top:65px;"></div>
        <?php 
        $x = '';
        if(isset($shopdetail['shopitem'])){
            foreach($shopdetail['shopitem'] as $item){
                $nama = strlen($item['nama']) > 20 ? substr($item['nama'],0,20)."..." : $item['nama'];
                $x .= '<a href="'.base_url('edit/item/'.$item['item_id']).'">';
                if($item['gambar']){
//                    print_r($item['gambar']);die(0);
                    $x.='<div class="item" style="background-image: url(\''.$item['gambar'][0]['thumb_path'].'\');">';
                }else{
                    $x.='<div class="item" style="background-image: url(\'assets/web/laptop.png\');">';
                }
                $x .= '<div class="item-highlight">
                                <div style="width:90%;float:left;margin-left:5%;border-bottom:solid 2px #fff;height:40px;">
                                    <span style="color:#fff;font-size:14px;line-height:2.4">'.$nama.'</span>
                                </div>
                                <div style="width:90%;float:left;margin-left:5%;margin-top:10px;">
                                    <span style="color:#fff;font-size:15px;">Rp '.$this->webshop_model->format_to_idr($item['harga']).'</span>
                                </div>
                            </div>
                        </div></a>';
            }
        }
        echo $x;
        ?>
</div>

<?php $this->load->view('web/addItemModal'); ?>
<?php $this->load->view('web/footer'); ?>
