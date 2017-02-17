<?php
include_once '../../connection/conn.php';
include_once '../mpdf60/mpdf.php';

$mpdf=new mPDF();
$css = file_get_contents('../css/tableprint.css');
$mpdf->WriteHTML($css,1);

$sql = "SELECT  tb_training.training_id,tb_training.email,tb_training.training_name,tb_training.address,tb_location.location,tb_training.phone
		FROM tb_training
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id";
$result = mysql_query($sql);

$body = "<h3 class='title'>Tempat Kursus</h3>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Nama Tempat Kursus</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>				
			</tr>
		</thead>
		<tbody>";
		
			while ($row = mysql_fetch_assoc($result)){
				$body.= "<tr>
							<td>{$row['training_name']}</td>
							<td>{$row['address']}</td>
							<td align='center'>{$row['location']}</td>
							<td align='center'>{$row['email']}</td>
							<td align='center' width='110'>{$row['phone']}</td>													
						 </tr>";
			}
		
$body .= "</tbody>
	</table>";
$total = mysql_num_rows($result);
$body .= "<p class='info'>Total Lowongan : ".$total."</p>";

$mpdf->WriteHTML($body);
$mpdf->Output("Tempat_Kursus.pdf",'I');
exit;
