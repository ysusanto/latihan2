<?php
session_start();

require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
		
		$result = mysql_query("UPDATE tb_company SET company_logo='{$logo}' WHERE company_id='{$_GET['id']}'");
		
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
	<h2>Logo Perusahaan</h2>
	<form class="form-register" action="" method="post" enctype="multipart/form-data">
		<label class="w150" for=""logo"">Logo Perusahaan</label>
		: <input class="w200" type="file" name="logo"/>
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtSave" value="Save" />
		</div>
	</form>
</div>