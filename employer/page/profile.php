<?php
session_start();

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
		WHERE tb_company.company_id={$_SESSION['company_id']}";

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
		<a href="?page=update-logo&id=<?php echo $_SESSION['company_id']?>"><?php echo $logo; ?></a>
	</div>
	<br />
	
	<h4>Detail Perusahaan</h4>
	<table id="detail">
		<tr>
			<td>Industry</td>
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
			<td>Address</td>
			<td>: <?php echo $row['address'];?></td>
		</tr>
		<tr>
			<td>Lokasi</td>
			<td>: <?php echo $row['location'];?></td>
		</tr>
	</table>
</div>
<div id="content">
	<h4><?php echo $row['company_name']?></h4>
	<h5>Tentang Perusahaan</h5>
	<?php echo $row['description'];?>
	<br /><br />
	
	<h4>Daftar Lowongan</h4>
	<table id="job-table">
		<tr>
			<th width="80">Tanggal</th>
			<th width="350">Posisi / Jabatan</th>
			<th>Lokasi</th>
                        <th>Status</th>                        
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
		<?php 
			$sql = "SELECT tb_job.status,tb_job.job_id,DATE_FORMAT(tb_job.posted,'%d %b %Y') AS 'posted',tb_job.title,tb_location.location
					FROM tb_job
					INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
					WHERE tb_job.company_id={$_SESSION['company_id']}
					ORDER BY tb_job.posted DESC";
			
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)){
				echo "<tr>";
				echo "	<td align='center'>{$row['posted']}</td>";
				echo "	<td><a href='?page=view-job&id={$row['job_id']}'>{$row['title']}</a></td>";
				echo "	<td align='center'>{$row['location']}</td>";
                                if($row['status']=='0'){
                                  echo "<td align='center'><button onclick=\"statlow('" . $row['job_id'] . "')\" type=\"button\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-minus-sign\" aria-hidden=\"true\"></span></button></td>";  
                                }else{
                                     echo "<td align='center'><button onclick=\"statlow('" . $row['job_id'] . "')\" type=\"button\" class=\"btn btn-success btn-sm\"><span class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span></button></td>"; 
                                }
				echo "	<td align='center'><a href='?page=edit-job&id={$row['job_id']}'>Edit</td>";
				echo "	<td align='center'><a href='page/delete-job.php?id={$row['job_id']}'>Hapus</td>";
				echo "</tr>";
			}
		?>
	</table>
</div>