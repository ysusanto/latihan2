<?php
include_once '../../connection/conn.php';
include_once '../mpdf60/mpdf.php';

$mpdf=new mPDF();
$css = file_get_contents('../css/tableprint.css');
$mpdf->WriteHTML($css,1);

$sql = "SELECT * FROM tb_seeker";
$result = mysql_query($sql);

$body = "<h3 class='title'>Pencari Kerja</h3>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Nama Lengkap</th>
				<th>Email</th>
				<th>No. Telepon</th>
				<th>Alamat</th>							
			</tr>
		</thead>
		<tbody>";
		
			while ($row = mysql_fetch_assoc($result)){
				$body .= "<tr>
							<td>{$row['firstname']} {$row['lastname']}</td>
							<td align='center'>{$row['email']}</td>
							<td align='center' width='110'>{$row['phone']}</td>
							<td>{$row['address']}</td>
						 </tr>";
			}
		
$body .= "</tbody>
	</table>";
$total = mysql_num_rows($result);
$body .= "<p class='info'>Total Lowongan : ".$total."</p>";

$mpdf->WriteHTML($body);
$mpdf->Output("Pencari_Kerja.pdf",'I');
exit;