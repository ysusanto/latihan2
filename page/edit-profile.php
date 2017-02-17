<?php
session_start();

require_once "connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtUpdate"]){
		$password = sha1($_POST["txtPassword"]);
		$dob = date("Y-m-d",strtotime($_POST['txtDob']));
		
		if($_POST['txtPassword']==""){
			$sql = "UPDATE tb_seeker
					SET email = '{$_POST['txtEmail']}',
						firstname = '{$_POST['txtFirstname']}',
						lastname = '{$_POST['txtLastname']}',
						phone = '{$_POST['txtPhone']}',
						gender = '{$_POST['selGender']}',
						dob = '{$dob}',
						address = '{$_POST['txtAddress']}'
					WHERE tb_seeker.seeker_id={$_GET['id']}"; 
		}
		else {
			$sql = "UPDATE tb_seeker
					SET email = '{$_POST['txtEmail']}',
						password = '{$password}',
						firstname = '{$_POST['txtFirstname']}',
						lastname = '{$_POST['txtLastname']}',
						phone = '{$_POST['txtPhone']}',
						gender = '{$_POST['selGender']}',
						dob = '{$dob}',
						address = '{$_POST['txtAddress']}'
					WHERE tb_seeker.seeker_id={$_GET['id']}"; 
		}
		
		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='index.php?page=profile';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update gagal.');</script>";
		}
	}
}
else {
	$sql = "SELECT * FROM tb_seeker WHERE seeker_id={$_GET['id']}";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
}
?>
<div id="content-form">
	<h2>Edit Profil</h2>
	<form class="form-register" action="" method="post">
		<label class="w150" for="txtEmail"><b>Email*</b></label>
		: <input class="w200" type="email" name="txtEmail" placeholder="Email" required value="<?php echo $row['email']?>"/>
		<br />
		
		<label class="w150" for="txtPassword"><b>Password*</b></label>
		: <input class="w200" type="password" name="txtPassword" placeholder="Password"/>
		<br />
		
		<label class="w150" for="txtFirstname"><b>Nama Depan*</b></label>
		: <input class="w200" type="text" name="txtFirstname" placeholder="Nama Depan" required value="<?php echo $row['firstname']?>"/>
		<br />
		
		<label class="w150" for="txtLastname"><b>Nama Belakang*</b></label>
		: <input class="w200" type="text" name="txtLastname" placeholder="Nama Belakang" value="<?php echo $row['lastname']?>"/>
		<br />
		
		<label class="w150" for="txtPhone"><b>Telepon*</b></label>
		: <input class="w100" type="text" name="txtPhone" placeholder="Telepon" required value="<?php echo $row['phone']?>"/>
		<br />
		
		<label class="w150" for="selGender"><b>Jenis Kelamin*</b></label>
		: <select class="w100" name="selGender">
			<?php 
				if($row['gender']=="M"){
					echo "<option value='M' selected>Laki-laki</option>";
					echo "<option value='F'>Perempuan</option>";
				}
				else {
					echo "<option value='M'>Laki-laki</option>";
					echo "<option value='F' selected>Perempuan</option>";
				}
					
			?>
			
		</select>
		<br />
		
		<label class="w150" for="txtDob"><b>Tanggal Lahir*</b></label>
		: <input id="datepicker" class="w100" type="text" name="txtDob" required value="<?php echo date('d-m-Y',strtotime($row['dob']));?>"/>
		<br />
		
		<label class="w150" for="txtAddress"><b>Alamat *</b></label>
		: <textarea class="w350" name="txtAddress"><?php echo $row['address']; ?></textarea>
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtUpdate" value="Update" />
			<a href="index.php?page=profile" class="btn">Cancel</a>
		</div>
	</form>
</div>
<script type="text/javascript">
jQuery('#datepicker').datetimepicker({
	 timepicker:false,
	 format:'d-m-Y'
});
</script>