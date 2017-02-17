<?php
include_once '../connection/conn.php';

$sql = "SELECT  tb_job.job_id,tb_company.company_name,tb_job.title, tb_job.salary,tb_location.location,tb_job.posted 
		FROM tb_job
		INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
		INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
		ORDER BY tb_job.posted DESC";
$result = mysql_query($sql);
?>
<h3>Lowongan Kerja</h3>
<a href="page/print-job.php" class="btn">Print PDF</a>
<div class="table-responsive">
	<table id="job" class="data-table">
		<thead>
			<tr>
				<th>Lowongan Kerja</th>
				<th>Perusahaan</th>
				<th>Lokasi</th>
				<th>Gaji</th>
				<th>Tanggal Posting</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			while ($row = mysql_fetch_assoc($result)){
				$posted = date("d M Y h:i",strtotime($row['posted']));
				echo "<tr>
						<td>{$row['title']}</td>
						<td>{$row['company_name']}</td>
						<td align='center'>{$row['location']}</td>
						<td align='center' width='100'>Rp. {$row['salary']}</td>
						<td align='center' width='150'>{$posted}</td>
						<td align='center' width='20'><a href='?menu=view-job&id={$row['job_id']}'>View</a></td>
					 </tr>";
			}
		?>
		</tbody>
	</table>
</div>
<script>
$(document).ready(function(){
    $('#job').dataTable();
});
</script>