<?php
require_once "../connection/conn.php";

$sql = "DELETE FROM tb_seeker_exp WHERE seeker_exp_id={$_GET['id']}";
mysql_query($sql);

header("Location: ../index.php?page=profile");
?>