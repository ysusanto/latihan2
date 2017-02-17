<script>
    function logout() {
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>registerlogin/logout',
//                    data: "username=" + username + "&password=" + password,
            //                                            datatype : "JSON",
            success: function(msg) {

                if (msg == 'ok') {
//                            var link= <?php echo base_url(); ?>
//                            $.ajax({
//                    type: 'post',
//                    url: '<?php echo base_url(); ?>registerlogin/afterlogin',
////                    data: "username=" + username + "&password=" + password
//        });
                    window.location.replace("<?php echo base_url();?>");
                } else {
                    alert(msg);
                }
//                                             viewReport(0);
            }

        });
    }
</script>
<nav class="navbar navbar-default navbar-fixed-top" style='background-color: #41403e;color: #fff;'>
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Kursus Kerja</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $x = '';
                if (isset($menu)) {


                    foreach ($menu as $m) {
                        $x.='<li><a  href="' . base_url() . 'home/' . $m['fungsi'] . '"><b>' . $m['nama'] . '</b></a></li>';
                    }
//                            <li><a href="?page=profil">Profil</a></li>
//                            <li><a href="?page=kursus">Kursus</a></li>
//                            <li><a href="?page=perusahaan">Perusahaan</a></li>
//                            <li><a href="?page=tentang">Tentang</a></li>
//                            <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
//                $x .='</ul>';
                }
                echo $x;
                ?>
              <!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                <!--<li><a href="#">Link</a></li>-->
                <!--        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                          </ul>
                        </li>-->
            </ul>
            <!--      <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>-->
            <p class="navbar-text navbar-right"><?php echo 'Selamat Datang ' . $this->session->userdata['nama'] . ' <a href="#" onclick="logout()" class="navbar-link">(logout)</a>'; ?></p>
                </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>