<?php
session_start();

require_once "../connection/conn.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$result = mysql_query("SELECT * FROM tb_job_interview WHERE job_id={$_GET['job_id']} AND seeker_id={$_GET['seeker_id']}");
		$row = mysql_fetch_assoc($result);
		if(!empty($row)){
			$insert = mysql_query("UPDATE tb_job_interview SET schedule='{$_POST['txtSchedule']}',address='{$_POST['txtAddress']}' WHERE job_id={$_GET['job_id']} AND seeker_id={$_GET['seeker_id']}");
		} else {
			$sql = "INSERT INTO tb_job_interview (job_id,seeker_id,schedule,address,status) 
					VALUES ('{$_GET['job_id']}','{$_GET['seeker_id']}',
							'{$_POST['txtSchedule']}','{$_POST['txtAddress']}','wait')";
			$insert = mysql_query($sql);
		}
		if($insert == true){
			echo "<script type='text/javascript'>
					alert('Jadwal interview berhasil dikirim.');
					window.location='index.php?page=view-job&id={$_GET['job_id']}';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, penambahan gagal.');</script>";
		}
	}
}
else {
	$result = mysql_query("SELECT * FROM tb_job_interview WHERE job_id={$_GET['job_id']} AND seeker_id={$_GET['seeker_id']}");
	$row = mysql_fetch_assoc($result);
	if(!empty($row)){
		$status = $row['status'];
	} else {
		$status = "wait";
	}
	
}
?>
<div id="content-form">
	<h2>Jadwal Interview</h2>
	<form class="form-register" action="" method="post">
		<label class="w160" for="txtSchedule"><b>Jadwal (hari &amp; jam) *</b></label>
		: <input class="w200" type="text" name="txtSchedule" placeholder="Jadwal (hari &amp; jam)" value="<?php echo $row['schedule']?>" required />
		<br />

		<label class="w160" for="txtAddress"><b>Alamat *</b></label>
		: <textarea name="txtAddress" rows="5" cols="30" required><?php echo $row['address']?></textarea>
		<br />
		
		<label class="w160" for="txtStatus"><b>Status</b></label>
		: <input class="w30" type="text" name="txtStatus" value="<?php echo strtoupper($status); ?>" disabled />
		<br />
		
		<div class="form-footer">
			<input type="submit" name="sbtSave" value="Save" />
			<a href="index.php?page=view-job&id=<?php echo $_GET['job_id']?>" class="btn">Cancel</a>
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