<?php
session_start();

require_once "connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		
		$result = mysql_query("UPDATE tb_seeker SET photo='{$photo}' WHERE seeker_id='{$_GET['id']}'");
		
		if($result == true){
			echo "<script type='text/javascript'>
					alert('Update Berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update gagal.');</script>";
		}
	}
}
?>
<div id="content-form">
	<h2>Foto Profil</h2>
	<form class="form-register" action="" method="post" enctype="multipart/form-data">
		<label class="w150" for="photo">Foto Profil</label>
		: <input class="w200" type="file" name="photo"/>
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtSave" value="Save" />
		</div>
	</form>
</div>