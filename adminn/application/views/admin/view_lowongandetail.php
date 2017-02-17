<?php $this->load->view('admin/header'); ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8" style="border-left: 1px gray solid;">
        <div class="judulimg">
            <h3><?php echo $jobs["title"]; ?></h3>
        </div>
        <div id='desc'>
            <h5>Deskripsi</h5>
            <p class="text-justify"><?php echo $jobs["description"]; ?></p>

        </div>
        <div id='detail'>
            <div class="judulimg">
                <!--<h4>Detail Perusahaan</h4>-->
            </div>
            <!--<div class='row'>-->
            <dl class="dl-horizontal">
                <dt><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span></dt>
                <dd><?php echo $jobs['experience'] . "(" . $jobs['level'] . ")"; ?></dd>

                <dt><span class="glyphicon glyphicon-education" aria-hidden="true"></span></dt>
                <dd><?php echo $jobs['education']; ?></dd>

                <dt><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></dt>
                <dd><?php echo $jobs['benefits']; ?></dd>

                <dt><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></dt>
                <dd><?php echo $jobs['work_location']; ?></dd>
            </dl>

            <!--</div>-->
        </div>

    </div>
    <div class="col-xs-6 col-md-4" style="border-right: 1px;">
        <div class="judulimg">
            <h4><?php echo $jobs['company_name']; ?></h4>
        </div>

        <div id='detail'>
<!--            <div class="judulimg">
                <h4>Detail Perusahaan</h4>
            </div>-->
            <!--<div class='row'>-->
            <dl >
                <dt>Industri :</dt>
                <dd><?php echo $jobs['industry']; ?></dd>

                <dt>Website :</dt>
                <dd><a href="<?php echo $jobs['website']; ?>"><?php echo $jobs['website']; ?></a></dd>

                <dt>Telp :</dt>
                <dd><?php echo $jobs['phone']; ?></dd>

                <dt>Alamat :</dt>
                <dd><?php echo $jobs['address'] . " " . $jobs['location']; ?></dd>


            </dl>
            <div id='desc'>
                <h5>Tentang Perusahaan</h5>
                <p class="text-justify"><?php echo $jobs["company_desc"]; ?></p>

            </div>
            <!--</div>-->
        </div>
    </div>

</div>
<?php $this->load->view('admin/footer'); ?>
