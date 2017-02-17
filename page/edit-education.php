<?php
session_start();

require_once "connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "UPDATE tb_seeker_edu 
				SET institute = '{$_POST['txtInstitute']}',
					education_id = '{$_POST['selEducation']}',
					department = '{$_POST['txtDepartment']}',
					graduation = '{$_POST['txtGraduation']}',
					final_score = '{$_POST['txtScore']}'
				WHERE seeker_edu_id = '{$_GET['id']}'";
		
		$insert = mysql_query($sql);
		if($insert == true){
			echo "<script type='text/javascript'>
					alert('Ubah data pendidikan berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, penambahan gagal.');</script>";
		}
	}
}else {
	$sql = "SELECT * FROM tb_seeker_edu WHERE seeker_edu_id={$_GET['id']}";
	$result = mysql_query($sql);
	$seeker_edu = mysql_fetch_assoc($result);
}
?>
<div id="content-form">
	<h2>Pendidikan Terakhir</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtInstitute"><b>Intitusi / Universitas *</b></label>
		: <input class="w250" type="text" name="txtInstitute" placeholder="Institusi" value="<?php echo $seeker_edu['institute'] ?>" required />
		<br />
		
		<label class="w160" for="selEducation"><b>Pendidikan *</b></label>
		: <select class="w100" name="selEducation">
			<?php 
				$education = mysql_query("SELECT education_id, education FROM tb_education WHERE education_id > 2");
				while ($row = mysql_fetch_array($education)) {
					if($row['education_id']==$seeker_edu['education_id']){
						echo "<option value='{$row['education_id']}' selected>{$row['education']}</option>";
					} else {
						echo "<option value='{$row['education_id']}'>{$row['education']}</option>";
					}
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="txtDepartment"><b>Jurusan *</b></label>
		: <input class="w270" type="text" name="txtDepartment" placeholder="Jurusan" value="<?php echo $seeker_edu['department'] ?>" required />
		<br />
		
		<label class="w160" for="txtGraduation"><b>Tanggal Wisuda *</b></label>
		: <input class="w100" type="text" name="txtGraduation" placeholder="mm/yyyy" value="<?php echo $seeker_edu['graduation'] ?>" required />
		<br />
		
		<label class="w160" for="txtScore"><b>Nilai Akhir *</b></label>
		: <input class="w100" type="text" name="txtScore" placeholder="00.00" value="<?php echo $seeker_edu['final_score'] ?>" required />
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtSave" value="Save" />
			<a href="index.php?page=profile" class="btn">Cancel</a>
		</div>
	</form>
</div>
<script type="text/javascript">
$(document).ready(
	function()
	{
		$('#redactor').redactor();
	}
);
</script>