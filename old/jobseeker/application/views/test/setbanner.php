<script>
    $(document).ready( function () {
//        var oTable = $('#banner').dataTable( {
//            "sDom": 'R<"H"lfr>t<"F"ip>',
//            "bJQueryUI": true,
//            "sPaginationType": "full_numbers"
//        } );
//         $('#addbanner').hide();
        $('#bannerform').submit(function() 
        {
      
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                // dataType: "json",
                // cache: false,
                // dataType : "text",
                success: function(msg){
                    alert(msg);
//                    alert("Banner Added");
//                    location.reload();
                }
            });
            return false;
            //document.write( url);die(0);
       
        })
    } );
    
    function deletebanner(bannerid)
    {
      
        $.ajax({
            type: 'post',
            url: "<?php echo base_url(); ?>deletebanner",
            data: { bannerid: bannerid },
            success: function(msg){	
                // alert(msg);
                alert("You delete this banner");
                location.reload();
            }
        });
       
    }
    
</script>



<div id="divcontent" style="margin-top: 20px;">
    <div class="divcontent1" style="margin-top: 15px;margin-bottom: 15px">
       
       
        <div id="addbanner" style ="margin-top: 10px;">
            Add instaler :
            <form id="bannerform" name="bannerform" method="post" autocomplete="off"  enctype="multipart/form-data" action="<?php echo base_url(); ?>home/do_upload">
                <input  type="file" name="file" placeholder="Add Banner" id="file"><br> <br>
                <input class="btn" type="submit" name="submit" value="Save">
            </form>
        </div>
    </div>
</div>