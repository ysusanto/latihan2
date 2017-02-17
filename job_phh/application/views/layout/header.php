<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Bootstrap Styles -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css" media="screen">
    <!-- Awesome Icons Styles -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css" media="screen">
    <!-- Awesome Icons Styles -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/et-line.css" media="screen">
    <!-- Css Styles -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/style-portfolio.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/pro-bars.min.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css//animate.min.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css//rotator.css" media="screen">
    <!-- Google Font Styles -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat+Subrayada:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
 <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
     <!--Support for HTML5--> 
    <!--[if lt IE 9]>-->
    <!--<script src="js/html5shiv.js"></script>-->
    <!--<![endif]-->

     <!--Enable media queries on older bgeneral_rowsers--> 
    <!--[if lt IE 9]>-->
    <!--<script src="js/respond.min.js"></script>--> 
    <!--<![endif]-->

</head>
<body id="custom">

    <div class="animationload">
    <div class="loader">Loading...</div>
    </div>

    <div class="makeborder-top"></div>
    <div class="makeborder-bottom"></div>
    <div class="makeborder-left"></div>
    <div class="makeborder-right"></div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="searchform" role="form">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <input type="text" class="form-control" placeholder="What you are looking for?">
                </form>
            </div>
        </div>
    </div>

    <div id="wrapper">
        <div class="container">
            <header id="Home" class="header">
                <div class="menu-wrapper">
                    <nav id="navigation" class="navbar navbar-default" role="navigation">
                        <div class="navbar-inner">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-bars fa-2x"></i>
                                </button>
                                <a id="brand" class="navbar-brand" href="index.html"> <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Law"></a>
                            </div>
                            <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                                    <li><a href="<?php echo base_url(); ?>" >Home</a></li>
                                    <li><a href="<?php echo base_url(); ?>berita" ">Practice Area</a></li>
                                    <!--<li><a href="#faq" title="">FAQ</a></li>-->
                                    <!--<li><a href="#Case_Area" title="Case Area">Case Area</a></li>-->
                                    <li><a href="#team" >Lawyers</a></li>
                                    <li><a href="#contact" >Contact</a></li>
                                </ul>
                            </div><!-- end navbar-collapse collapse -->
                        </div><!-- nav -->
                    </nav><!-- end navigation -->
                </div><!-- menu wrapper -->
            </header><!-- end header -->
        </div><!-- end container -->
        <div id="page_header">
            <div id="parallax" class="parallax bgback bg" style="background-image: url('<?php echo base_url(); ?>assets/images/beground.jpg');" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20"></div>


            <div class="container text-center header-part">
                <h2 class="header-text">For <span class="rotate">A, A </span> Wis  <span class="rotate"> Solution, Solution </span></h2>

                <div class="angle-down">
                    <a href="#Practice_Area">
                      <i class="fa fa-angle-double-down fa-4x wow animated fadeInDown" data-wow-iteration="infinite" ></i>
                    </a>
                </div>
            </div>
        </div><!-- end page_header -->
   </div>
    </div>

            <!-- Main Scripts-->
            <script src="<?php echo base_url(); ?>js/jquery.js"></script>
            <script src="<?php echo base_url(); ?>js/bootstrap.js"></script>
            <script src="<?php echo base_url(); ?>js/custom.js"></script>
            <script src="<?php echo base_url(); ?>js/jquery.nav.js"></script>
            <script src="<?php echo base_url(); ?>js/wow.min.js"></script>
            <script src="<?php echo base_url(); ?>js/rotator.js"></script>

   <!-- Load google maps api and call initializeMap function defined in app.js -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;callback=initializeMap"></script>
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
            <script type="text/javascript">
                          $('a').click(function(){
                        $('html, body').animate({
                            scrollTop: $( $.attr(this, 'href') ).offset().top
                        }, 500);
                        return false;
                    });
            </script>
            <script>
                $(document).ready(function() {
                  $('#nav').onePageNav();

                  $('.do').click(function(e) {
                    $('#section-4').append('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');
                    e.preventDefault();
                  });
                });
            </script>
            <script type="text/javascript">$(document).on('click', '.panel-heading span.clickable', function (e) {
                var $this = $(this);
                if (!$this.hasClass('panel-collapsed')) {
                    $this.parents('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                } else {
                    $this.parents('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                }
            });
            $(document).on('click', '.panel div.clickable', function (e) {
                var $this = $(this);
                if (!$this.hasClass('panel-collapsed')) {
                    $this.parents('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                } else {
                    $this.parents('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                }
            });
            $(document).ready(function () {
                $('.panel-heading span.clickable').click();
                $('.panel div.clickable').click();
            });
        </script>
        <script>
            new WOW().init();
        </script>
        <script type="text/javascript">
            $(".rotate").textrotator({
            animation: "flip", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
            separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
            speed: 3000 // How many milliseconds until the next word show.
            });
        </script>
        <script type="text/javascript">
          // Close the navbar if collapsed (small screen) when clicking on a menu link
          // From edit 2 on
//           http://stackoverflow.com/questions/14203279/bootstrap-close-responsive-menu-on-click/23171593#23171593
          $(function () {
            $('.navbar-collapse ul li a:not(.dropdown-toggle)').bind('click touchstart', function () {
              $('.navbar-toggle:visible').click();
            });
          });
        </script>
</body>
</html>
