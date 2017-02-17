<?php
session_start();

require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtEdit"]){
		if($_POST["txtPassword"]==""){
			$sql = "UPDATE tb_company 
					SET email = '{$_POST['txtEmail']}',
					  	company_name = '{$_POST['txtName']}',
					  	description = '{$_POST['txtDescription']}',
					  	address = '{$_POST['txtAddress']}',
					  	industry_id = '{$_POST['selIndustry']}',
					  	location_id = '{$_POST['selLocation']}',
					  	post_code = '{$_POST['txtPostCode']}',
					  	phone = '{$_POST['txtPhone']}',
					  	fax = '{$_POST['txtFax']}',
					  	website = '{$_POST['txtWebsite']}',
					  	contact_person = '{$_POST['txtCP']}'
					WHERE company_id = '{$_SESSION['company_id']}'";
		}
		else {
			$password = sha1($_POST["txtPassword"]);	
			$sql = "UPDATE tb_company 
					SET email = '{$_POST['txtEmail']}',
						password = '{$_POST['txtPassword']}',
					  	company_name = '{$_POST['txtName']}',
					  	description = '{$_POST['txtDescription']}',
					  	address = '{$_POST['txtAddress']}',
					  	industry_id = '{$_POST['selIndustry']}',
					  	location_id = '{$_POST['selLocation']}',
					  	post_code = '{$_POST['txtPostCode']}',
					  	phone = '{$_POST['txtPhone']}',
					  	fax = '{$_POST['txtFax']}',
					  	website = '{$_POST['txtWebsite']}',
					  	contact_person = '{$_POST['txtCP']}'
					WHERE company_id = '{$_SESSION['company_id']}'";
		}
		
		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='index.php';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update data gagal.');</script>";
		}
	}
}
else {
	$sql = "SELECT  tb_company.company_id,
				tb_company.email,  
				tb_company.password,  
				tb_company.company_name,  
				tb_company.company_logo, 
				tb_company.description,
				tb_company.address,  
				tb_company.industry_id,  
				tb_company.location_id,  
				tb_company.post_code,  
				tb_company.phone,  
				tb_company.fax,  
				tb_company.website,  
				tb_company.contact_person
		FROM tb_company
		WHERE tb_company.company_id={$_SESSION['company_id']}";

	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);

}
?>
<div id="content-form">
	<h2>Profile Perusahaan</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtName"><b>Company Name *</b></label>
		: <input class="w300" type="text" name="txtName" placeholder="First Name" required value="<?php echo $row['company_name'];?>" />
		<br />
		
		<label class="w160" for="txtDescription"><b>Company Description *</b></label>
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
		
		<label class="w160" for="txtAddress"><b>Company Address *</b></label>
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
		
		<label class="w160" for="txtWebsite"><b>Company Website</b></label>
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