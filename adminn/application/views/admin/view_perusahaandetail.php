<?php $this->load->view('admin/header'); ?>
<div class="row">
    <div class="col-xs-6 col-md-4" style="border-right: 1px;">
        <div class="judulimg">
            <h4>Logo Perusahaan</h4>
        </div>
        <div id="image" style="text-align: center;">
            <img src="<?php echo $profile['logo']; ?>" alt="" class="img-circle img-thumbnail" width="200" height="200">
        </div>
        <div id='detail'>
            <div class="judulimg">
                <h4>Detail Perusahaan</h4>
            </div>
            <!--<div class='row'>-->
                <dl class="dl-horizontal">
                    <dt>Industri :</dt>
                    <dd><?php echo $profile['industry']; ?></dd>

                    <dt>Website :</dt>
                    <dd><a href="<?php echo $profile['website']; ?>"><?php echo $profile['website']; ?></a></dd>
                    
                    <dt>Telp :</dt>
                    <dd><?php echo $profile['phone']; ?></dd>

                    <dt>Alamat :</dt>
                    <dd><?php echo $profile['address']; ?></dd>

                    <dt>Lokasi :</dt>
                    <dd><?php echo $profile['location']; ?></dd>
                </dl>

            <!--</div>-->
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-8" style="border-left: 1px gray solid;">
        <div class="judulimg">
            <h3><?php echo $profile['nama'] ?></h3>
        </div>
        <div id='desc'>
            <h5>Tentang Perusahaan</h5>
            <p class="text-justify"><?php echo $profile['description']; ?></p>

        </div>

    </div>
</div>
<?php $this->load->view('admin/footer'); ?>
