<?php
session_start();
require_once "../connection/conn.php";

$sql = "SELECT  tb_job.title,tb_job.salary,tb_job.experience,tb_job.benefits,tb_job.description,
				tb_job.work_location,tb_education.education_id,tb_location.location,tb_specialization.specialization,tb_level.level,
				tb_company.company_id,tb_company.email,tb_company.company_name,tb_company.description AS 'company_desc',
				tb_company.address,tb_industry.industry,tb_company.phone,tb_company.website 
		FROM tb_job
		INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
		INNER JOIN tb_education ON tb_education.education_id=tb_job.education_id
		INNER JOIN tb_specialization ON tb_specialization.specialization_id=tb_job.specialization_id
		INNER JOIN tb_level ON tb_level.level_id=tb_job.level_id
		INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_company.industry_id
		WHERE tb_job.job_id={$_GET['id']}";

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
?>
<div id="view-job">
	<table>
		<tr>
			<td>
				<div id="job-detail">
					<h3>Judul Pekerjaan</h3>
					<?php echo $row["title"];?>
					<br /><br />

					<h3>Deskripsi Pekerjaan</h3>
					<?php echo $row["description"];?>
					<br /><br />
					
					<h3>Lokasi Kerja</h3>
					<?php echo $row["work_location"] . " " . $row["location"];?>
					
				</div>
			</td>
			<td width="350">
				<div id="company-detail">
					<h3>Detail Perusahaan</h3>
					<div id="detail">
						<h5>Nama Perusahaan :</h5>
						<p><?php echo $row['company_name'];?></p>
						<h5>Industri :</h5>
						<p><?php echo $row['industry'];?></p>
						<h5>Website :</h5>
						<p><?php echo $row['website'];?></p>
						<h5>Telepon :</h5>
						<p><?php echo $row['phone'];?></p>
						<h5>Email :</h5>
						<p><?php echo $row['email'];?></p>
						<h5>Alamat :</h5>
						<p><?php echo $row['address'] . " " . $row['location'];?></p>
					</div>
					
					<br /><br />
					<h3>Tentang Perusahaan</h3>
					<?php echo $row["company_desc"];?>
				</div>
			</td>
		</tr>
	</table>
</div>