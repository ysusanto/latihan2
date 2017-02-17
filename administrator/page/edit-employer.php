<?php
session_start();

require_once "../connection/conn.php";

?>
<?php
require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtEdit"]){
		$sql = "UPDATE tb_company SET is_active='{$_POST['selActive']}' WHERE company_id='{$_GET['id']}'";
		$update = mysql_query($sql);
		
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='?menu=employer';
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
				tb_company.contact_person,  
				tb_company.is_active
		FROM tb_company
		WHERE tb_company.company_id={$_GET['id']}";

	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
}
?>
<h3>Employer List</h3>
	<form class="data-form" action="" method="post">
		<label class="w160" for="selActive"><b>Aktif*</b></label>
		: <select class="w100" name="selActive">
			<?php 
				if($row['is_active']=="Y"){
					echo "<option value='Y' selected>Yes</option>";
					echo "<option value='N'>No</option>";
				}
				else {
					echo "<option value='Y'>Yes</option>";
					echo "<option value='N' selected>No</option>";
				}
					
			?>
		</select>
		<br />
		
		<label class="w160" for="txtEmail"><b>Email*</b></label>
		: <input class="w200" type="email" name="txtEmail" placeholder="Email" required value="<?php echo $row['email'];?>" disabled/>
		<br />
		
		<label class="w160" for="txtName"><b>Company Name*</b></label>
		: <input class="w300" type="text" name="txtName" placeholder="First Name" required value="<?php echo $row['company_name'];?>" disabled/>
		<br />

		<label class="w160" for="selIndustry"><b>Industry*</b></label>
		: <select class="w150" name="selIndustry" disabled>
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
		
		<label class="w160" for="txtAddress"><b>Company Address*</b></label>
		: <textarea name="txtAddress" cols="30" rows="4" required disabled><?php echo $row['address'];?></textarea>
		<br />
		
		<label class="w160" for="selLocation"><b>Location*</b></label>
		: <select class="w150" name="selLocation" disabled>
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
		
		<label class="w160" for="txtPhone"><b>Phone Number*</b></label>
		: <input class="w100" type="text" name="txtPhone" required value="<?php echo $row['phone'];?>" disabled/>
		<br />
		
		
		<label class="w160" for="txtWebsite">Company Website</label>
		: <input class="w250" type="text" name="txtWebsite" value="<?php echo $row['website'];?>" disabled/>
		<br />
		
		<label class="w160" for="txtCP"><b>Contact Person* </b></label>
		: <input class="w250" type="text" name="txtCP" required value="<?php echo $row['contact_person'];?>" disabled/>
		<br />
		
		<input type="submit" name="sbtEdit" value="Edit" />
	</form>
<script type="text/javascript">
$(document).ready(
	function()
	{
		$('#redactor').redactor();
	}
);
</script>