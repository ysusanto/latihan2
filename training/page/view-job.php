<?php
session_start();
require_once "../connection/conn.php";

$sql = "SELECT  tb_job.title,tb_job.salary,tb_job.experience,tb_job.benefits,tb_job.description,tb_job.posted,
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
	<table id="view-job">
		<tr>
			<td>
				<div id="job-detail">
				<h3><?php echo $row["title"] . " : " . date("d M Y" , strtotime($row["posted"]));?></h3>
					
					<h3>Deskripsi Pekerjaan</h3>
					<?php echo $row["description"];?>
					<br /><br />
					
					<h3>Lokasi Kerja</h3>
					<?php echo $row["work_location"] . " " . $row["location"];?>
					
				</div>
			</td>
			<td>
				<div id="company-detail">
					<h3>Resume</h3>
					<table id="job-table">
						<tr>
							<th width="230">Nama Pelamar</th>
							<th width="120">Tgl Melamar</th>
							<th>Resume</th>
						</tr>
						<?php 
							$sql_seeker = "SELECT CONCAT(tb_seeker.firstname,' ',tb_seeker.lastname) AS 'fullname', tb_apply_job.seeker_id, tb_apply_job.posted
										   FROM tb_apply_job
										   INNER JOIN tb_seeker ON tb_seeker.seeker_id=tb_apply_job.seeker_id
										   WHERE tb_apply_job.job_id='{$_GET['id']}'";
							
							$result_seeker = mysql_query($sql_seeker);
							while($row_seeker = mysql_fetch_assoc($result_seeker)){
								$posted = date("d M Y h:i",strtotime($row_seeker["posted"]));
								echo "<tr>
										<td>{$row_seeker['fullname']}</td>
										<td align='center'>{$posted}</td>
										<td align='center'><a href='?page=seeker-resume&seeker_id={$row_seeker['seeker_id']}'/>View</a></td>
									  </tr>";
							}
						?>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>