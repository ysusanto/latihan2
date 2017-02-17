<html>
    <head>
        <meta charset="UTF-8">
        <title>Kursus Kerja</title>
        <!--<meta charset="utf-8">-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- bootstrap 3.0.2 -->
        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/dataTable/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/validator.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.js"></script>
        <script type="text/javascript"src="<?php echo base_url(); ?>js/redactor.js"></script>

        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>  
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datatables.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.theme.min.css" />
        <!--<link rel="stylesheet" type="text/css" href="css/jquery-te-1.4.0.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/redactor.css" />
        <!--<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/job.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/kurker.css" />
        <!-- Theme style -->

        <link href="<?php echo base_url(); ?>js/dataTable/css/jquery.dataTables.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>css/sb-admin-2.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script>
            $(document).ready(function () {
//        alert('1234');

         $('[data-toggle="tooltip"]').tooltip();

    });
    </script>
    </head>
    <body >
        <div id="wrapper">
            <!-- header logo: style can be found in header.less -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Kursus Kerja</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">


                    <!-- /.dropdown -->

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo $username; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
<!--                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>-->
                            
                            <li><a href="<?php echo base_url(); ?>admin/logout"> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="index.html"> Dashboard</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>admin/viewuser">User</a></li>		
                            <li><a href="<?php echo base_url(); ?>admin/viewlowongan">Lowongan Kerja</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/viewpekerja">Pencari Kerja</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/viewperusahaan">Perusahaan</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/viewkursus">Tempat Kursus</a></li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>


            <!-- Right side column. Contains the navbar and content of the page -->
            <div id="page-wrapper" style="margin-bottom: 30px;margin-top:50px;">
                <div class="row">