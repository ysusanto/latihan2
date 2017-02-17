<?php
require_once "connection/conn.php";
$id = $_GET['id'];
$stat = $_GET['q'];
if (isset($stat) && isset($id)) {
    if ($stat == 1) {
        $sql2 = "select seeker_id from tb_seeker where seeker_id='" . $id . "'";
        $find = mysql_query($sql2);
        if ($find && mysql_num_rows($find) > 0) {
            $msg = "Email anda telah di komfirmasi silahkan <a href='??page=login'>login</a> dengan email yang telah terdaftar ";
        } else {
            $msg = "Konfirmasi gagal, Email anda tidak dikenali";
        }
    } else if ($stat == 2) {
        $sql2 = "select company_id from tb_company where company_id='" . $id . "'";
        $find = mysql_query($sql2);
        if ($find && mysql_num_rows($find) > 0) {
            $msg = "Email anda telah di komfirmasi silahkan <a href='??page=login'>login</a> dengan email yang telah terdaftar ";
        } else {
            $msg = "Konfirmasi gagal, Email anda tidak dikenali";
        }
    } else {
        $sql2 = "select training_id from tb_training where training_id='" . $id . "'";
        $find = mysql_query($sql2);
        if ($find && mysql_num_rows($find) > 0) {
            $msg = "Email anda telah di komfirmasi silahkan <a href='??page=login'>login</a> dengan email yang telah terdaftar ";
        } else {
            $msg = "Konfirmasi gagal, Email anda tidak dikenali";
        }
    }
} else {
    $msg = "Link yang anda gunakan salah";
}
?>
<div class="job-desc">
    <p><?php echo $msg; ?></p>
</div>

