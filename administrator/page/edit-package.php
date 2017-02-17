<?php
include_once '../connection/conn.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "UPDATE tb_package
				SET job='{$_POST['txtJob']}',
					month='{$_POST['txtMonth']}',
					price='{$_POST['txtPrice']}'
				WHERE package_id='{$_GET['id']}'";
		$update = mysql_query($sql);
		if($update == true){
			echo "<script type='text/javascript'>
					alert('Update data berhasil.');
					window.location='?menu=package';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, update data gagal.');</script>";
		}
	}
}
else {
	$sql = "SELECT * FROM tb_package WHERE package_id='{$_GET['id']}'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
}
?>
<h3>Edit Package</h3>
<form class="data-form" action="" method="post">
	<label class="w180" for="txtJob">Job Posting</label>
	: <input class="w150" type="text" name="txtJob" required value="<?php echo $row['job'];?>"/>
	<br /> 
	
	
	<label class="w180" for="txtMonth">Package Validity (month)</label>
	: <input class="w150" type="text" name="txtMonth" required value="<?php echo $row['month'];?>"/>
	<br />
	
	<label class="w180" for="txtPrice">Price (IDR)</label>
	: <input class="w150" type="text" name="txtPrice" required value="<?php echo $row['price'];?>"/>
	<br />
	
	<input type="submit" name="sbtSave" value="Save" />
</form>