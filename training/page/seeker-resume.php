<?php
require_once "../connection/conn.php";

// Data Pribadi
$sql_seeker = "SELECT tb_seeker.*,tb_location.location
				FROM tb_seeker 
				INNER JOIN tb_location ON tb_location.location_id=tb_seeker.location_id
				WHERE tb_seeker.seeker_id={$_GET['seeker_id']}";

$result_seeker = mysql_query($sql_seeker);
$row_seeker = mysql_fetch_assoc($result_seeker);
?>
<div id="menu">
	<h4>Foto Profil</h4>
	<div id="photo-proflie">
		<?php 
			// Menampilkan foto profil
			
			if($row_seeker['photo']==null){
				$photo = "<img src='img/default.jpg' title='Click to update'/>";
			}
			else {
				$photo = '<img title="Click to update" src="data:image/jpg;base64,' .  base64_encode($row_seeker['photo'])  . '" />';
			}
		?>
		<?php echo $photo; ?>
	</div>
	<br />
</div>
<div id="content">
	<h4>Data Pribadi</h4>
	<?php 
		
	?>
	<table class="profile">
		<tr>
			<td class="label">Nama Lengkap</td>
			<td>: <?php echo $row_seeker['firstname'] . " " . $row_seeker['lastname'];?></td>
			<td></td>
		</tr>
		<tr>
			<td class="label">Tanggal Lahir</td>
			<td>: <?php echo date('d-m-Y', strtotime($row_seeker['dob']));?></td>
			<td></td>
		</tr>
		<tr>
			<td class="label">No. Telepon</td>
			<td>: <?php echo $row_seeker['phone'];?></td>
			<td></td>
		</tr>
		<tr>
			<td class="label">Email</td>
			<td>: <?php echo $row_seeker['email'];?></td>
			<td></td>
		</tr>
		<tr>
			<td class="label">Alamat</td>
			<td>: <?php echo $row_seeker['location'];?></td>
			<td></td>
		</tr>
	</table>
	<br /><br />
	
	<h4>Pendidikan</h4>
	<table class="profile">
	<?php 
		// Data Pribadi
		$sql_edu = "SELECT tb_seeker_edu.*,tb_education.education
						FROM tb_seeker_edu 
						INNER JOIN tb_education ON tb_education.education_id=tb_seeker_edu.education_id
						WHERE tb_seeker_edu.seeker_id={$_GET['seeker_id']}";
		
		$result_edu = mysql_query($sql_edu);
		while($row_edu = mysql_fetch_assoc($result_edu)){
			echo "<tr>
					<td class='label'>
						{$row_edu['education']}
					</td>
					<td>
						<h3>{$row_edu['institute']}</h3>
						<table class='profile'>
							<tr>
								<td class='label'>Jurusan</td>
								<td>: {$row_edu['department']}</td>
							</tr>
							<tr>
								<td class='label'>Nilai Akhir / IPK</td>
								<td>: {$row_edu['final_score']}</td>
							</tr>
						</table>
					</td>
				 </tr>";
		}
	?>
	</table>
	<br /><br />
	
	<h4>Pengalaman Kerja</h4>
	<table class="profile">
	<?php 
		// Data Pengalaman Kerja
		$sql_exp = "SELECT tb_seeker_exp.*,tb_location.location,tb_specialization.specialization,tb_industry.industry
						FROM tb_seeker_exp
						INNER JOIN tb_location ON tb_location.location_id=tb_seeker_exp.location_id
						INNER JOIN tb_specialization ON tb_specialization.specialization_id=tb_seeker_exp.specialization_id
						INNER JOIN tb_industry ON tb_industry.industry_id=tb_seeker_exp.industry_id
						WHERE tb_seeker_exp.seeker_id={$_GET['seeker_id']}";
		
		$result_exp = mysql_query($sql_exp);
		while($row_exp = mysql_fetch_assoc($result_exp)){
			$salary = number_format($row_exp['salary'],0,',','.');
			echo "<tr>
					<td class='label'>
						{$row_exp['work']}
					</td>
					<td>
						<h3>{$row_exp['position']}</h3>
						<table class='profile'>
							<tr>
								<td class='label'>Nama Perusahaan</td>
								<td>: {$row_exp['company']}</td>
							</tr>
							<tr>
								<td class='label'>Industri</td>
								<td>: {$row_exp['industry']}</td>
							</tr>
							<tr>
								<td class='label'>Spesialisasi</td>
								<td>: {$row_exp['specialization']}</td>
							</tr>
							<tr>
								<td class='label'>Lokasi</td>
								<td>: {$row_exp['location']}</td>
							</tr>
							<tr>
								<td class='label'>Gaji Bulanan</td>
								<td>: IDR {$salary}</td>
							</tr>
						</table>
					</td>
				 </tr>";
		}
	?>
	</table>
	<br />
</div>
