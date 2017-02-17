<?php
require_once "../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["sbtRegister"]) {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $password = sha1($_POST["txtPassword"]);
        $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));

        $sql = "INSERT INTO tb_training (email,password,training_name,training_logo,
										description,address,industry_id,location_id,post_code,
										phone,fax,website,contact_person,create_date,modified_date) 
				VALUES ('{$_POST['txtEmail']}','{$password}','{$_POST['txtName']}','{$logo}','{$_POST['txtDescription']}','{$_POST['txtAddress']}','{$_POST['selIndustry']}',
						'{$_POST['selLocation']}','{$_POST['txtPostCode']}','{$_POST['txtPhone']}','{$_POST['txtFax']}',
						'{$_POST['txtWebsite']}','{$_POST['txtCP']}','{$tgl}','{$tgl}')";

        $insert = mysql_query($sql);
$sql2 = "select training_id from tb_training where email='" . $_POST['txtEmail'] . "'";

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
                                     http://kursuskerja.com/?page=confirm&q=3&id=" . $row['training_id'] . " <br />
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
					alert('Terima kasih telah mendaftar. Chek email Anda');
					window.location='index.php';
				 </script>";
        } else {
            echo "<script type='text/javascript'>alert('Maaf, pendaftaran gagal.');</script>";
        }
    }
}
?>
<div id="content-form">
    <h2>Formulir Pendaftaran Tempat Kursus</h2>
    <form class="form-register" action="" method="post" enctype="multipart/form-data">
        <label class="w200" for="txtName"><b>Nama Tempat Kursus *</b></label>
        : <input class="w300" type="text" max="50" name="txtName" placeholder="First Name" required />
        <br />

        <label class="w200" for="logo"><b>Logo Tempat Kursus *</b></label>
        : <input class="w300" type="file" name="logo" required/>
        <br />

        <label class="w200" for="txtDescription"><b>Tentang Tempat Kursus *</b></label>
        : <textarea name="txtDescription" rows="5" cols="30" required></textarea>
        <br />

        <label class="w200" for="selIndustry"><b>Industri *</b></label>
        : <select class="w150" name="selIndustry">
            <?php
            $industry = mysql_query("SELECT industry_id, industry FROM tb_industry");
            while ($row = mysql_fetch_array($industry)) {
                echo "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
            }
            ?>
        </select>
        <br />

        <label class="w200" for="txtAddress"><b>Alamat Tempat Kursus *</b></label>
        : <textarea name="txtAddress" required></textarea>
        <br />

        <label class="w200" for="selLocation"><b>Lokasi *</b></label>
        : <select class="w150" name="selLocation">
            <?php
            $lokasi = mysql_query("SELECT location_id, location FROM tb_location");
            while ($row = mysql_fetch_array($lokasi)) {
                echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
            }
            ?>
        </select>
        <br />

        <label class="w200" for="txtPostCode"><b>Kode Pos *</b></label>
        : <input class="w100" type="number" maxlength="6"  name="txtPostCode" placeholder="Post Code" required />
        <br />

        <label class="w200" for="txtPhone"><b>Telepon *</b></label>
        : <input class="w100" type="text" name="txtPhone" maxlength="13" placeholder="Phone Number" required />
        <br />

        <label class="w200" for="txtFax"><b>Fax</b></label>
        : <input class="w100" type="text" maxlength="13" name="txtFax" placeholder="Fax" />
        <br />

        <label class="w200" for="txtWebsite"><b>Website Tempat Kursus</b></label>
        : <input class="w250" type="text" name="txtWebsite" placeholder="Website" />
        <br />

        <label class="w200" for="txtCP"><b>Contact Person *</b></label>
        : <input class="w250" data-maxlength="12" type="text" name="txtCP" placeholder="Contact Persons" required/>
        <br />

        <label class="w200" for="txtEmail"><b>Email *</b></label>
        : <input class="w200" type="email" name="txtEmail" placeholder="Email" required />
        <br />

        <label class="w200" for="txtPassword"><b>Password *</b></label>
        : <input class="w200" data-minlength="6" type="password" name="txtPassword" placeholder="Password" required />
        <br />

        <div class="form-footer">
            <input type="submit" name="sbtRegister" value="Register" />
        </div>
    </form>
</div>