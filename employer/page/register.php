<?php
require_once "../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["sbtRegister"]) {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $password = sha1($_POST["txtPassword"]);
        $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
        //$logo = file_get_contents($_FILES['logo']['tmp_name']);

        $sql = "INSERT INTO tb_company (email,password,company_name,company_logo,
										description,address,industry_id,location_id,post_code,
										phone,fax,website,contact_person,create_date,modified_date) 
				VALUES ('{$_POST['txtEmail']}',
						'{$password}',
						'{$_POST['txtName']}',
						'{$logo}',
						'{$_POST['txtDescription']}',
						'{$_POST['txtAddress']}',
						'{$_POST['selIndustry']}',
						'{$_POST['selLocation']}',
						'{$_POST['txtPostCode']}',
						'{$_POST['txtPhone']}',
						'{$_POST['txtFax']}',
						'{$_POST['txtWebsite']}',
						'{$tgl}',
                                                '{$tgl}')";

        $insert = mysql_query($sql);
        $sql2 = "select company_id from tb_company where email='" . $_POST['txtEmail'] . "'";

        $select = mysql_query($sql2);
        $row = mysql_fetch_assoc($select);

        // untuk mengirim keterangan pendaftaran ke email
        /*
          $message = "Kepada Yth. {$_POST['txtName']}, <br /><br />
          Untuk mengaktifkan akun Anda, silahkan lakukan pembayaran untuk Akun yang Anda daftarkan degan rincian sebagai berikut : <br /><br />
          - Paket Valid : {$row['month']} Bulan <br />
          - Maksimum Lowongan : {$row['job']} <br />
          - Harga + ppn 10% : Rp. {$price},-<br /><br />
          Silahkan tansfer ke Akun : <br />
          - Bank : Mandiri <br />
          - No. Rek : 123-00-0000123-99-0 <br />
          - Atas Nama : Cari Kerja dot com <br /><br />
          Terima Kasih.";

          $to = $_POST['txtEmail'];
          $subject = "Selamat datang di CariKerja";
          $message = $message;
          $headers = "From: admin@carikerja.com";

          mail($to, $subject, $message, $headers); */
        $message = "Kepada Yth. ucfirst({$_POST['txtName']}), <br /><br />
					Terima kasih telah mendaftar di kursuskerja.com. Email yang anda gunakan adalah <br />
					Email : {$_POST['txtEmail']} <br />
					Silahkan konfirmasi email anda dengan klik link di bawah ini <br/>
                                     http://kursuskerja.com/?page=confirm&q=2&id=" . $row['company_id'] . " <br />
					Terima Kasih. <br/><br/>
                                        
Regards. <br /><br />
kursuskerja.com";

        $to = $_POST['txtEmail'];
        $subject = "Konfirmasi Email";
        $message = $message;
        $headers = "From: noreply@kursuskerja.com";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $message, $headers);
        if ($insert == true) {
            echo "<script type='text/javascript'>
					alert('Terima kasih telah mendaftar. Silahkan cek email Anda.');
					window.location='index.php';
				 </script>";
        } else {
            echo "<script type='text/javascript'>alert('Maaf, pendaftaran gagal.');</script>";
        }
    }
}
?>
<div id="content-form">
    <h2>Formulir Pendaftaran Perusahaan</h2>
    <form class="form-horizontal form-register" action="" method="post" enctype="multipart/form-data" >

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtName"><b>Nama Perusahaan *</b></label>
            <div class="col-sm-10">
                <input class="form-control w300" type="text" name="txtName" placeholder="Nama Perusahaan" required />
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="logo"><b>Logo Perusahaan *</b></label>
            <div class="col-sm-10">
                <input  type="file" id="logoimg" name="logo" required/>
                <div id="previewimg"><img id="logopreview" src="" alt="" class="img-rounded" width="50"></div>
            </div>
            <div class="help-block with-errors"></div>
            
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtDescription"><b>Tentang Perusahaan *</b></label>
            <div class="col-sm-10">
            <textarea name="txtDescription" class="textarea" id="descprusahaan" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>                      
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="selIndustry"><b>Industri *</b></label>
            <div class="col-sm-10">
                <select class="form-control w150" name="selIndustry">
                    <?php
//                                if (isset($industri)) {
//                                    foreach ($industri as $a) {
//                                        echo $a;
//                                    }
//                                }
                    $industry = mysql_query("SELECT industry_id, industry FROM tb_industry");
                    while ($row = mysql_fetch_array($industry)) {
                        echo "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtAddress"><b>Alamat Perusahaan *</b></label>
            <div class="col-sm-10">
                <textarea class="form-control" name="txtAddress" required></textarea>
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="selLocation"><b>Lokasi *</b></label>
            <div class="col-sm-10">
                <select class="form-control w150" name="selLocation">
                    <?php
//                                if (isset($lokasi)) {
//                                    foreach ($lokasi as $a) {
//                                        echo $a;
//                                    }
//                                }
                    $lokasi = mysql_query("SELECT location_id, location FROM tb_location");
                    while ($row = mysql_fetch_array($lokasi)) {
                        echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPostCode"><b>Kode Pos *</b></label>
            <div class="col-sm-10">
                <input class="form-control w100" type="number" name="txtPostCode" placeholder="Post Code" required />
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPhone"><b>Telepon *</b></label>
            <div class="col-sm-10">
                <input class="form-control w100" type="text" name="txtPhone" placeholder="Phone Number" required />
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtFax"><b>Fax</b></label>
            <div class="col-sm-10">
                <input class="form-control w100" type="text" name="txtFax" placeholder="Fax" />
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtWebsite"><b>Website Perusahaan</b></label>
            <div class="col-sm-10">
                <input class="form-control w250" type="text" name="txtWebsite" placeholder="Website" />
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtCP"><b>Contact Person *</b></label>
            <div class="col-sm-10">
                <input class="form-control w250" type="text" name="txtCP" placeholder="Contact Persons" required/>
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtEmail"><b>Email *</b></label>
            <div class="col-sm-10">
                <input class="form-control w200" type="email" name="txtEmail" placeholder="Email" required />
            </div>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label " for="txtPassword"><b>Password *</b></label>
            <div class="col-sm-10">
                <input class="form-control w200" type="password" name="txtPassword" placeholder="Password" required />
            </div>
            <div class="help-block with-errors"></div>
        </div>

        <!--        <label class="w160" for="txtName"><b>Nama Perusahaan *</b></label>
                : <input class="w300" type="text" name="txtName" placeholder="First Name" required />
                <br />
        
                <label class="w160" for="logo"><b>Logo Perusahaan *</b></label>
                : <input class="w300" type="file" name="logo" required/>
                <br />
        
                <label class="w160" for="txtDescription"><b>Tentang Perusahaan *</b></label>
                : <textarea name="txtDescription" rows="5" cols="30" required></textarea>
                <br />
        
                <label class="w160" for="selIndustry"><b>Industri *</b></label>
                : <select class="w150" name="selIndustry">
        <?php
//        $industry = mysql_query("SELECT industry_id, industry FROM tb_industry");
//        while ($row = mysql_fetch_array($industry)) {
//            echo "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
//        }
        ?>
                </select>
                <br />
        
                <label class="w160" for="txtAddress"><b>Alamat Perusahaan *</b></label>
                : <textarea name="txtAddress" required></textarea>
                <br />
        
                <label class="w160" for="selLocation"><b>Lokasi *</b></label>
                : <select class="w150" name="selLocation">
        <?php
//        $lokasi = mysql_query("SELECT location_id, location FROM tb_location");
//        while ($row = mysql_fetch_array($lokasi)) {
//            echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
//        }
        ?>
                </select>
                <br />
        
                <label class="w160" for="txtPostCode"><b>Kode Pos *</b></label>
                : <input class="w100" type="text" name="txtPostCode" placeholder="Post Code" required />
                <br />
        
                <label class="w160" for="txtPhone"><b>Telepon *</b></label>
                : <input class="w100" type="text" name="txtPhone" placeholder="Phone Number" required />
                <br />
        
                <label class="w160" for="txtFax"><b>Fax</b></label>
                : <input class="w100" type="text" name="txtFax" placeholder="Fax" />
                <br />
        
                <label class="w160" for="txtWebsite"><b>Website Perusahaan</b></label>
                : <input class="w250" type="text" name="txtWebsite" placeholder="Website" />
                <br />
        
                <label class="w160" for="txtCP"><b>Contact Person *</b></label>
                : <input class="w250" type="text" name="txtCP" placeholder="Contact Persons" required/>
                <br />
        
                <label class="w160" for="txtEmail"><b>Email *</b></label>
                : <input class="w200" type="email" name="txtEmail" placeholder="Email" required />
                <br />
        
                <label class="w160" for="txtPassword"><b>Password *</b></label>
                : <input class="w200" type="password" name="txtPassword" placeholder="Password" required />
                <br />-->

        <div class="form-footer">
            <input type="submit" name="sbtRegister" value="Register" />
        </div>
    </form>
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
                $('#logopreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#logoimg").change(function () {
        readURL(this);
    });
</script>