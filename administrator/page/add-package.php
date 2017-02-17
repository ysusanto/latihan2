<?php
include_once '../connection/conn.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
	if($_POST["sbtSave"]){
		$sql = "INSERT INTO tb_package(job,month,price) VALUES('{$_POST['txtJob']}','{$_POST['txtMonth']}','{$_POST['txtPrice']}')";
		$insert = mysql_query($sql);
		if($insert == true){
			echo "<script type='text/javascript'>
					alert('Tambah data berhasil.');
					window.location='?menu=package';
				 </script>";
		}
		else {
			echo "<script type='text/javascript'>alert('Maaf, tambah data gagal.');</script>";
		}
	}
}
?>
<h3>Add Package</h3>
<form class="data-form" action="" method="post">
	<label class="w180" for="txtJob">Job Posting</label>
	: <input class="w150" type="text" name="txtJob" required/>
	<br /> 
	
	
	<label class="w180" for="txtMonth">Package Validity (month)</label>
	: <input class="w150" type="text" name="txtMonth" required/>
	<br />
	
	<label class="w180" for="txtPrice">Price (IDR)</label>
	: <input class="w150" type="text" name="txtPrice" required/>
	<br />
	
	<input type="submit" name="sbtSave" value="Save" />
</form>