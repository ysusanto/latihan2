<?php
session_start();

require_once "../connection/conn.php";

$sql = "SELECT  title,salary,experience,benefits,description,work_location,education_id,location_id,specialization_id,level_id 
		FROM tb_job WHERE job_id={$_GET['id']}";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "UPDATE tb_job 
				SET title = '{$_POST['txtTitle']}',
					salary = '{$_POST['txtSalary']}',
					experience = '{$_POST['txtExperience']}',
					benefits = '{$_POST['txtBenefits']}',
					description = '{$_POST['txtDescription']}',
					education_id = '{$_POST['selEducation']}',
					work_location = '{$_POST['txtWorkLocation']}',
					location_id = '{$_POST['selLocation']}',
					specialization_id = '{$_POST['selSpecialization']}',
					level_id = '{$_POST['selLevel']}'
				WHERE job_id={$_GET['id']}"; 

		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update data gagal.');</script>";
		}
	}
}
?>
<div id="content-form">
	<h2>Lowongan Pekerjaan</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtTitle"><b>Job Title *</b></label>
		: <input class="w200" type="text" name="txtTitle" placeholder="Job Title" required value="<?php echo $row['title']; ?>"/>
		<br />
		
		<label class="w160" for="txtSalary"><b>Salary *</b></label>
		: <input class="w200" type="text" name="txtSalary" placeholder="Salary" required value="<?php echo $row['salary']; ?>"/>
		<br />
		
		<label class="w160" for="txtExperience"><b>Experience *</b></label>
		: <input class="w300" type="text" name="txtExperience" placeholder="Experience" required value="<?php echo $row['experience']; ?>"/>
		<br />
		
		<label class="w160" for="txtBenefits"><b>Benefits *</b></label>
		: <textarea name="txtBenefits" rows="5" cols="30" required><?php echo $row['benefits']; ?></textarea>
		<br />
		
		<label class="w160" for="selEducation"><b>Education *</b></label>
		: <select class="w150" name="selEducation">
			<?php 
				$education = mysql_query("SELECT education_id, education FROM tb_education");
				while ($row_edu = mysql_fetch_array($education)) {
					if($row_edu['education_id'] == $row['education_id']){
						echo "<option value='{$row_edu['education_id']}' selected>{$row_edu['education']}</option>";
					}
					else {
						echo "<option value='{$row_edu['education_id']}'>{$row_edu['education']}</option>";
					}
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="selSpecialization"><b>Specialization *</b></label>
		: <select class="w180" name="selSpecialization">
			<?php 
				$spesialisasi = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
				while ($row_spes = mysql_fetch_array($spesialisasi)) {
					if($row_spes['specialization_id'] == $row['specialization_id']){
						echo "<option value='{$row_spes['specialization_id']}' selected>{$row_spes['specialization']}</option>";
					}
					else {
						echo "<option value='{$row_spes['specialization_id']}'>{$row_spes['specialization']}</option>";
					}
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="selLevel"><b>Level *</b></label>
		: <select class="w180" name="selLevel">
			<?php 
				$level = mysql_query("SELECT level_id, level FROM tb_level");
				while ($row_level = mysql_fetch_array($level)) {
					if($row_level['level_id'] == $row['level_id']){
						echo "<option value='{$row_level['level_id']}' selected>{$row_level['level']}</option>";
					}
					else {
						echo "<option value='{$row_level['level_id']}'>{$row_level['level']}</option>";
					}
					
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="txtWorkLocation"><b>Work Location *</b></label>
		: <textarea name="txtWorkLocation" rows="5" cols="30" required><?php echo $row['work_location'];?></textarea>
		<br />
		
		<label class="w160" for="selLocation"><b>Location *</b></label>
		: <select class="w150" name="selLocation">
			<?php 
				$lokasi = mysql_query("SELECT location_id, location FROM tb_location");
				while ($row_lokasi = mysql_fetch_array($lokasi)) {
					if($row_lokasi['location_id'] == $row['location_id']){
						echo "<option value='{$row_lokasi['location_id']}' selected>{$row_lokasi['location']}</option>";
					}
					else {
						echo "<option value='{$row_lokasi['location_id']}'>{$row_lokasi['location']}</option>";
					}
				}
			?>
		</select>
		<br />
		<br />
		
		<label class="w160" for="txtDescription"><b>Job Description *</b></label>
		: <textarea id="redactor" name="txtDescription" rows="5" cols="30" required><?php echo $row['description']; ?></textarea>
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