<?php
require_once "../connection/conn.php";

$sql = "SELECT  tb_company.company_id,
				tb_company.email,  
				tb_company.company_name,
				tb_company.company_logo,  
				tb_company.description,
				tb_company.address,  
				tb_industry.industry,  
				tb_location.location,  
				tb_company.phone,  
				tb_company.website
		FROM tb_company
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_company.industry_id
		INNER JOIN tb_location ON tb_location.location_id=tb_company.location_id
		WHERE tb_company.company_id={$_GET['id']}";

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

?>
<div id="menu">
	<h4>Logo Perusahaan</h4>
	<div id="photo-proflie">
		<?php 
			// Menampilkan foto profil
			
			if($row['company_logo']==null){
				$logo = "<img src='img/default.jpg' title='Click to update'/>";
			}
			else {
				$logo = '<img title="Click to update" src="data:image/jpg;base64,' .  base64_encode($row['company_logo'])  . '" />';
			}
		?>
		<?php echo $logo; ?>
	</div>
	<br />
	
</div>
<div class="content">
	<h4><?php echo $row['company_name']?></h4>
	<h5>Tentang Perusahaan</h5>
	<?php echo $row['description'];?>
	<br /><br />

	<h4>Detail Perusahaan</h4>
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
			<td>Telephone</td>
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