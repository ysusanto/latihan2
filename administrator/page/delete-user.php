<?php
require_once "../../connection/conn.php";

$sql = "DELETE FROM tb_user WHERE user_id={$_GET['id']}";
mysql_query($sql);

header("Location: dashboard.php?menu=user");
?>