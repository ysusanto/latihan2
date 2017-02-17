<?php
session_start();

require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtEdit"]){
		if($_POST["txtPassword"]==""){
			$sql = "UPDATE tb_training 
					SET email = '{$_POST['txtEmail']}',
					  	training_name = '{$_POST['txtName']}',
					  	description = '{$_POST['txtDescription']}',
					  	address = '{$_POST['txtAddress']}',
					  	industry_id = '{$_POST['selIndustry']}',
					  	location_id = '{$_POST['selLocation']}',
					  	post_code = '{$_POST['txtPostCode']}',
					  	phone = '{$_POST['txtPhone']}',
					  	fax = '{$_POST['txtFax']}',
					  	website = '{$_POST['txtWebsite']}',
					  	contact_person = '{$_POST['txtCP']}'
					WHERE training_id = '{$_SESSION['training_id']}'";
		}
		else {
			$password = sha1($_POST["txtPassword"]);	
			$sql = "UPDATE tb_training 
					SET email = '{$_POST['txtEmail']}',
						password = '{$_POST['txtPassword']}',
					  	training_name = '{$_POST['txtName']}',
					  	description = '{$_POST['txtDescription']}',
					  	address = '{$_POST['txtAddress']}',
					  	industry_id = '{$_POST['selIndustry']}',
					  	location_id = '{$_POST['selLocation']}',
					  	post_code = '{$_POST['txtPostCode']}',
					  	phone = '{$_POST['txtPhone']}',
					  	fax = '{$_POST['txtFax']}',
					  	website = '{$_POST['txtWebsite']}',
					  	contact_person = '{$_POST['txtCP']}'
					WHERE training_id = '{$_SESSION['training_id']}'";
		}
		
		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update data gagal.');</script>";
		}
	}
}
else {
	$sql = "SELECT  tb_training.training_id,
				tb_training.email,  
				tb_training.password,  
				tb_training.training_name,  
				tb_training.training_logo, 
				tb_training.description,
				tb_training.address,  
				tb_training.industry_id,  
				tb_training.location_id,  
				tb_training.post_code,  
				tb_training.phone,  
				tb_training.fax,  
				tb_training.website,  
				tb_training.contact_person
		FROM tb_training
		WHERE tb_training.training_id={$_SESSION['training_id']}";

	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
}
?>
<div id="content-form">
	<h2>Profile Perusahaan</h2>
	<form class="form-register" action="" method="post">		
		<label class="w160" for="txtName"><b>training Name *</b></label>
		: <input class="w300" type="text" name="txtName" placeholder="First Name" required value="<?php echo $row['training_name'];?>" />
		<br />
		
		<label class="w160" for="txtDescription"><b>training Description *</b></label>
		: <textarea id="redactor" name="txtDescription" rows="5" cols="30" required><?php echo $row['description'];?></textarea>
		<br />
		
		<label class="w160" for="selIndustry"><b>Industry *</b></label>
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
		
		<label class="w160" for="txtAddress"><b>training Address *</b></label>
		: <textarea name="txtAddress" cols="30" rows="4" required><?php echo $row['address'];?></textarea>
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
		
		<label class="w160" for="txtPostCode"><b>Post Code *</b></label>
		: <input class="w100" type="text" name="txtPostCode" required value="<?php echo $row['post_code'];?>" />
		<br />
		
		<label class="w160" for="txtPhone"><b>Phone Number *</b></label>
		: <input class="w100" type="text" name="txtPhone" required value="<?php echo $row['phone'];?>" />
		<br />
		
		<label class="w160" for="txtFax"><b>Fax Number</b></label>
		: <input class="w100" type="text" name="txtFax" value="<?php echo $row['fax'];?>" />
		<br />
		
		<label class="w160" for="txtWebsite"><b>training Website</b></label>
		: <input class="w250" type="text" name="txtWebsite" value="<?php echo $row['website'];?>" />
		<br />
		
		<label class="w160" for="txtCP"><b>Contact Person *</b></label>
		: <input class="w250" type="text" name="txtCP" required value="<?php echo $row['contact_person'];?>"/>
		<br />

		<label class="w160" for="txtEmail"><b>Email *</b></label>
		: <input class="w200" type="email" name="txtEmail" placeholder="Email" required value="<?php echo $row['email'];?>" />
		<br />
		
		<label class="w160" for="txtPassword"><b>Password *</b></label>
		: <input class="w200" type="password" name="txtPassword" placeholder="Password"/>
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtEdit" value="Edit" />
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