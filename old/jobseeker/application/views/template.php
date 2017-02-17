<html>
    <head>
        <title>Kursus Kerja</title>
        <meta charset="utf-8">
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min"></script>--> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script> 
  <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-modal.js"></script>
        
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
        <!--webfont-->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <script src="<?php echo base_url(); ?>js/responsiveslides.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.6.custom.min.js"></script>
       
        <script>
            $(function() {
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
        <!-- header-section-starts -->
        <div class="header">
            <?php echo $judul; ?> 
        </div>
        <div class="middle-row">
            <?php echo $isi; ?>
        </div>
        <div class="footer text-center">
            <div class="copyright">
                <p>Copyright &copy; 2015 All rights reserved || Mercubuana</a></p>
            </div>
        </div>

    </body>
</html>