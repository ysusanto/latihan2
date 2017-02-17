<?php
require_once "connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["sbtRegister"]) {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $dob = date("Y-m-d", strtotime($_POST['txtDob']));
        $password = sha1($_POST["txtPassword"]);

        $sql = "INSERT INTO tb_seeker (email,password,firstname,lastname,phone,gender,dob,address,create_date,modified_date) 
			   VALUES ('{$_POST['txtEmail']}','{$password}','{$_POST['txtFirstname']}','{$_POST['txtLastname']}',
			   		   '{$_POST['txtPhone']}','{$_POST['selGender']}','{$dob}','{$_POST['txtAddress']}','{$tgl}','{$tgl}')";

        $insert = mysql_query($sql);
        $sql2 = "select seeker_id from tb_seeker where email='" . $_POST['txtEmail'] . "'";

        $select = mysql_query($sql2);
        $row = mysql_fetch_assoc($select);

        // untuk mengirim keterangan pendaftaran ke email
        $message = "Kepada Yth. ucfirst({$_POST['txtName']}), <br /><br />
					Terima kasih telah mendaftar di kursuskerja.com. Email yang anda gunakan adalah <br />
					Email : {$_POST['txtEmail']} <br />
					Silahkan konfirmasi email anda dengan klik link di bawah ini <br/>
                                     http://kursuskerja.com/?page=confirm&q=1&id=" . $row['seeker_id'] . " <br />
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
//		
        if ($insert == true) {
            echo "<script type='text/javascript'>
					alert('Terima kasih telah mendaftar. Chek Email Anda');
					window.location='index.php';
				 </script>";
        } else {
            echo "<script type='text/javascript'>alert('Maaf, pendaftaran gagal.');</script>";
        }
    }
}
?>
<div id="content-form">
    <h2>Formulir Pendaftaran</h2>
    <form class="form-register" action="" method="post">
        <label class="w150" for="txtEmail"><b>Email*</b></label>
        : <input class="w200" type="email" name="txtEmail" placeholder="Email" required />
        <br />

        <label class="w150" for="txtPassword"><b>Password*</b></label>
        : <input class="w200" type="password" name="txtPassword" placeholder="Password" required />
        <br />

        <label class="w150" for="txtFirstname"><b>Nama Depan*</b></label>
        : <input class="w200" type="text" name="txtFirstname" placeholder="Nama Depan" required />
        <br />

        <label class="w150" for="txtLastname"><b>Nama Belakang*</b></label>
        : <input class="w200" type="text" name="txtLastname" placeholder="Nama Belakang"/>
        <br />

        <label class="w150" for="txtPhone"><b>Telepon*</b></label>
        : <input class="w100" type="text" name="txtPhone" placeholder="Telepon" required />
        <br />

        <label class="w150" for="selGender"><b>Jenis Kelamin*</b></label>
        : <select class="w100" name="selGender">
            <option value="M">Laki-laki</option>
            <option value="F">Perempuan</option>
        </select>
        <br />

        <label class="w150" for="txtDob"><b>Tanggal Lahir*</b></label>
        : <input   type="date" name="txtDob" required />
        <br />

        <label class="w150" for="txtAddress"><b>Alamat *</b></label>
        : <textarea class="w350" name="txtAddress"></textarea>
        <br />

        <div class="form-footer">
            <input type="submit" name="sbtRegister" value="Register" />
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery('#datepicker').datetimepicker({
        timepicker: false,
        format: 'd-m-Y'
    });
</script>