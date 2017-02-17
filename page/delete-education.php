<?php
require_once "../connection/conn.php";

$sql = "DELETE FROM tb_seeker_edu WHERE seeker_edu_id={$_GET['id']}";
mysql_query($sql);

header("Location: ../index.php?page=profile");
?>