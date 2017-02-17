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
		$result = mysql_query("SELECT user_id,username,password FROM tb_user WHERE username='{$_POST['txtUsername']}' AND password='{$password}'");
		$row = mysql_fetch_assoc($result);
		
		if(count($row)>1){
			$_SESSION["user_id"]=$row["user_id"];
			$_SESSION["username"]=$row["username"];
			echo "<script type='text/javascript'>
					alert('Login Berhasil.');
					window.location='dashboard.php';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, login gagal.');</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<meta charset="ISO-8859-1">
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/pajinate.css" />
	<link rel="stylesheet" type="text/css" href="css/datetimepicker.css" />
	
	<!-- CSS -->
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/pajinate.js"></script>
	<script src="js/datetimepicker.js"></script>
	<!-- TITLE -->
	<title>Administrator</title>
</head>
<body>

<div id="login-box">
	<h2>Login</h2>
	<form id="form-login" action="" method="post">
		<label class="w150" for="txtUsername">Username</label>
		<input class="w200" type="text" name="txtUsername" placeholder="Usernmae" required />
		<br />
		
		<label class="w150" for="txtPassword">Password</label>
		<input class="w200" type="password" name="txtPassword" placeholder="Password" required />
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtLogin" value="Login" />
		</div>
	</form>
</div>

</body>
</html>