<?php
session_start();
header('Cache-control: private');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtLogin"]){
		$password = sha1($_POST["txtPassword"]);
		$result = mysql_query("SELECT training_id,email,password,training_name FROM tb_training WHERE email='{$_POST['txtEmail']}' AND password='{$password}'");
		$row = mysql_fetch_assoc($result);
		//echo "SELECT email,password FROM tb_company WHERE email='{$_POST['txtEmail']}' AND password='{$password}' AND is_active='Y'";
		if(count($row)>1){
			$_SESSION["training_id"] = $row["training_id"];
			$_SESSION["training_name"] = $row["training_name"];
			echo "<script type='text/javascript'>
					alert('Login Berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, username dan password salah.');</script>";
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
			<input type="submit" name="sbtLogin" value="Login" /> &nbsp; or &nbsp; <a href="?page=register" class="btn">Register</a> 
		</div>
	</form>
</div>