<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Exemplaria a Corporate Category Flat Bootstarp responsive Website Template| Home :: w3layouts</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <!-- Custom Theme files -->
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Exemplaria Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!--startpopup-->
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script  type="text/javascript" language="javascript">
            $(document).ready(function () {
                $(".QTPopup").css('display', 'none')
                $(".lnchPopop").click(function () {
                    $(".QTPopup").animate({width: 'show'}, 'slow');
                })
                $(".closeBtn").click(function () {
                    $(".QTPopup").css('display', 'none');
                })
            });
            function do_login() {
                var uname = $('#lgnusername').val();
                var passwd = $('#lgnpassword').val();

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>registerlogin/cheklogin',
                    data: "username=" + uname + "&password=" + passwd,
//                                            datatype : "JSON",
                    success: function (msg) {
//                                                  $('#s_periode1,#s_periode2,#fmonth').html(msg);
//                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
//                                                viewReport(0);
                        if (msg == 'ok') {
                            location.replace("<?php echo base_url(); ?>registerlogin/afterlogin");
                        } else {
                            alert(msg);
                        }
                    }

                });
            }
        </script>
        <!--endpopup-->
        <!--webfont-->

        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <script src="<?php echo base_url(); ?>js/responsiveslides.min.js"></script>
        <script>
            $(function () {
                $("#slider").responsiveSlides({
                    auto: true,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    pager: true,
                });
            });

        </script>

    </head>
    <body>
        <div class="container">


            <div class="middle-row">
                <div class="container">
                    <div class="col-md-6 middle-row-left">
                        <div class="middle-row-left-grids">
                            <div class="m-left">
                                <h4>Brama Kumbara   </h4>
                                <p>saat ini saya bekerja di CEO gaji 10B dollar perbulan </p>

                                <span class="sb-icon-search" </span>
                                <a href="#">Ikuti</a>
                            </div>
                            <div class="m-right">
                                <!--<img src="<?php echo base_url(); ?>assets/images/man.jpg" alt="" />-->
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 middle-row-right">
                        <h2>Forum</h2>
                        <h4>Info Lowongan Kerja Paling Update Setiap Harinya..</h4>
                        <p>Selamat datang di LokerForum, forum diskusi www.kursuskerja.com. Anda mengakses LokerForum sebagai Guest saat ini, dimana Anda tidak mendapatkan akses penuh untuk membaca dan berpartisipasi pada diskusi yang ada di forum ini. Untuk dapat berpartisipasi dan mengakses seluruh fitur di LokerForum, slakan bergabung dan mendaftar menjadi anggota. Proses registrasi LokerForum mudah dan gratis. </p>
                        <a href="#">+ Read More</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div 
        </div> 
        <div class="row">
            <div class="col-sm-4">
                <h3>Dunia Kerja</h3>
                <p class="bg-primary">This text is important.</p>
                <p class="bg-success">This text indicates success.</p>
                <p class="bg-info">This text represents some information.</p>
                <p class="bg-warning">This text represents a warning.</p>
                <p class="bg-danger">This text represents danger.</p>
            </div>
            <div class="col-sm-4">
                <h3>Perusahaan</h3>
                <p class="bg-primary">This text is important.</p>
                <p class="bg-success">This text indicates success.</p>
                <p class="bg-info">This text represents some information.</p>
                <p class="bg-warning">This text represents a warning.</p>
                <p class="bg-danger">This text represents danger.</p>
            </div>
            <div class="col-sm-4">
                <h3>Training Center</h3>        
                <p class="bg-primary">This text is important.</p>
                <p class="bg-success">This text indicates success.</p>
                <p class="bg-info">This text represents some information.</p>
                <p class="bg-warning">This text represents a warning.</p>
                <p class="bg-danger">This text represents danger.</p>
            </div>

        </div>

    </div>



</body>
</html>