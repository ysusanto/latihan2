<?php
//require_once "../connection/conn.php";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if ($_POST["sbtRegister"]) {
//        $password = sha1($_POST["txtPassword"]);
//        $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
//        //$logo = file_get_contents($_FILES['logo']['tmp_name']);
//        date_default_timezone_set('Asia/Jakarta');
//        $tanggal = date('Y-m-d H:i:s');
//        $username = $_SESSION["username"];
//        $sql = "INSERT INTO tb_company (email,password,company_name,company_logo,
//										description,address,industry_id,location_id,post_code,
//										phone,fax,website,contact_person,create_by,create_date,modified_by,modified_date) 
//				VALUES ('{$_POST['txtEmail']}',
//						'{$password}',
//						'{$_POST['txtName']}',
//						'{$logo}',
//						'{$_POST['txtDescription']}',
//						'{$_POST['txtAddress']}',
//						'{$_POST['selIndustry']}',
//						'{$_POST['selLocation']}',
//						'{$_POST['txtPostCode']}',
//						'{$_POST['txtPhone']}',
//						'{$_POST['txtFax']}',
//						'{$_POST['txtWebsite']}',
//						'{$_POST['txtCP']}',
//						'{$username}',
//						'{$tanggal}',
//						'{$username}',
//						'{$tanggal}')";
//
//        $insert = mysql_query($sql);
//
//
//        // untuk mengirim keterangan pendaftaran ke email
//        /*
//          $message = "Kepada Yth. {$_POST['txtName']}, <br /><br />
//          Untuk mengaktifkan akun Anda, silahkan lakukan pembayaran untuk Akun yang Anda daftarkan degan rincian sebagai berikut : <br /><br />
//          - Paket Valid : {$row['month']} Bulan <br />
//          - Maksimum Lowongan : {$row['job']} <br />
//          - Harga + ppn 10% : Rp. {$price},-<br /><br />
//          Silahkan tansfer ke Akun : <br />
//          - Bank : Mandiri <br />
//          - No. Rek : 123-00-0000123-99-0 <br />
//          - Atas Nama : Cari Kerja dot com <br /><br />
//          Terima Kasih.";
//
//          $to = $_POST['txtEmail'];
//          $subject = "Selamat datang di CariKerja";
//          $message = $message;
//          $headers = "From: admin@carikerja.com";
//
//          mail($to, $subject, $message, $headers); */
//
//        if ($insert == true) {
//            echo "<script type='text/javascript'>
//					alert('Terima kasih telah mendaftar. Silahkan cek email Anda.');
//					window.location.reload();
//				 </script>";
//        } else {
//            echo "<script type='text/javascript'>alert('Maaf, pendaftaran gagal.');</script>";
//        }
//    }
//}
?>
<div class="modal fade" id="addperusahaanModal" tabindex="-1" role="dialog" aria-labelledby="addperusahaanModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #337ab7;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#fff">Tambah Perusahaan</h4>
            </div>
            <div class="modal-body" style="min-height:300px;">
                <div id="formregis">
                    <form class="form-register" id="registPerusahaanForm" action="<?php echo base_url('perusahaan/addperusahaan'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtName"><b>Nama Perusahaan *</b></label>
                            <input class="form-control w300" type="text" name="txtName" placeholder="Nama Perusahaan" required />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="logo"><b>Logo Perusahaan *</b></label>
                            <input class="w300" type="file" id="logoimg" name="logo" required/>
                            <div class="help-block with-errors"></div>
                            <div id="previewimg"><img id="logopreview" src="" alt="" class="img-rounded" width="50"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtDescription"><b>Tentang Perusahaan *</b></label>
                            <textarea name="txtDescription" class="textarea" id="descprusahaan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>                      
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="selIndustry"><b>Industri *</b></label>
                            <select class="form-control w150" name="selIndustry">
                                <?php
                                if (isset($industri)) {
                                    foreach ($industri as $a) {
                                        echo $a;
                                    }
                                }
//                                $industry = mysql_query("SELECT industry_id, industry FROM tb_industry");
//                                while ($row = mysql_fetch_array($industry)) {
//                                    echo "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
//                                }
                                ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtAddress"><b>Alamat Perusahaan *</b></label>
                            <textarea class="form-control" name="txtAddress" required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="selLocation"><b>Lokasi *</b></label>
                            <select class="form-control w150" name="selLocation">
                                <?php
                                if (isset($lokasi)) {
                                    foreach ($lokasi as $a) {
                                        echo $a;
                                    }
                                }
//                                $lokasi = mysql_query("SELECT location_id, location FROM tb_location");
//                                while ($row = mysql_fetch_array($lokasi)) {
//                                    echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
//                                }
                                ?>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtPostCode"><b>Kode Pos *</b></label>
                            <input class="form-control w100" type="number" name="txtPostCode" placeholder="Post Code" required />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtPhone"><b>Telepon *</b></label>
                            <input class="form-control w100" type="text" name="txtPhone" placeholder="Phone Number" required />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtFax"><b>Fax</b></label>
                            <input class="form-control w100" type="text" name="txtFax" placeholder="Fax" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtWebsite"><b>Website Perusahaan</b></label>
                            <input class="form-control w250" type="text" name="txtWebsite" placeholder="Website" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtCP"><b>Contact Person *</b></label>
                            <input class="form-control w250" type="text" name="txtCP" placeholder="Contact Persons" required/>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtEmail"><b>Email *</b></label>
                            <input class="form-control w200" type="email" name="txtEmail" placeholder="Email" required />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label formtext w160" for="txtPassword"><b>Password *</b></label>
                            <input class="form-control w200" type="password" name="txtPassword" placeholder="Password" required />
                            <div class="help-block with-errors"></div>
                        </div>



                        <!--                        <button class="btn btn-lg btn-primary btn-block" name="sbtRegister" type="submit" id="submitAdd">Register</button>
                                            </form>-->
                </div>

            </div>
            <div class="modal-footer" style="border-top: none;">
                <button class="btn btn-lg btn-primary btn-block" name="sbtRegister" type="submit" id="submitAdd">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(
            function ()
            {
                $('#descprusahaan').redactor();
            }
    );
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#logoimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logoimg").change(function () {
        readURL(this);
    });
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        dataType: 'json'
    };

    $('#registPerusahaanForm').ajaxForm(options);

    function showRequest(formData, jqForm, options) {
        $('#submitAdd').prop('disabled', true);
        return true;
    }

    function showResponse(data) {
        if (data.status == 1) {
            $('#registPerusahaanForm').resetForm();
            $('#logoimg').attr('src', '');
            $('#addperusahaanModal').modal('hide');
             $('#ok').show();
             $('#ok').text(data.msg);
//            alert(data.msg);
            viewperusahaan();
        }  else {
             $('#gagal').show();
             $('#gagal').text(data.msg);
//            alert(data.msg);
            $('#submitAdd').prop('disabled', false);
        }
    }
</script>