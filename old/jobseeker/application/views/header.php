<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <title>header</title>
        <meta charset="utf-8">

        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script> 
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-modal.js"></script>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"  />
                 <!--<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css"  />-->
        <style>

        </style>
        <script>
            $(document).ready(function () {
                $('#usermenu > li').bind('mouseover', openSubMenu);
                $('#usermenu > li').bind('mouseout', closeSubMenu);

                function openSubMenu() {
                    $(this).find('ul').css('visibility', 'visible');
                }
                ;

                function closeSubMenu() {
                    $(this).find('ul').css('visibility', 'hidden');
                }
                ;

            });
            function login() {
                var telp = $('#telp').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var email = $('#email').val();
                var alamat = $('#alamat').val();
                var status = $('#status').val();
                var kota = $('#kota').val();
                var nama = $('#nama').val();
                //                                         alert(telp);
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>registerlogin/cheklogin',
                    data: "username=" + username + "&password=" + password,
                    //                                            datatype : "JSON",
                    success: function (msg) {
//                        alert(msg);
                        if (msg == 'ok') {
//                            alert(msg);
//                            $.ajax({
//                    type: 'post',
//                    url: 'registerlogin/afterlogin',
////                    data: "username=" + username + "&password=" + password
//        });
                            location.replace("<?php echo base_url(); ?>registerlogin/afterlogin");


                        } else {
                            alert(msg);
                        }

                        //                                                if (detectmob() == true) {
                        //                                                    window.open(msg, '_blank');
                        //                                                }
                        //                                                $('#callback').show();
                        //                                                $('#inputan').hide();
                        ////                                                $('#s_periode1,#s_periode2,#fmonth').html(msg);
                        //                                                $('#s_periode1,#fmonth,#s_periode2').val(month);
                        //                                                viewReport(0);
                    }

                });
                //                                        $('#registerform').trigger('submit');
            }
            function logout() {
                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>registerlogin/logout',
//                    data: "username=" + username + "&password=" + password,
                    //                                            datatype : "JSON",
                    success: function (msg) {

                        if (msg == 'ok') {

                            window.location.reload();
                        } else {
                            alert(msg);
                        }
//                                             viewReport(0);
                    }

                });
            }
//            $('#dLabel').dropdown();
        </script>
    </head>

    <body>
        <div class="navigation-strip" >
            <div class="container">
                <div class="logo">
                    <a href="<?php echo base_url(); ?>"><h1>KURSUS KERJA</h1></a>
                </div>
                <script>

                </script>
                <div class="top-menu">
                    <span class="menu"> </span>
                    <ul>
                        <li><a  href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>tki">Profile</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>kursus">Kursus</a></li>-->
                        <li><a href="<?php echo base_url(); ?>pt">Perusahaan</a></li>
                        <li><a href="?page=tentang">Tentang</a></li>
                        <?php
                        if ($this->session->userdata('username') == TRUE) {
                            echo '<li role="presentation"  style="color:black;"><b><a href="' . base_url() . 'registerlogin/afterlogin">' . $this->session->userdata['username'] . '</a><a href="#" onclick="logout()">Logout</a></b></li>';
//                                echo '<li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
//                    User
//                    <b class="caret"></b>
//                    </a><ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="background-color: 01CDF2;" >
//                              <li role="presentation"  style="color:black;"><a role="menuitem"  tabindex="-1" href="' . base_url() . 'registerlogin/afterlogin">Detail User</a></li>
//                              <li role="presentation" style="color:black;"><a role="menuitem"  tabindex="-1" href="' . base_url() . 'registerlogin/afterlogin">Log Out</a></li></ul>';
//                                <a href="' . base_url() . 'registerlogin/afterlogin" >Detail<b>Selamat datang ' . $this->session->userdata('username') . '</b></a>
                        } else {
                            echo '<li ><div id="logininput" ><a href="' . base_url() . '" data-toggle="modal" class="modal-dialog" data-target="#myModal" >Login</a></div>';
                        }
                        ?></li>
                        <!--<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tutorials
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HTML</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">CSS</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">JavaScript</a></li>
                              <li role="presentation" class="divider"></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#">About Us</a></li>
                            </ul>
                          </div>-->
                    </ul>
                </div>


                <!-- Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Login</h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="username" class="form-control" id="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>

                                    <!--uploudphoto-->
                                    <!--  <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="exampleInputFile">
                                        <p class="help-block">Example block-level help text here.</p>
                                      </div>
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox"> Check me out
                                        </label>
                                      </div>
                                      <button type="submit" class="btn btn-default">Submit</button>-->
                                    <!--end uplouppoto-->

                            </div>
                            <div class="modal-footer">
                                <a href="<?php echo base_url(); ?>register" <button type="text" class="btn btn-default">Register</button></a>
                                <!--<a href="#" class="btn btn-default" data-dismiss="modal">Register</a>-->
                                <a href="#" class="btn btn-primary" onclick='login()'>Login</a>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                </form>
                <!--endmodal-->
            </div>

        </div>

        <script>
            $("span.menu").click(function () {
                $(".top-menu ul").slideToggle("slow", function () {
                });
            });
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            });

        </script>

    </body>
</html>
