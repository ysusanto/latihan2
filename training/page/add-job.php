<?php
session_start();

require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "INSERT INTO tb_job (company_id,title,salary,experience,benefits,description,work_location,
									education_id,location_id,specialization_id,level_id) 
				VALUES ('{$_SESSION['company_id']}','{$_POST['txtTitle']}','{$_POST['txtSalary']}',
						'{$_POST['txtExperience']}','{$_POST['txtBenefits']}','{$_POST['txtDescription']}','{$_POST['txtWorkLocation']}',
						'{$_POST['selEducation']}','{$_POST['selLocation']}','{$_POST['selSpecialization']}','{$_POST['selLevel']}')";
		$insert = mysql_query($sql);
		if($insert == true){
			echo "<script type='text/javascript'>
					alert('Tambah data lowongan berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, penambahan gagal.');</script>";
		}
	}
}
?>
<div id="content-form">
	<h2>Lowongan Pekerjaan</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtTitle"><b>Job Title *</b></label>
		: <input class="w200" type="text" name="txtTitle" placeholder="Job Title" required />
		<br />
		
		<label class="w160" for="txtSalary"><b>Salary *</b></label>
		: <input class="w200" type="text" name="txtSalary" placeholder="Salary" required />
		<br />
		
		<label class="w160" for="txtExperience"><b>Experience *</b></label>
		: <input class="w300" type="text" name="txtExperience" placeholder="Experience" required />
		<br />
		
		<label class="w160" for="txtBenefits"><b>Benefits *</b></label>
		: <textarea name="txtBenefits" rows="5" cols="30" required></textarea>
		<br />
		
		<label class="w160" for="selEducation"><b>Education *</b></label>
		: <select class="w150" name="selEducation">
			<?php 
				$education = mysql_query("SELECT education_id, education FROM tb_education");
				while ($row = mysql_fetch_array($education)) {
					echo "<option value='{$row['education_id']}'>{$row['education']}</option>";
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="selSpecialization"><b>Specialization *</b></label>
		: <select class="w180" name="selSpecialization">
			<?php 
				$spesialisasi = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
				while ($row = mysql_fetch_array($spesialisasi)) {
					echo "<option value='{$row['specialization_id']}'>{$row['specialization']}</option>";
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="selLevel"><b>Level *</b></label>
		: <select class="w180" name="selLevel">
			<?php 
				$level = mysql_query("SELECT level_id, level FROM tb_level");
				while ($row = mysql_fetch_array($level)) {
					echo "<option value='{$row['level_id']}'>{$row['level']}</option>";
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="txtWorkLocation"><b>Work Location *</b></label>
		: <textarea name="txtWorkLocation" rows="5" cols="30" required></textarea>
		<br />
		
		<label class="w160" for="selLocation"><b>Location *</b></label>
		: <select class="w150" name="selLocation">
			<?php 
				$lokasi = mysql_query("SELECT location_id, location FROM tb_location");
				while ($row = mysql_fetch_array($lokasi)) {
					echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
				}
			?>
		</select>
		<br />
		<br />
		
		<label class="w160" for="txtDescription"><b>Job Description *</b></label>
		: <textarea id="redactor" name="txtDescription" rows="5" cols="30" required></textarea>
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