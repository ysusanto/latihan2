<?php
session_start();

require_once "connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "UPDATE tb_seeker_exp 
				SET position = '{$_POST['txtPosition']}',
					specialization_id = '{$_POST['selSpecialization']}',
					company = '{$_POST['txtCompany']}',
					industry_id = '{$_POST['selIndustry']}',
					location_id = '{$_POST['selLocation']}',
					salary = '{$_POST['txtSalary']}',
					work = '{$_POST['txtWork']}'
				WHERE seeker_exp_id = {$_GET['id']}"; 
		
		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data pengalaman kerja berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update gagal.');</script>";
		}
	}
}
else {
	$sql = "SELECT seeker_id,position,specialization_id,company,industry_id,location_id,salary,work
			FROM tb_seeker_exp WHERE seeker_exp_id={$_GET['id']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result); 
}
?>
<div id="content-form">
	<h2>Pengalaman Kerja</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtPosition"><b>Posisi *</b></label>
		: <input class="w250" type="text" name="txtPosition" placeholder="Posisi" required value="<?php echo $row['position'];?>"/>
		<br />
		
		<label class="w160" for="selSpecialization"><b>Spesialisasi *</b></label>
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
		
		<label class="w160" for="txtCompany"><b>Nama Perusahaan *</b></label>
		: <input class="w270" type="text" name="txtCompany" placeholder="Nama Perusahaan" required value="<?php echo $row['company'];?>"/>
		<br />
		
		<label class="w160" for="selIndustry"><b>Industri *</b></label>
		: <select class="w150" name="selIndustry">
			<?php 
				$industry = mysql_query("SELECT industry_id, industry FROM tb_industry");
				while ($row_industry = mysql_fetch_array($industry)) {
					if($row_industry['industry_id'] == $row['industry_id']){
						echo "<option value='{$row_industry['industry_id']}' selected>{$row_industry['industry']}</option>";
					}
					else {
						echo "<option value='{$row_industry['industry_id']}'>{$row_industry['industry']}</option>";	
					}
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="selLocation"><b>Lokasi *</b></label>
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
		
		<label class="w160" for="txtSalary"><b>Gaji Bulanan *</b></label>
		: <input class="w100" type="text" name="txtSalary" placeholder="Gaji Bulanan" required value="<?php echo $row['salary'];?>" />
		<br />
		
		<label class="w160" for="txtWork"><b>Lama Bekerja *</b></label>
		: <input class="w240" type="text" name="txtWork" placeholder="ex. Januari 2014 - Desember 2014" required value="<?php echo $row['work'];?>"/>
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