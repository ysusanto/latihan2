<?php


require_once "connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["sbtLogin"]) {
        $password = sha1($_POST["txtPassword"]);
        $resultemployee = mysql_query("SELECT seeker_id,email,password FROM tb_seeker WHERE email='{$_POST['txtEmail']}' AND password='{$password}'");
        $rowemployee = mysql_fetch_assoc($resultemployee);
        $resultcompany = mysql_query("SELECT company_id,email,password,company_name FROM tb_company WHERE email='{$_POST['txtEmail']}' AND password='{$password}'");
        $rowcompany = mysql_fetch_assoc($resultcompany);
        $resulttraining = mysql_query("SELECT training_id,email,password,training_name FROM tb_training WHERE email='{$_POST['txtEmail']}' AND password='{$password}'");
        $rowtraining = mysql_fetch_assoc($resulttraining);
        if (mysql_num_rows($resultemployee) > 0) {
            $status = 1; //employee
        } else
            if (mysql_num_rows($resultcompany) > 0) {
            $status = 2; //perusahaan
//            print_r($status);die(0);
        } else
            if (mysql_num_rows($resulttraining) > 0){
            $status = 3; //training
        }

//print_r($status);die(0);
        if ($status == 1 || $status == '1') {
            $_SESSION["seeker_id"] = $rowemployee["seeker_id"];
            echo "<script type='text/javascript'>
					alert('Login Berhasil.');
					window.location='index.php';
				 </script>";
        } else if ($status == 2 || $status == '2') {
            $_SESSION["company_id"] = $rowcompany["company_id"];
            $_SESSION["company_name"] = $rowcompany["company_name"];
            echo "<script type='text/javascript'>
					alert('Login Berhasil.');
					window.location='employer/index.php?page=profile';
				 </script>";
        } else if ($status == 3 || $status == '3') {
            $_SESSION["training_id"] = $rowtraining["training_id"];
            $_SESSION["training_name"] = $rowtraining["training_name"];
            echo "<script type='text/javascript'>
					alert('Login Berhasil.');
					window.location='training/?page=profile';
				 </script>";
        } else {
            echo "<script type='text/javascript'>alert('Maaf, login gagal.');</script>";
        }
    }
}
?>
<div id="content-form">
    <h2>Login</h2>
    <form class="form-register" action="" method="post">
        <label class="w150" for="txtEmail">Email</label>
        : <input class="w200" type="email" name="txtEmail" placeholder="Email" required />
        <br />

        <label class="w150" for="txtPassword">Password</label>
        : <input class="w200" type="password" name="txtPassword" placeholder="Password" required />
        <br />

        <div class="form-footer">
            <input type="submit" name="sbtLogin" value="Login" />
        </div>
    </form>
</div>