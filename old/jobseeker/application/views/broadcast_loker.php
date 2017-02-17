
<!--Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">

<script src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>

<script>
    // 
    $(document).ready(function () {
        $('#editAdd').hide();

        $('#tglvalid').datepicker({
            format: "dd/mm/yyyy"
        });

<?php if($status=='2'){
    
}?>
        
        <?php if($status=='3'){
    
}?>
    });
    function tampildetail() {
        $('#detail').show();


    }
    function do_broadcast() {
        var id_pt = '<?php echo $this->session->userdata['userid']; ?>';
        var judul = $('#judule').val();
        var bidang = $('#bidang').val();
        var kota = $('#kota').val();
        var tglvalid = $('#tglvalid').val();
//        var validakhir = $('#validakhir').val();
        var responsibility = $('responsibility').val();
        var softskill = $('#softskill').val();
        var benefit = $('#benefit').val();
        var informasi = $('#informasi').val();
        var hardskill = $('#hardskill').val();
        var careellevel = $('#careellevel').val();
        var qualification = $('#qualification').val();
        var industri = $('#industri').val();
        var salary = $('#salary').val();
        var jenispekerjaan = $('#jenispekerjaan').val();
        var statuspegawai = $('#statuspegawai').val();
        var tempatkursus = $('#tempatkursus').val();
        var kualitas = $('#kualitas').val();



//        var status = $('#status').val();
//        var kota = $('#kota').val();
//        var nama = $('#nama').val();
        alert(id_pt + ' ' + bidang + '' + kota + '' + tempatkursus);

        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>broadcastloker/loker',
            data: "judul=" + judul + "&bidang=" + bidang + "&kota=" + kota + "&tglvalid=" + tglvalid
                    + "&responsibility=" + responsibility
                    + "&softskill=" + softskill + "&benefit=" + benefit + "&informasi="
                    + informasi + "&hardskill=" + hardskill + "&careellevel=" + careellevel
                    + "&qualification=" + qualification + "&industri=" + industri + "&salary=" + salary
                    + "jenispekerjaan=" + jenispekerjaan + "&statuspegawai=" + statuspegawai
                    + "&tempatkursus=" + tempatkursus + "&kualitas=" + kualitas + "&id_pt=" + id_pt,
            success: function (msg) {
                alert(msg);
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

</script>

<!--<script type="text/javascript">
    // When the document is ready
    $(document).ready(function() {

    });
</script>-->
<div class="container">
    <div id="searchloker">
        <div class="form-group">
            <!--<label for="exampleInputEmail1">Email address</label>-->
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul Posisi...">
        </div>
        <div class="form-inline">
            <div class="form-group" style="width: 50%;">
                <!--<label for="exampleInputName2">Name</label>-->
                <select class="form-control" style="width: 95%;" id="industri" >
                     <?php
                            $b = '';
                            if (isset($industri)) {
                                foreach ($industri as $k) {
                                    $b.= "<option value='" . $k['id_industri'] . "'>" . $k['nama'] . "</option>
";
                                }
                            }
                            echo $b;
                            ?>

                </select>
                <!--<input type="text" style="width: 75%;" class="form-control" id="exampleInputName2" placeholder="Jane Doe">-->
            </div>
            <div class="form-group"style="width: 49%;" id="kota">
                <!--<label for="exampleInputEmail2">Email</label>-->
                <select class="form-control" style="width: 100%;">
                    <?php
                                $b = '';
                                if (isset($lokasi)) {
                                    foreach ($lokasi as $k) {
                                        $b.= "<option value='" . $k['id_kota'] . "'>" . $k['Nama'] . "</option>
";
                                    }
                                }
                                echo $b;
                                ?>

                </select>
                <!--<input type="email" style="width: 75%;"class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">-->
            </div>

        </div>
        <div id="btnsearch">
        <button type="submit" class="btn btn-default">Send invitation</button>
        </div>
    </div>
    <div id="resultloker"></div>
    <div id="viewlokerpt">
        <table class="display" cellspacing="0"  id="dtshop">
            
            <thead>
                <tr>
                    <!--<th width="15%">Unit</th>-->
                    <th >No.</th> 
                    <th >Nama Toko</th>        
                    <th >Alamat</th>
                    <!--<th >Description</th>-->
                    <th >Telp<br> (pemilik/toko)</th>
                    <th >Pemilik</th>
                    <th>Tanggal <br>Buat Toko</th>
                    <th >Detail <br>Item</th>
                    <th >Hapus</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!--<form>-->

    <div id="editAdd">
        <div class="form-group">
            <p>JUDUL LOWONGAN</p>
            <div class="col-sm-5">          
                <input type="text" id="judule" class="form-control"  placeholder="Input judul...">
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-md-4"> <div class="form-group">
                    <p>BIDANG</p>
                    <div class="col-sm-8">          
                        <div class="form-group">
                            <select class="form-control" id="bidang">
                                <option value='' selected >Bidang </option>
                                <?php
                                $b = '';
                                if (isset($bidang)) {
                                    foreach ($bidang as $k) {
                                        $b.= "<option value='" . $k['id_bidang'] . "'>" . $k['bidang_krj'] . "</option>
";
                                    }
                                }
                                echo $b;
                                ?>

                            </select>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4"> <div class="form-group">
                    <p>KOTA</p>
                    <div class="col-sm-8">          
                        <div class="form-group">
                            <select class="form-control" id="kota">
                                <option value='' selected >Kota</option>
                                <?php
                                $b = '';
                                if (isset($lokasi)) {
                                    foreach ($lokasi as $k) {
                                        $b.= "<option value='" . $k['id_kota'] . "'>" . $k['Nama'] . "</option>
";
                                    }
                                }
                                echo $b;
                                ?>


                            </select>
                        </div>
                    </div>
                </div></div>

        </div>

        <div class="form-group">
            <p>TGL. VALID</p>
            <div class="col-md-3"><input type="date" class="form-control" id="tglvalid"  onfocus="this.value = '';" onblur="if (this.value == '') {
                        this.value = 'Input Tanggal....';
                    }"></div>

        </div>
        <br><br>
        <div class="form-group">

            <p><h4>RINCIAN </h4></p>
            <div class="modal-footer"></div>

        </div>
        <div class="form-group">

            <p>Tanggung jawab</p>
            <div class="col-sm-5">          
                <textarea id="responsibility" class="form-control" rows="4" ></textarea>
            </div>
        </div>
        <div class="form-group">
            <br><br><br><br><br><br>
            <p><h4>Persyaratan Kusus</h4></p>
            <div class="modal-footer"></div>

        </div>

        <div class="col-md-4">
            <div class="form-group">

                <p>Keahlian Kusus</p>
                <div class="col-sm-15">          
                    <textarea id="softskill"class="form-control" rows="4" ></textarea>
                </div>
            </div></div>
        <div class="col-md-4">
            <div class="form-group">

                <p>MANFAAT</p>
                <div class="col-sm-15">          
                    <textarea id="benefit"class="form-control" rows="4" ></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="form-group">

                <p>Informasi</p>
                <div class="col-sm-15">          
                    <textarea id="informasi"class="form-control" rows="4" ></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="form-group">
                <p>Keahlian Umum</p>
                <div class="col-sm-8">          
                    <div class="form-group" >
                        <input type="text" id="hardskill" class="form-control"  placeholder="Input Hardskill...">
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br> <br><br><br><br><br><br>
        <div class="form-group">

            <p><h4>INFORMASI TAMBAHAN</h4></p>
            <div class="modal-footer"></div>

        </div>

        <div class="col-md-4">
            <div class="form-group">

                <p>Pekerjaan</p>
                <div class="col-sm-8">          
                    <div class="form-group">
                        <select class="form-control" id="careellevel">
                            <option>Pekerjaan</option>
                            <option>Pemula</option>
                            <option>Sedang</option>
                            <option>Perpengalaman</option>
                            <option>Mahir</option>
                        </select>
                    </div>
                </div>
            </div></div>
        <div class="col-md-4">
            <div class="form-group">

                <p>Kualifikasi</p>
                <div class="col-sm-8">          
                    <div class="form-group">
                        <select class="form-control" id="qualification">
                            <option>Kualifikasi</option>
                            <option>SMA/SMK</option>
                            <option>D3</option>
                            <option>S1</option>
                            <option>S2</option>
                            <option>S3</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <p>Industri</p>
                <div class="col-sm-8">          
                    <div class="form-group">
                        <select class="form-control" id="industri">
                            <option value='' selected >Industri</option>
                            <?php
                            $b = '';
                            if (isset($industri)) {
                                foreach ($industri as $k) {
                                    $b.= "<option value='" . $k['id_industri'] . "'>" . $k['nama'] . "</option>
";
                                }
                            }
                            echo $b;
                            ?>


                        </select>
                    </div>
                </div>
            </div></div>
        <div class="col-md-4"> 
            <div class="form-group">
                <p>Pendapatan</p>
                <div class="col-sm-6">          
                    <input type="text" class="form-control" id="salary" placeholder="Input salary...">
                </div>
            </div>
        </div>
        <div class="form-group">

            <p>Jenis Pekerjaan </p>
            <div class="col-sm-4">          
                <textarea  class="form-control" rows="4" id="jobfungsion"></textarea>
            </div>
        </div>
        <div class="form-group">

            <div class="col-sm-8"> 
                <div class="form-group">
                    <p>STATUS PEGAWAI</p>
                    <label class="checkbox-inline" id="statuspegawai" >
                        <input type="checkbox" value="">  Sementara
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="">  Kontrak
                    </label>
                    <label class="checkbox-inline">
                        <input type="checkbox" value="">  Permanen
                    </label>

                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br>
        <div class="form-group">

            <p><h4>VOTING Tempat Kursus</h4></p>
            <div class="modal-footer"></div>

        </div>

        <div class="col-md-4">
            <div class="form-group">

                <p>TEMPAT KURSUS</p>
                <div class="col-sm-8">          
                    <div class="form-group">
                        <select class="form-control" id="tempatkursus">
                            <option value='' selected >Tempat Kursus</option>
                            <?php
                            $b = '';
                            if (isset($tempatkursus)) {
                                foreach ($tempatkursus as $k) {
                                    $b.= "<option value='" . $k['id_user'] . "'>" . $k['nama'] . "</option>
";
                                }
                            }
                            echo $b;
                            ?>

                        </select>
                    </div>
                </div>
            </div></div>
        <div class="col-md-4">
            <div class="form-group">

                <p>KUALITAS</p>
                <div class="col-sm-8">          
                    <div class="form-group">
                        <select class="form-control" id="kualitas">
                            <option>Kualitas</option>
                            <option>Baik</option>
                            <option>Buruk</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
        <div class="modal-footer"></div>
        <button type="submit" class="btn btn-default" onclick='do_broadcast()'>Submit</button>
        <!--    </form>-->
    </div>
</div>
