<?php
include_once '../connection/conn.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$password = sha1($_POST['txtPassword']);
		$sql = "UPDATE tb_user
				SET fullname='{$_POST['txtFullname']}',
					username='{$_POST['txtUsername']}',
					password='{$password}'
				WHERE user_id='{$_GET['id']}'";
		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='?menu=user';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update data gagal.');</script>";
		}
	}
}
else {
	$sql = "SELECT * FROM tb_user WHERE user_id='{$_GET['id']}'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
}
?>
<h3>Edit User</h3>
<form class="data-form" action="" method="post">
	<label class="w150" for="txtFullname">Fullname</label>
	: <input class="w150" type="text" name="txtFullname" required value="<?php echo $row['fullname'];?>"/>
	<br /> 
	
	
	<label class="w150" for="txtUsername">Username</label>
	: <input class="w150" type="text" name="txtUsername" required value="<?php echo $row['username'];?>"/>
	<br />
	
	<label class="w150" for="txtPassword">Password</label>
	: <input class="w150" type="password" name="txtPassword" required/>
	<br />
	
	<input type="submit" name="sbtSave" value="Save" />
</form>