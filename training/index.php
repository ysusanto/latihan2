<?php 
session_start();

require_once "../connection/conn.php";

if (isset($_GET['logout'])) {
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    $_SESSION = array();
    session_unset();
    session_destroy();
    
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- META -->
	<meta charset="utf-8">
	<meta name="author" content="Huda Azzuhri">
	
	<!-- CSS -->
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<link rel="stylesheet" type="text/css" href="../css/pajinate.css" />
	<link rel="stylesheet" type="text/css" href="../css/redactor.css" />
	
	<!-- CSS -->
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
         <script src="../js/bootstrap.min.js"></script>
	<script src="../js/pajinate.js"></script>
	<script src="../js/redactor.js"></script>
	<!-- TITLE -->
	<title>KursusKerja.com</title>
        <script>
            $(document).ready(function () {
                $('div.li-child').hide();
                $('.toggle').click(function () {
                    $('.toggle').next().hide();
                    $(this).next().fadeIn();
                });
            });
        </script>
</head>
<body>

<div class="wrapper color1">
	
    <div id="header">
                <div id="logo">
                    <a href="../index.php"><img src="../img/animasi-logo.gif" /></a>
                </div>
                <?php
                if ($_SESSION["training_name"] == null) {
                    ?>
                    <ul id="navigation">
                        <?php
                        echo "<li><a href='../index.php'>Beranda</a></li>";
                        echo "<li><a href='../?page=job'>Lowongan</a></li>";
                        echo "<li><a href='../?page=login'>Login</a></li>";
//					echo '<li><a href="#" class="toggle">Login</a>
//						<div class="li-child">
//							<ul>
//								<li><a href="?page=login">Pencari Kerja</a></li>
//								<li><a href="employer/?page=login">Perusahaan</a></li>
//								<li><a href="training/?page=login">Tempat Kursus</a></li>
//							</ul>
//						</div>
//					</li>';  
                        //echo "<li><a href='?page=register'>Daftar</a></li>";
                        echo '<li><a href="#" class="toggle">Daftar</a>
						<div class="li-child">
							<ul>
								<li><a href="../?page=register">Pencari Kerja</a></li>
								<li><a href="../employer/?page=register">Perusahaan</a></li>
								<li><a href="../training/?page=register">Tempat Kursus</a></li>
							</ul>
						</div>
					</li>';
                        ?>

                    </ul>
                <?php }
                ?>


            </div>
</div>
     <?php  if ($_SESSION["training_name"] != null) { ?>
<div class="wrapper color6">
	<ul id="top-nav">
		<?php 
			if($_SESSION["training_name"] != null){
				echo "<li><a href='?page=profile'>Beranda</a></li>
					  <li><a href='?page=comment'>Komentar</a></li>					  
					  <li><a href='?page=company'>Perusahaan</a></li>
					  <li><a href='?page=edit-profile'>Edit Profil</a></li>";
			}
		?>
		<!-- <li><a href="../index.php">Cari Lowongan</a></li> -->
		<?php 
		if($_SESSION["training_name"] != null){
			echo "<li><a href='?logout'>Logout</a></li>";
		}
		?>
	</ul>
</div> <?php }else{ ?>
 <div class="wrapper color3">
	<div id="searching">
		<form id="searching" action="../index.php?page=job" method="post" class="form-inline">
			<div class="form-group"><input class="form-control" type="text" name="txtJobTitle" placeholder="Masukkan judul lowongan, nama perusahaan" /></div>
			<div class="form-group"><select class="form-control" name="selLocation">
				<option value="0">Semua Lokasi</option>
				<?php 
					$lokasi = mysql_query("SELECT location_id, location FROM tb_location");
					while ($row = mysql_fetch_array($lokasi)) {
						echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
					}
				?>
			</select></div>
			<div class="form-group"><select class="form-control"name="selSpecialization">
				<option value="0">Semua Spesialisasi</option>
				<?php 
					$spesialisasi = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
					while ($row = mysql_fetch_array($spesialisasi)) {
						echo "<option value='{$row['specialization_id']}'>{$row['specialization']}</option>";
					}
				?>
			</select></div>
			<div class="form-group"><input class="form-control" type="text" name="txtSalary" placeholder="Gaji Minimum (IDR)" /></div>
			
			<input type="submit" name="sbtSearch" value="Cari" />
		</form>
	</div>
</div>
        <?php } ?>   
    
<div id="panel">
	<?php 
		if(isset($_GET["page"])){
			switch ($_GET["page"]){
				case "register" : include_once "page/register.php";
								  break;
				case "login" : include_once "page/login.php";
							   break;
				case "profile" : include_once "page/profile.php";
							 break;
				case "edit-profile" : include_once "page/edit-profile.php";
							 		  break;
				case "update-logo" : include_once "page/update-logo.php";
							 		  break;
				case "job" : include_once "page/job.php";
							 break;
				case "add-job" : include_once "page/add-job.php";
							 break;
				case "edit-job" : include_once "page/edit-job.php";
							 break;
				case "view-job" : include_once "page/view-job.php";
							 break;
				case "company" : include_once "page/company.php";
							 break;
				case "comment" : include_once "page/comment.php";
							 break;
				case "voting" : include_once "page/voting.php";
							 break;
				case "seeker-resume" : include_once "page/seeker-resume.php";
							 break;
				default : break;
			}
		}
		else {
			if($_SESSION["company_name"] != null){
				include_once "page/profile.php";
			}
			else {
				include_once "index.php";	
			}
		}
	?>
</div>
<div class="wrapper color5">
	<div id="footer">
		<p>Copyright &copy; 2015 | kursuskerja.com</p>
	</div>
</div>
</body>
</html>