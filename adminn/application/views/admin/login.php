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
                            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.js"></script>
                            <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
                            <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
                            <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
                                <!--<link href="script/boleci.css" rel="stylesheet">-->
                                <script>
                                    $(document).ready(function () {
$('#error').hide();
                                    });
                                   
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
                                        var username = $('#username').val();

                                        var password = $('#passwd').val();
//                                         alert(telp);
                                        $.ajax({
                                            type: 'post',
                                            url: '<?php echo base_url(); ?>clogin/dologin',
                                            data: "username=" + username + "&password=" + password,
//                                            datatype : "JSON",
                                            success: function (msg) {
//                                                
                                                obj = JSON.parse(msg);
//                                                alert(obj.status);
                                            if(obj.status==1){
//                                                alert(obj.message)
                                                 location.replace("<?php echo base_url(); ?>admin/index")
                                             }else{
                                                  $('#error').show();
                                                 $('#error').text(obj.message);
//                                                  alert(obj.message)
//                                                  location.reload()
                                             }
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
                                            <div class="col-md-4"></div>
                                            <!--<div class="col-md-4">.col-md-4</div>-->

                                            <div class="col-md-4" style='min-width:200px;min-height:200px;background: #CCCCCC;border-radius: 15px;padding:30px;margin-left: auto;margin-right: auto;'>
                                                <div id="android" style="text-align: center;">
                                                    <div id="inputan">
                                                        <div class="title2" style="float:left;">
                                                        </div>
                                                        <!--<div id="intro1" style="margin-top:20px;margin-bottom:30px;text-align: right; ">user</div>-->
                                                        <div id="intro2" style="margin-top:20px;margin-bottom:30px;text-align: center;"><h1>LOGIN</h1></div>
                                                        <!--<form id="registerform" name="registerform" method="post" autocomplete="off"  enctype="multipart/form-data" >-->
                                                        <!--<div class="alert alert-success" role="alert" id="sukses"></div>-->
                                                        <div class="alert alert-danger" role="alert" id="error"></div>
                                                        <div id='datainput' style='margin-bottom:20px ;text-align: center;'>

                                                            <div class="form-group">

                                                                <input type="text" class="form-control" id="username" placeholder="Username">
                                                            </div>
                                                            <div class="form-group">

                                                                <input type="password" class="form-control" id="passwd" placeholder="Password">
                                                            </div>


                                                            <button type="submit" class="btn btn-default" style='margin-top:30px ;text-align: center;' onclick="senddata()">Login</button>


                                                        </div>
                                                    </div>



                                                    &nbsp;<br/>
                                                    <!--</form>-->
                                                </div>

                                            </div>
                                            <div class="col-md-4"></div>
                                            <!--                                                                        <div id="nonAndroid"><div id='messege'><div id="intro1" style="margin-top:20px;margin-bottom:30px;text-align: center; border-style: solid;border-width: 1px; border-radius: 5px"><div class="row">
                                                                                                                                    <div class="col-md-6"><img src="<?php echo base_url(); ?>assets/volume_up.png"  style='cursor: pointer; width:40px;height:40px;margin-top:20px;'  /> </img></div>
                                                                                                                                    <div class="col-md-6"><div id="text"><h3>Maaf </br>Harap menggunakan mobile android  </br>untuk mendownload dan menginstal Boleci</h3></div></div>
                                                                                                                                </div></div>
                                                                                                                        </div></div>-->
                                        </div>
                                    </div>
                                    <!--</div>-->
                                    <!--</div>-->
                                </body>
                                </html>