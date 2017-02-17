<?php
include_once '../../connection/conn.php';
include_once '../mpdf60/mpdf.php';

$mpdf=new mPDF();
$css = file_get_contents('../css/tableprint.css');
$mpdf->WriteHTML($css,1);

$sql = "SELECT  tb_job.job_id,tb_company.company_name,tb_job.title, tb_job.salary,tb_location.location,tb_job.posted 
		FROM tb_job
		INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
		INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
		ORDER BY tb_job.posted DESC";
$result = mysql_query($sql);

$body = "<h3 class='title'>Lowongan Kerja</h3>
		<table id='job' class='dataprint'>
			<thead>
				<tr>
					<th>Lowongan Kerja</th>
					<th>Perusahaan</th>
					<th>Lokasi</th>
					<th>Gaji</th>
					<th>Tanggal Posting</th>
				</tr>
			</thead>
		<tbody>";
		
			while ($row = mysql_fetch_assoc($result)){
				$posted = date("d M Y h:i",strtotime($row['posted']));
				$body .= "<tr>
							<td>{$row['title']}</td>
							<td>{$row['company_name']}</td>
							<td align='center'>{$row['location']}</td>
							<td align='center' width='100'>Rp. {$row['salary']}</td>
							<td align='center' width='150'>{$posted}</td>
						 </tr>";
			}

$body  .= "</tbody>
	</table>";
$total = mysql_num_rows($result);
$body .= "<p class='info'>Total Lowongan : ".$total."</p>";

$mpdf->WriteHTML($body);
$mpdf->Output("Lowongan_Kerja.pdf",'I');
exit;
?>
