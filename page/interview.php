<?php
session_start();
require_once "connection/conn.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
	if($_POST['sbtConfirm']){
		$sql = "UPDATE tb_job_interview SET status='confirm' WHERE job_interview_id='{$_POST['job_interview_id']}'";
		mysql_query($sql);
	}
	if($_POST['sbtUnconfirm']){
		$sql = "UPDATE tb_job_interview SET status='unconfirm' WHERE job_interview_id='{$_POST['job_interview_id']}'";
		mysql_query($sql);
	}
}

$query = "SELECT tb_job_interview.job_id, 
				 tb_job_interview.schedule,
				 tb_job_interview.address,
				 tb_job_interview.status,
				 tb_job_interview.job_interview_id,
				 tb_job.title, 
				 tb_job.benefits, 
				 tb_job.posted,
				 tb_company.company_name,
				 tb_company.company_logo
			FROM tb_job_interview
			INNER JOIN tb_job ON tb_job.job_id=tb_job_interview.job_id 
			INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id 
			WHERE tb_job_interview.seeker_id='{$_SESSION['seeker_id']}'
			ORDER BY tb_job_interview.created_date DESC ";
		
$result = mysql_query($query);
$rs = mysql_fetch_assoc($result);
if(!empty($rs)){
?>

	<h4>Jadwal Wawancara</h4>
	<div id="pajinate">
	<?php
		// query umum untuk mencari lowongan
		$rs = mysql_query($query);
		echo "<ul id='job-list' class='alt_content'>";
		while ($row = mysql_fetch_assoc($rs)) {
			$logo = '<img src="data:image/jpg;base64,' .  base64_encode($row['company_logo'])  . '" />';
			echo "<li>";
			echo "	<div class='job-desc'>";
			echo "		<h2>{$row['title']}</h2>";
			echo "		<h3><img src='img/icons/house.png'class='icon' />{$row['company_name']}</h3>";
			echo "		<div class='logo'>{$logo}</div>";
			echo "		<h5><img src='img/icons/calendar.png'class='icon' /> Waktu Wawancara : <b>{$row['schedule']}</b></h5>";
			echo "		<h5><img src='img/icons/location.png'class='icon' /> Alamat : <b>{$row['address']}</b></h5>";
			echo "<form action='' method='post'>";
			echo " <input type='hidden' name='job_interview_id' value='{$row['job_interview_id']}' />";
			if($row['status']=='confirm'){				
				echo "<br /><input type='submit' name='sbtUnconfirm' value='Unconfirm' class='btn'/>";
			}else {
				echo "<br /><input type='submit' name='sbtConfirm' value='Confirm' class='btn'/>";
			}
			echo "</form>";
			echo "	</div>";
			echo "</li>";
		}
		echo "</ul>";
	?>
	<div class="alt_page_navigation"></div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#pajinate').pajinate({
			items_per_page : 3,
			item_container_id : '.alt_content',
			nav_panel_id : '.alt_page_navigation'
		});		
	});	
</script>
<?php } else { echo "<h3>Tidak ada jadwal wawancara.</h3>"; }?>