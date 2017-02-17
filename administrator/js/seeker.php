<?php
include_once '../connection/conn.php';

$sql = "SELECT seeker_id,firstname,lastname,email,gender FROM tb_seeker";
$result = mysql_query($sql);
?>
<h3>Seeker List</h3>
<div class="table-responsive">
	<table id="seeker" class="data-table">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>View</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			while ($row = mysql_fetch_assoc($result)){
				echo "<tr>
						<td>{$row['firstname']}</td>
						<td>{$row['lastname']}</td>
						<td align='center'>{$row['email']}</td>
						<td align='center' width='20'>{$row['gender']}</td>
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