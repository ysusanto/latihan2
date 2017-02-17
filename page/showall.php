
<?php
require_once "connection/conn.php";
require_once "page/sidemenu.php";
?>

<div id="content">
    <?php
    if (isset($_GET["q"])) {
        $sql="SELECT a.".$_GET['q']."_id,b.".$_GET['q'].",count(a.".$_GET['q']."_id) as jml  FROM `tb_job`a inner join tb_".$_GET['q']." b on a.".$_GET['q']."_id=b.".$_GET['q']."_id where a.status='1'
group by ".$_GET['q']."_id order by 2";
        $result = mysql_query($sql);
        if ($_GET["q"] == "level") {
            echo "<h4>Lowongan Berdasarkan Jabatan</h4>";
        }else if($_GET['q']=='location'){
            echo "<h4>Lowongan Berdasarkan Lokasi</h4>";
        }else if($_GET['q']=='education'){
            echo "<h4>Lowongan Berdasarkan Pendidikan</h4>";
        }
//            $result = mysql_query("SELECT level_id, level FROM tb_level");
            echo "<div id='result-list'>";
            echo "<ul>";
            while ($row = mysql_fetch_array($result)) {
                echo "<li><a href='?page=job&q=level&id={$row[0]}'>{$row[1]}<span class='label label-default'>" . $row[2] . "</span></a></li>";
            }
            echo "</ul>";
            echo "</div>";
         
    } 
    ?>
</div>