<?php
include_once '../connection/conn.php';

$sql = "SELECT * FROM tb_user";
$result = mysql_query($sql);
?>
<h3>User List</h3>
<a href="?menu=add-user" class="btn">Add User</a>
<div class="table-responsive">
	<table id="seeker" class="data-table">
		<thead>
			<tr>
				<th>Fullname</th>
				<th>Username</th>
				<th>Password</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		<?php
			while ($row = mysql_fetch_assoc($result)){
				echo "<tr>
						<td align='center'>{$row['fullname']}</td>
						<td align='center'>{$row['username']}</td>
						<td align='center'>{$row['password']}</td>
						<td align='center' width='20'><a href='?menu=edit-user&id={$row['user_id']}'>Edit</a></td>
						<td align='center' width='20'><a href='page/delete-user.php?id={$row['user_id']}'>Delete</a></td>
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