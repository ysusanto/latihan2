
<?php
require_once "connection/conn.php";
?>
<script>
    $(document).ready(function () {
        $('.hide').hide();
    });

</script>
<?php 
require_once "page/sidemenu.php";
?>
<div id="content">
    <?php
    if (isset($_GET["q"])) {
        if ($_GET["q"] == "level") {
            echo "<h4>Lowongan Berdasarkan Jabatan</h4>";
            $result = mysql_query("SELECT level_id, level FROM tb_level");
            echo "<div id='result-list'>";
            echo "<ul>";
            while ($row = mysql_fetch_array($result)) {
                echo "<li><a href='?page=job&q=level&id={$row['level_id']}'>{$row['level']}</a></li>";
            }
            echo "</ul>";
            echo "</div>";
        } else if ($_GET["q"] == "location") {
            echo "<h4>Lowongan Berdasarkan Lokasi</h4>";
            $result = mysql_query("SELECT location_id, location FROM tb_location");
            echo "<div id='result-list'>";
            echo "<ul>";
            while ($row = mysql_fetch_array($result)) {
                echo "<li><a href='?page=job&q=location&id={$row['location_id']}'>{$row['location']}</a></li>";
            }
            echo "</ul>";
            echo "</div>";
        } else {
            echo "<h4>Lowongan Berdasarkan Spesialisasi</h4>";
            $result = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
            echo "<div id='result-list'>";
            echo "<ul>";
            while ($row = mysql_fetch_array($result)) {
                echo "<li><a href='?page=job&q=specialization&id={$row['specialization_id']}'>{$row['specialization']}</a></li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    } else {
        echo "<h4>Lowongan Berdasarkan Spesialisasi</h4>";
        $result = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
        echo "<div id='result-list'>";
        echo "<ul>";
        while ($row = mysql_fetch_array($result)) {
            echo "<li><a href='?page=job&q=specialization&id={$row['specialization_id']}'>{$row['specialization']}</a></li>";
        }
        echo "</ul>";
        echo "</div>";
    }
    ?>
</div>