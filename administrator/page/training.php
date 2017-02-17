<?php
include_once '../connection/conn.php';

$sql = "SELECT  tb_training.training_id,tb_training.email,tb_training.training_name,tb_training.address,tb_location.location,tb_training.phone
		FROM tb_training
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id";
$result = mysql_query($sql);
?>
<h3>Tempat Kursus</h3>
<a href="page/print-training.php" class="btn">Print PDF</a>
<div class="table-responsive">
	<table id="seeker" class="data-table">
		<thead>
			<tr>
				<th>Nama Tempat Kursus</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			while ($row = mysql_fetch_assoc($result)){
				echo "<tr>
						<td>{$row['training_name']}</td>
						<td>{$row['address']}</td>
						<td align='center'>{$row['location']}</td>
						<td align='center'>{$row['email']}</td>
						<td align='center' width='110'>{$row['phone']}</td>						
						<td align='center' width='20'><a href='?menu=view-training&id={$row['training_id']}'>View</a></td>					
					 </tr>";
			}
		?>
		</tbody>
	</table>
</div>
<script>
$(document).ready(function(){
    $('#seeker').dataTable();
});
</script>