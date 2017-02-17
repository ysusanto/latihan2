<?php $this->load->view('admin/header'); ?>
<div class="row">
    <div class="col-xs-6 col-md-4" style="border-right: 1px;">
        <div class="judulimg">
            <h4>Foto Profil</h4>
        </div>
        <div id="image" style="text-align: center;">
            <img src="<?php echo $profile['pribadi']['logo']; ?>" alt="" class="img-circle img-thumbnail" width="200" height="200">
        </div>

    </div>
    <div class="col-xs-12 col-sm-6 col-md-8" style="border-left: 1px gray solid;">
        <div id="dtpribadi">
            <div class="judulimg">
                <h3>Data Pribadi</h3>
            </div>
            <div class="row">
                <div class="col-xs-6"><label for="nama">Nama Lengkap</label></div>
                <div class="col-xs-6">: <?php echo $profile['pribadi']['firstname'] . " " . $profile['pribadi']['lastname']; ?></div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label for="nama">Tanggal Lahir</label></div>
                <div class="col-xs-6">: <?php echo date('d-m-Y', strtotime($profile['pribadi']['dob'])); ?></div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label for="nama">No. Telepon</label></div>
                <div class="col-xs-6">: <?php echo $profile['pribadi']['phone']; ?></div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label for="nama">Email</label></div>
                <div class="col-xs-6">: <?php echo $profile['pribadi']['email']; ?></div>
            </div>
            <div class="row">
                <div class="col-xs-6"><label for="nama">Alamat</label></div>
                <div class="col-xs-6">: <?php echo $profile['pribadi']['location']; ?></div>
            </div>
        </div>
        <div id="pendidikan">
            <div class="judulimg">
                <h3>Pendidikan</h3>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-md-3"style='padding-left: 30px'><?php if($profile['edukasi']!=''){ echo $profile['edukasi']['education'];}else{echo '';} ?></div>
                    <div class="col-md-9">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9" id='dataedukasi'>
                        <?php if($profile['edukasi']!=''){?>
                        <div class="judulimg">
                            <h4><?php echo $profile['edukasi']['institute'] ; ?></h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Jurusan</label></div>
                            <div class="col-xs-6">: <?php echo $profile['edukasi']['department'] ; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Nilai Akhir / IPK</label></div>
                            <div class="col-xs-6">: <?php echo $profile['edukasi']['final_score']; ?></div>
                        </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
        <div id="experiens">
            <div class="judulimg">
                <h3>Pengalaman Kerja</h3>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-md-3"style='padding-left: 30px'><?php if($profile['exp']!=''){ echo $profile['exp']['work'];}else{echo '';} ?></div>
                    <div class="col-md-9">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9" id='dataedukasi'>
                        <?php if($profile['exp']!=''){?>
                        <div class="judulimg">
                            <h4><?php echo $profile['exp']['position'] ; ?></h4>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Nama Perusahaan</label></div>
                            <div class="col-xs-6">: <?php echo $profile['exp']['company'] ; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Industri</label></div>
                            <div class="col-xs-6">: <?php echo $profile['exp']['industry']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Spesialisasi</label></div>
                            <div class="col-xs-6">: <?php echo $profile['exp']['specialization']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Lokasi</label></div>
                            <div class="col-xs-6">: <?php echo $profile['exp']['location']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"><label for="nama">Gaji Bulanan</label></div>
                            <div class="col-xs-6">: Rp. <?php echo $profile['exp']['salary']; ?></div>
                        </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
<?php $this->load->view('admin/footer'); ?>
