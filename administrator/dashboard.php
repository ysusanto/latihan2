<?php 
session_start();
header('Cache-control: private');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if($_SESSION["user_id"]==null){
	header("Location: index.php");
}
if (isset($_GET['logout'])) {
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    $_SESSION = array();
    session_unset();
    session_destroy();
    
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/datatables.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.theme.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-te-1.4.0.css" />
	<link rel="stylesheet" type="text/css" href="css/redactor.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
	<link rel="stylesheet" type="text/css" href="css/job.css" />
	
	<!-- JAVASCRIPT -->
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-te-1.4.0.min.js"></script>
	<script src="js/datatables.js"></script>
	<script src="js/redactor.js"></script>
	
	<title>Administrator</title>
</head>
<body>
<div id="header">
	<h2><a href="dashboard.php">Administrator</a></h2>
</div>

<div id="sidebar">
<div id="user"><?php echo $_SESSION['username']; ?></div>
	<ul id="menu">
		<li><a href="?menu=user">User</a></li>		
		<li><a href="?menu=jobs">Lowongan Kerja</a></li>
		<li><a href="?menu=seeker">Pencari Kerja</a></li>
		<li><a href="?menu=employer">Perusahaan</a></li>
		<li><a href="?menu=training">Tempat Kursus</a></li>
		<li><a href="?logout">Logout</a></li>
	</ul>
</div>

<div id="content">
	<?php
		if(isset($_GET['menu'])){
			switch($_GET['menu']){
				case "user" : include_once "page/user.php";
								break;
				case "add-user" : include_once "page/add-user.php";
								break;
				case "edit-user" : include_once "page/edit-user.php";
								break;
				case "training" : include_once "page/training.php";
								break;
				case "view-training" : include_once "page/view-training.php";
								break;
				case "jobs" : include_once "page/jobs.php";
								break;	
				case "view-job" : include_once "page/view-job.php";
								break;	
				case "seeker" : include_once "page/seeker.php";
								break;	
				case "view-seeker" : include_once "page/view-seeker.php";
								break;		
				case "employer" : include_once "page/employer.php";
								break;	
				case "edit-employer" : include_once "page/edit-employer.php";
										break;	
				case "view-employer" : include_once "page/view-employer.php";
										break;
										case "add-company" : include_once "page/addperusahaanmodal.php";
										break;	
				default: break;
			}
		}
		else {
			echo "<h2>Welcome to administrator page.</h2>";
		}
	?>
</div>

</body>
</html>