<?php
require_once "../connection/conn.php";

$sql = "SELECT  tb_training.training_id,
				tb_training.email,  
				tb_training.training_name,
				tb_training.training_logo,  
				tb_training.description,
				tb_training.address,  
				tb_industry.industry,  
				tb_location.location,  
				tb_training.phone,  
				tb_training.website
		FROM tb_training
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_training.industry_id
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id
		WHERE tb_training.training_id={$_GET['id']}";

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

?>
<div id="menu">
	<h4>Logo Tempat Kursus</h4>
	<div id="photo-proflie">
		<?php 
			// Menampilkan foto profil
			
			if($row['training_logo']==null){
				$logo = "<img src='img/default.jpg' title='Click to update'/>";
			}
			else {
				$logo = '<img title="Click to update" src="data:image/jpg;base64,' .  base64_encode($row['training_logo'])  . '" />';
			}
		?>
		<?php echo $logo; ?>
	</div>
	<br />
	
</div>
<div class="content">
	<h4><?php echo $row['training_name']?></h4>
	<h5>Tentang Tempat Kursus</h5>
	<?php echo $row['description'];?>
	<br /><br />

	<h4>Detail Tempat Kursus</h4>
	<table id="detail">
		<tr>
			<td width="150">Industri</td>
			<td>: <?php echo $row['industry'];?></td>
		</tr>	
		<tr>
			<td>Website</td>
			<td>: <?php echo $row['website'];?></td>
		</tr>
		<tr>
			<td>Telepon</td>
			<td>: <?php echo $row['phone'];?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>: <?php echo $row['address'];?></td>
		</tr>
		<tr>
			<td>Lokasi</td>
			<td>: <?php echo $row['location'];?></td>
		</tr>	
	</table>
</div>