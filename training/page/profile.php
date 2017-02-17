<?php
session_start();

require_once "../connection/conn.php";

$sql = "SELECT  tb_training.training_id,
				tb_training.email,  
				tb_training.training_name,
				tb_training.training_logo,  
				tb_training.description,
				tb_training.address,  
				tb_industry.industry,  
				tb_location.location,  
				tb_training.phone,  
				tb_training.website  
		FROM tb_training
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_training.industry_id
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id
		WHERE tb_training.training_id={$_SESSION['training_id']}";

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

?>
<div id="menu">
	<h4>Logo Kursus</h4>
	<div id="photo-proflie">
		<?php 
			// Menampilkan foto profil
			
			if($row['training_logo']==null){
				$logo = "<img src='img/default.jpg' title='Click to update'/>";
			}
			else {
				$logo = '<img title="Click to update" src="data:image/jpg;base64,' .  base64_encode($row['training_logo'])  . '" />';
			}
		?>
		<a href="?page=update-logo&id=<?php echo $_SESSION['training_id']?>"><?php echo $logo; ?></a>
	</div>
	<br />
</div>
<div id="content">
	<h4><?php echo $row['training_name']?></h4>
	<h5>Tentang <?php echo $row['training_name']?></h5>
	<?php echo $row['description'];?>
	<br /><br />

	<h4>Detail Kursus</h4>
	<table id="detail">
		<tr>
			<td width="150">Industry</td>
			<td>: <?php echo $row['industry'];?></td>
		</tr>	
		<tr>
			<td>Website</td>
			<td>: <?php echo $row['website'];?></td>
		</tr>
		<tr>
			<td>Telephone</td>
			<td>: <?php echo $row['phone'];?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td>: <?php echo $row['address'];?></td>
		</tr>
		<tr>
			<td>Lokasi</td>
			<td>: <?php echo $row['location'];?></td>
		</tr>
	</table>
	<br/>

	<h4>Kursus yang di sediakan</h4>
        <?php
        $sql = "SELECT a.id,a.keahlian_id,b.keahlian FROM `tb_detail_keahliantraining` a left join tb_keahlian_training b on a.keahlian_id=b.keahlian_id  where a.training_id='{$_SESSION['training_id']}' order by b.keahlian";

$result = mysql_query($sql);
//$row = mysql_fetch_array($result);
$html="<table id=\"detail\">
		<tr>";
if(mysql_num_rows($result)>0){ 
    
    $x=1;
    foreach (mysql_fetch_array($result) as $value) {
        $html.='<td width="150">'.$value['keahlian'].'</td>';
        if($x%2==0){
            $html .='</tr>	
		<tr>';
        }
        $x++;
    }
    
}else{
    $html.='<td width="150"></td>';
}
$html .="</tr>
	</table>";

echo $html;
?>
	
</div>