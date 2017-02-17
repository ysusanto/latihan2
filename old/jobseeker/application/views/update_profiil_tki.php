
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/flexslider.css" type="text/css" media="screen" />

<link type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-1.8.6.custom.css" rel="stylesheet" />	

 <!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.6.custom.min.js"></script>-->


<!--jquarydatepicket-->
<script>
    $(document).ready(function () {
        $(".editpribadi").hide();
    });
</script>
<div class="container">
    <div id='head' style='margin-bottom: 20px'><h1>PROFILE PENCARI KERJA</h1></div>
    <div id="viewprofile"></div>
    <div id='data-form'>
        <form action="<?php echo base_url(); ?>profile/update_tki" id="udpdateprofileform" runat="server">
            <div class="row" id="datapribadi">
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">

                        <!--<label  for="exampleInputEmail1">User Id :</label>-->
                        <?php // echo 'User id database'; ?>
                    </div>
                    <div class="form-group">
                        <div class="viewpribadi">
                            <label for="exampleInputPassword1">Nama :</label>

                            <?php
                            if (isset($profile)) {
                                $x = $profile['nama'];
                            } else {
                                $x = '';
                            }
                            echo $x;
                            ?>
                        </div>
                        <div class="editpribadi">
                            <input type="text" class="form-control" id="inputNama" placeholder="Nama" >
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="viewpribadi">
                            <label for="exampleInputPassword1">Alamat :</label>

                            <?php
                            if (isset($profile)) {
                                $x = $profile['alamat'];
                            } else {
                                $x = '';
                            }
                            echo $x;
                            ?>
                        </div>
                        <div class="editpribadi">
                            <textarea class="form-control" id="inputAlamat" placeholder="Alamat" ></textarea>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="viewpribadi">
                            <label for="exampleInputPassword1">Tempat, Tanggal Lahir : </label>
                            <?php
                            if (isset($profile)) {
                                $x = $profile['ttl'];
                            } else {
                                $x = '';
                            }
                            echo $x;
                            ?>
                        </div>

                    </div>

                    <div class="form-inline" >
                        <div class="editpribadi">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputTmpLahir" placeholder="Tempat Lahir">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputTglLahir" placeholder="Tanggal Lahir (dd/mm/yyyy)">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-6 col-md-4">
                    <div class="viewpribadi">
                        <?php
                        if (isset($profile)) {
                            $x = $profile['image'];
                        } else {
                            $x = '';
                        }
                        ?>
                        <img class="img-responsive" style=" width: 200px" id="userimageview" src="<?php echo $x; ?>" alt="image">
                    </div>
                    <div class="editpribadi">
                        <label for="exampleInputFile">Uploud Foto</label>
                        <input type="file" id="itemimage">
                        <!--<a href="#" >-->
                        <img class="img-responsive" style=" width: 100px" id="itemimagepreview" src="#" alt="image">
                    </div>
                    <!--</a>-->
                </div>

                <div class="col-xs-6 col-md-4">
                    <div class="viewpribadi">
                        <a href="#" onclick="editpribadi()">edit data pribadi</a>
                    </div>
                    <div class="editpribadi">

                        <button class="btn-default" id="savepribadi" type="submit" onclick="savepribadi()">Save</button>
                    </div>
                    <!--</a>-->
                </div>
                <!--                    <div class="col-xs-6 col-md-4"></div>
                                    <div class="imgprofil" >
                                        
                                        <img src="<?php echo base_url(); ?>assets/images/man.jpg" class="img-responsive" alt="Responsive image">
                                    </div>
                -->                </div>


            <br>
            <div class="modal-footer"></div>
            <h4>  <label for="exampleInputName2">PENDIDIKAN TERAKHIR</label></h4>
            <br>
            <div class="row">

                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <label for="exampleInputName2" style="size: 100%">FORMAL</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="FORMAL">
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <label for="exampleInputName2" style="size: 100%">JURUSAN </label>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="JURUSAN">
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <label for="exampleInputName2" style="size: 100%">LULUS </label>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="LULUS">
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <label for="exampleInputName2" style="size: 100%">INFORMAL</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="INFORMAL">
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <label for="exampleInputName2" style="size: 100%">JURUSAN </label>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="JURUSAN">
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <label for="exampleInputName2" style="size: 100%">LULUS </label>
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="LULUS">
                    </div>
                </div>
            </div>

            <br>
            <div class="modal-footer"></div>
            <h4>  <label for="exampleInputName2">PENGALAMAN KERJA</label></h4>
            <br>
            <div class="modal-footer"></div>
            <h4>  <label for="exampleInputName2">Perusahaan</label></h4>
            <br>

            <div class="row">

                <div class="col-xs-6 col-md-4">  <div class="form-group">

                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Masa Kerja">
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">

                        <input type="text" class="form-control" id="tanggalmasuk" name="tgl" onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Tangal Masuk';
                                }">
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">

                        <input type="text" class="form-control" id="tanggalkeluar" name="tgl" onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Tangal Keluar';
                                }">
                        <input type="checkbox"> Masih Bekerja...
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">

                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Posisi">
                    </div>
                </div>
            </div>

            <h4>  <label for="exampleInputName2">KEAHLIAN</label></h4>
            <br>
            <div class="row">
                <div class="col-xs-6 col-md-4">  <div class="form-group">

                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Input Keahlian">
                    </div>
                </div>
            </div>
            <h4>  <label for="exampleInputName2">POSISI YANG DIMINATI</label></h4>
            <br>
            <div class="row">
                <div class="col-xs-6 col-md-4">  <div class="form-group">
                        <select class="form-control">
                            <option>Industri</option>
                            <option>1. Kurasa aja</option>
                            <option>2.suka suka</option>
                            <option>3. Gimana Nih</option>
                            <option>4. Cobain Dong</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-md-4">  <div class="form-group">

                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Jabatan">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">UPLOAD DOKUMEN</label>
                <input  type="file" id="exampleInputFile">
                <p class="help-block">Example block-level help text here.</p>
            </div>
            <button type="submit" class="btn btn-default" onclick='do_register()'>Submit</button>
        </form>
    </div>



</div>
<script type="text/javascript">
//    jQuery(function ($) {
//        $.datepicker.regional['vi'] = {
//            closeText: 'Tutup',
//            prevText: 'Sebelum',
//            nextText: 'Sesudah',
//            currentText: 'Sekarang',
//            monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
//                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
//            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
//                'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
//            dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&acute;at', 'Sabtu'],
//            dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sbt'],
//            dayNamesMin: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
//            dateFormat: 'dd-mm-yy',
//            firstDay: 0,
//            isRTL: false,
//            showMonthAfterYear: false,
//            changeMonth: true,
//            changeYear: true,
//            yearSuffix: ''};
//        $.datepicker.setDefaults($.datepicker.regional['vi']);
//        $(function () {
//            $('#tanggalmasuk').datepicker({
//                inline: true
//            });
//            $('#tanggalkeluar').datepicker({
//                inline: true
//            });
//        });
//    });
    function editpribadi() {
        $('#editpribadi').show();
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#itemimagepreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#itemimage").change(function () {
        readURL(this);
    });
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        dataType: 'json'
    };

    $('#udpdateprofileform').ajaxForm(options);

</script>