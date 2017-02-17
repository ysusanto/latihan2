<?php
include_once '../connection/conn.php';

$sql = "SELECT * FROM tb_seeker";
$result = mysql_query($sql);
?>
<h3>Pencari Kerja</h3>
<a href="page/print-seeker.php" class="btn">Print PDF</a>
<div class="table-responsive">
	<table id="seeker" class="data-table">
		<thead>
			<tr>
				<th>Nama Lengkap</th>
				<th>Email</th>
				<th>No. Telepon</th>
				<th>Alamat</th>				
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			while ($row = mysql_fetch_assoc($result)){
				echo "<tr>
						<td>{$row['firstname']} {$row['lastname']}</td>
						<td align='center'>{$row['email']}</td>
						<td align='center' width='110'>{$row['phone']}</td>
						<td>{$row['address']}</td>
						<td align='center' width='20'><a href='?menu=view-seeker&id={$row['seeker_id']}'>View</a></td>
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