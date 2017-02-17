<?php
session_start();
header('Cache-control: private');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once "connection/conn.php";

if (isset($_GET['logout'])) {
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    $_SESSION = array();
    session_unset();
    session_destroy();

    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- META -->
        <meta charset="utf-8">
        <meta name="author" content="web dev">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <link rel="stylesheet" type="text/css" href="css/pajinate.css" />
        <link rel="stylesheet" type="text/css" href="css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="css/slider.css" />

        <!-- JAVASCRIPT -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/pajinate.js"></script>
        <script src="js/datetimepicker.js"></script>
        <script src="js/jquery.slides.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- TITLE -->
        <title>KursusKerja.com</title>

        <script>
            $(document).ready(function () {
                $('div.li-child').hide();
                $('.toggle').click(function () {
                    $('.toggle').next().hide();
                    $(this).next().fadeIn();
                });

                $('#slides').slidesjs({
                    width: 1350,
                    height: 460,
                    play: {
                        active: true,
                        auto: true,
                        interval: 4000,
                        swap: true
                    }
                });
            });
        </script>
    </head>
    <body >
        <nav class="navbar navbar-default navbar-fixed-top" style="background: rgba(248, 248, 248, 0.79)">
            <div class="container">
                <div class="navbar-header" > 
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a href="index.php"><img src="img/animasi-logo.gif" width="150" /></a>-->
                    <a class="navbar-brand" style="padding-top:7px;"  href="index.php"><img src="img/animasi-logo.gif" style='height: 48px' /></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar" > 
                    <ul class="nav navbar-nav">
                        <?php
                        if ($_SESSION["training_id"] != null) {
                            echo "<li><a href='training/index.php?page=profile'>Beranda</a></li>";
                            echo "<li><a href='?page=job'>Lowongan</a></li>";
                            echo "<li><a href='?logout'>Logout</a></li>";
                        }
                        if ($_SESSION["company_id"] != null) {
                            echo "<li><a href='employer/index.php?page=profile'>Beranda</a></li>";
                            echo "<li><a href='?page=job'>Lowongan</a></li>";
                            echo "<li><a href='?logout'>Logout</a></li>";
                        } else if ($_SESSION["seeker_id"] == null) {
                            echo "<li><a href='index.php'>Beranda</a></li>";
                            echo "<li><a href='?page=job'>Lowongan</a></li>";
                            echo "<li><a href='?page=login'>Login</a></li>";
//					echo '<li><a href="#" class="toggle">Login</a>
//						<div class="li-child">
//							<ul>
//								<li><a href="?page=login">Pencari Kerja</a></li>
//								<li><a href="employer/?page=login">Perusahaan</a></li>
//								<li><a href="training/?page=login">Tempat Kursus</a></li>
//							</ul>
//						</div>
//					</li>';  
                            //echo "<li><a href='?page=register'>Daftar</a></li>";
                            echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Daftar<span class="caret"></span></a>
          <ul class="dropdown-menu">
								<li><a href="?page=register">Pencari Kerja</a></li>
								<li><a href="employer/?page=register">Perusahaan</a></li>
								<li><a href="training/?page=register">Tempat Kursus</a></li>
							</ul>
						
					</li>';
                        } else {
                            echo "<li><a href='index.php'>Beranda</a></li>";
                            echo "<li><a href='?page=job'>Lowongan</a></li>";
                            echo "<li><a href='?page=interview'>Wawancara</a></li>";
                            echo "<li><a href='?page=profile'>Profil</a></li>";
                            echo "<li><a href='?logout'>Logout</a></li>";
                        }
                        ?>
                    </ul>
<!--                    <div class="navbar-right">
                        <div style="height:20px;margin-top:15px;margin-right:15px;">
                            <?php
//                            $x = '';
//                            if (isset($username)) {
//                                $x .= '<span style="font-size:14px;font-weight:bold;">' . $username . '&nbsp;</span><a href="' . base_url('admin/logout') . '">(logout)</a>';
//                            }
//                            echo $x;
//                            
                            ?>
                        </div>
                    </div>-->
                </div>

            </div>
        </nav>
