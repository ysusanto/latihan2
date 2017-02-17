<?php
include_once '../connection/conn.php';

$sql = "SELECT package_id,job,month,price FROM tb_package";
$result = mysql_query($sql);
?>
<h3>Package List</h3>
<a href="?menu=add-package" class="btn">Add Package</a>
<div class="table-responsive">
	<table id="seeker" class="data-table">
		<thead>
			<tr>
				<th>Job</th>
				<th>Month Validity</th>
				<th>Price</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php
			while ($row = mysql_fetch_assoc($result)){
				$price = number_format($row['price'],0,',','.');
				echo "<tr>
						<td align='center'>{$row['job']} Job</td>
						<td align='center'>{$row['month']} Month</td>
						<td align='center'>IDR {$price}</td>
						<td align='center' width='20'><a href='?menu=edit-package&id={$row['package_id']}'>Edit</a></td>
						<td align='center' width='20'><a href='page/delete-package.php?id={$row['package_id']}'>Delete</a></td>
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