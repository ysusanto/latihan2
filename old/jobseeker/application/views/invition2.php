<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <html lang="en">
        <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="description" content="">
                        <meta name="author" content="">


                            <title>Boleci</title>

<!--<script type="text/javascript" src="script/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>-->
                            <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
                            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
                            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.zclip.js"></script>
                            <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
                                <!--<link href="script/boleci.css" rel="stylesheet">-->
                                <script>
                                    $(document).ready(function() {

                                        $('a#copy-description').zclip({
                                            path: '<?php echo base_url(); ?>js/ZeroClipboard.swf',
                                            copy: $('p#description').text()
                                        });

//                                        var query = window.location.pathname;
//                                        var vars = query.split("/");
//                                        window.prompt("Copy to clipboard: Ctrl+C, Enter", "boleci :" + vars[3]);
//$.ajax({
//                                            type: 'post',
//                                            url: '<?php echo base_url(); ?>home/geturl',
//                                            data: "no_tlp=" + telp + "&shop_id=" + id,
////                                            datatype : "JSON",
//                                            success: function(msg) {
//                                                window.open(msg, '_blank');
//                                                window.location.reload();
////                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
////                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
////                                                viewReport(0);
//                                            }
//
//                                        });
////  alert(vars[3]);
//// function WriteToFile(passForm) {
////
//    set fso=CreateObject("Scripting.FileSystemObject");  
//    fso.CreateFolder("C:\\\\boleci");
//    var id="C:\\\\boleci\\"+vars[3]+".txt";
////    alert(id);
//    fso.CreateTextFile(id, True);
////    s.writeline("HI");
//    s.writeline("Bye");
//    s.writeline("-----------------------------");
//    s.Close();
// }
                                    });
//                                    
//                                    function bacaurl(){
//                                        var query = window.location.pathname.split( '/' );
//  var vars = query.split("/");
//  alert(query);
//  
//                                    }
                                    function angka(e) {
                                        if (!/^[0-9]+$/.test(e.value)) {
                                            e.value = e.value.substring(0, e.value.length - 1);
                                        }
                                    }
                                    //    function callback(responseText, statusText) {
                                    //        alert(responseText);
                                    //    }
                                    //    
                                    //    function AjaxError() {
                                    //	alert("Error saving to database");
                                    //    }
                                    //    
                                    function senddata() {
                                        var telp = $('#no_telp').val();

                                        var id = $('#shop_id').val();
//                                         alert(telp);
                                        $.ajax({
                                            type: 'post',
                                            url: '<?php echo base_url(); ?>home/registerurl',
                                            data: "no_tlp=" + telp + "&shop_id=" + id,
//                                            datatype : "JSON",
                                            success: function(msg) {
                                                window.open(msg, '_blank');
                                                window.location.reload();
//                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
//                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
//                                                viewReport(0);
                                            }

                                        });
//                                        $('#registerform').trigger('submit');
                                    }
                                    //    function login(){
                                    //        $('#loginform').trigger('submit');
                                    //    }
                                </script>
                                </head>
                                <body>
                                    <!--<div id="wrapper">-->


                                    <!--<div id="content" style="margin-top:91px">-->
                                    <div id="container-fluid">
                                        <div class="row" style="margin :10%;">
                                            <!--                <div class="title" style="float:left;">
                                                                <span style="font-size: 20px;font-weight: bold;margin-left:20px;">Register</span>
                                                            </div>-->
                                            <div class="col-xs-9" style='min-width:200px;min-height:200px;background: #CCCCCC;border-radius: 15px;padding:30px;margin-left: auto;margin-right: auto;'>
                                                <div class="title2" style="float:left;">
                                                </div>
                                                <div id="intro1" style="margin-top:20px;margin-bottom:30px;text-align: center; border-style: solid;border-width: 1px; border-radius: 5px"><div class="row">
                                                        <div class="col-md-6"><img src="<?php echo base_url(); ?>assets/volume_up.png" style='cursor: pointer; width:20px;height:20px;'  /> </img></div>
                                                        <div class="col-md-6"><div id="text">Toko <span id='judul_toko' style=''><?php echo $data_toko['nama_toko']; ?></span> </br>Telah mengundang anda </br>untuk bergabung dalam boleci.</div></div>
                                                    </div> </div>
                                                <!--<div id="intro2" style="margin-top:20px;margin-bottom:30px;text-align: center;">Harap Masukan nomor telepon anda</div>-->
                                                <!--<form id="registerform" name="registerform" method="post" autocomplete="off"  enctype="multipart/form-data" >-->
                                                <div id='datainput' style='margin-bottom:20px'>
                                                    <!--                                                            <div class="input-group-addon">+62</div>-->
<!--                                                    <select  class="form-control" style="width:81%;" onchange="">
                                                        <option value="ina" selected>Indonesia</option>
                                                        <option value="sgd">Singapore</option>
                                                                                                                    <option>3</option>
                                                                                                                    <option>4</option>
                                                                                                                    <option>5</option>
                                                    </select>-->

                                                </div>
                                                <div id='datainput' style='margin-bottom:20px;text-align: center;'><div class="input-group">
                                                        <!--<div class="input-group-addon">+62</div>-->
                                                        <!--<input type="text" class="form-control" style="width:80%;" id="no_telp" name="no_telp" placeholder="No Telp" onkeyup="angka(this)" required  maxlength="12" >-->
                                                            <input type="hidden" class="form-control" style="width:50%;" id="shop_id" name="shop_id" value="<?php echo $data_toko['_id']->{'$id'}; ?>">
                                                    </div>
                                                </div>

                                                <div id="registerbtndiv">
                                                    <div id="registerbtn" style='margin-left: auto;margin-right: auto;'>
                                                  <!--      <img src="<?php // echo base_url();      ?>assets/submit_no_telp.png" sytle="cursor: pointer;"  onclick="senddata(); /> </img>-->
                                                        <!--<button type="submit" class="btn btn-info" onclick="senddata();">Submit</button>-->
                                                    </div>
                                                </div>
                                                &nbsp;<br/>
                                                <!--</form>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--</div>-->
                                    <!--</div>-->
                                </body>
                                </html>