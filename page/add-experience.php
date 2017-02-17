<?php
session_start();

require_once "connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "INSERT INTO tb_seeker_exp (seeker_id,position,specialization_id,company,industry_id,location_id,salary,work) 
				VALUES ('{$_SESSION['seeker_id']}','{$_POST['txtPosition']}','{$_POST['selSpecialization']}',
						'{$_POST['txtCompany']}','{$_POST['selIndustry']}','{$_POST['selLocation']}','{$_POST['txtSalary']}','{$_POST['txtWork']}')";
		
		$insert = mysql_query($sql);
		if($insert == true){
			echo "<script type='text/javascript'>
					alert('Tambah data pengalaman kerja berhasil.');
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
	<h2>Pengalaman Kerja</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtPosition"><b>Posisi *</b></label>
		: <input class="w250" type="text" name="txtPosition" placeholder="Posisi" required />
		<br />
		
		<label class="w160" for="selSpecialization"><b>Spesialisasi *</b></label>
		: <select class="w180" name="selSpecialization">
			<?php 
				$spesialisasi = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
				while ($row = mysql_fetch_array($spesialisasi)) {
					echo "<option value='{$row['specialization_id']}'>{$row['specialization']}</option>";
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="txtCompany"><b>Nama Perusahaan *</b></label>
		: <input class="w270" type="text" name="txtCompany" placeholder="Nama Perusahaan" required />
		<br />
		
		<label class="w160" for="selIndustry"><b>Industri *</b></label>
		: <select class="w150" name="selIndustry">
			<?php 
				$industry = mysql_query("SELECT industry_id, industry FROM tb_industry");
				while ($row = mysql_fetch_array($industry)) {
					echo "<option value='{$row['industry_id']}'>{$row['industry']}</option>";
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="selLocation"><b>Lokasi *</b></label>
		: <select class="w150" name="selLocation">
			<?php 
				$lokasi = mysql_query("SELECT location_id, location FROM tb_location");
				while ($row = mysql_fetch_array($lokasi)) {
					echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
				}
			?>
		</select>
		<br />
		
		<label class="w160" for="txtSalary"><b>Gaji Bulanan *</b></label>
		: <input class="w100" type="text" name="txtSalary" placeholder="Gaji Bulanan" required />
		<br />
		
		<label class="w160" for="txtWork"><b>Lama Bekerja *</b></label>
		: <input class="w240" type="text" name="txtWork" placeholder="ex. Januari 2014 - Desember 2014" required />
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