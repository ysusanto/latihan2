<?php
require_once "../../connection/conn.php";

$sql = "DELETE FROM tb_job WHERE tb_job.job_id={$_GET['id']}";
mysql_query($sql);

header("Location: employer/index.php?page=profile");
?>