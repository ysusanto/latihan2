<?php
include_once '../connection/conn.php';

$sql = "SELECT  tb_company.company_id,tb_company.email,tb_company.company_name,tb_company.address,tb_location.location,tb_company.phone
		FROM tb_company
		INNER JOIN tb_location ON tb_location.location_id=tb_company.location_id";
		
		//echo $sql;die(0);
$result = mysql_query($sql);
?>
<h3>Perusahaan</h3>
<a href="page/print-employer.php" class="btn">Print PDF</a>
<a href="?menu=add-company" class="btn">Tambah Perusahaan</a>
<div class="table-responsive">
	<table id="seeker" class="data-table">
		<thead>
			<tr>
				<th>Nama Perusahaan</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>
				<th>Aksi</th>
				<th>Tambah Lowongan</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			while ($row = mysql_fetch_assoc($result)){
				echo "<tr>
						<td>{$row['company_name']}</td>
						<td>{$row['address']}</td>
						<td align='center'>{$row['location']}</td>
						<td align='center'>{$row['email']}</td>
						<td align='center' width='110'>{$row['phone']}</td>						
						<td align='center' width='20'><a href='?menu=view-employer&id={$row['company_id']}'>View</a></td>";
					echo	"<td align='center' width='20'><button onclick=\"addlowker('".$row['company_id']."')\" type=\"button\" class=\"btn btn-info btn-sm\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></button></td>";
					 echo	"</tr>";
			}
		?>
		</tbody>
	</table>
</div>
<script>
$(document).ready(function(){
    $('#seeker').dataTable();
   $(".jqte-test").jqte();
    $('#previewimg').hide();
});

function addlowker(id){
$('#addlowkerModal').modal("show");
$('#txtcompany_id').val(id);

}
</script>
<?php
//include_once 'addperusahaanmodal.php';
include_once 'addlowkermodal.php';
?>