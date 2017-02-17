<?php
session_start();

require_once "connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtUpdate"]){
		$target_dir = "document/cv/";
		$filename = date('Ymd') .'_'. str_replace(' ','_',$_FILES['cv']['name']);
		$target_file = $target_dir . $filename;

		if(!empty($_FILES['cv']['name'])){
			mysql_query("UPDATE tb_seeker SET cv='{$filename}' WHERE seeker_id='{$_GET['id']}'");
			move_uploaded_file($_FILES['cv']['tmp_name'], $target_file);

			header("Location: ?page=profile");
		}
	}
}
?>
<div id="content-form">
	<h2>Curiculum Vitae</h2>
	<form class="form-register" action="" method="post" enctype="multipart/form-data">
		<label class="w150" for="photo">Curiculum Vitae</label>
		: <input class="w200" type="file" name="cv"/>
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtUpdate" value="Update" />
		</div>
	</form>
</div>