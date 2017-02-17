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
                            <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
                                <!--<link href="script/boleci.css" rel="stylesheet">-->
                                <script>
                                    $(document).ready(function() {
                                        $('#callback').hide();
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
                                        function detectmob() {
                                            if (navigator.userAgent.match(/Android/i)
//                                                    || navigator.userAgent.match(/webOS/i)
//                                                    || navigator.userAgent.match(/iPhone/i)
//                                                    || navigator.userAgent.match(/iPad/i)
//                                                    || navigator.userAgent.match(/iPod/i)
//                                                    || navigator.userAgent.match(/BlackBerry/i)
//                                                    || navigator.userAgent.match(/Windows Phone/i)
                                                    ) {

                                                return true;
                                            }
                                            else {
                                                return false;
                                            }
                                        }
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
                                                if (detectmob() == true) {
                                                    window.open(msg, '_blank');
                                                }
                                                $('#callback').show();
                                                $('#inputan').hide();
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
                                    <div class="container">
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">File input</label>
                                                <input type="file" id="exampleInputFile">
                                                    <p class="help-block">Example block-level help text here.</p>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Check me out
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </form>

                                    </div>                                                                        </body>
                                </html>