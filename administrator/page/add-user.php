<?php
include_once '../connection/conn.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$password = sha1($_POST['txtPassword']);
		$sql = "INSERT INTO tb_user(fullname,username,password) VALUES('{$_POST['txtFullname']}','{$_POST['txtUsername']}','{$password}')";
		$insert = mysql_query($sql);
		if($insert == true){
			echo "<script type='text/javascript'>
					alert('Tambah data berhasil.');
					window.location='?menu=user';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, tambah data gagal.');</script>";
		}
	}
}
?>
<h3>Add User</h3>
<form class="data-form" action="" method="post">
	<label class="w150" for="txtFullname">Fullname</label>
	: <input class="w150" type="text" name="txtFullname" required/>
	<br /> 
	
	
	<label class="w150" for="txtUsername">Username</label>
	: <input class="w150" type="text" name="txtUsername" required/>
	<br />
	
	<label class="w150" for="txtPassword">Password</label>
	: <input class="w150" type="password" name="txtPassword" required/>
	<br />
	
	<input type="submit" name="sbtSave" value="Save" />
</form>