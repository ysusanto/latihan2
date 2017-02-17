
<?php
require_once "connection/conn.php";
?>
<script>
    $(document).ready(function () {
        $('.hide').hide();
    });

</script>
<div id="menu">
    <h4>Pencarian </h4>
    <h4>- Lokasi</h4>
    <?php
    $result = mysql_query("SELECT a.location_id,b.location,count(a.location_id) as jml  FROM `tb_job`a inner join tb_location b on a.location_id=b.location_id where a.status='1'
group by location_id order by 2 desc limit 10");
    $a = 1;
    $html = '<ul id="menu">';
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
//            if ($a >= 2) {
//                $class = 'class="hide"';
//            } else {
                $class = '';
//            }
            $html .='<li ' . $class . '><a href="?page=job&q=location&id=' . $row['location_id'] . '">' . $row['location'] . '<span class="label label-default">' . $row['jml'] . '</span></a></li>';

            $a++;
        }
        $html.='</ul>';
//        print_r($a);die(0);
        if ($a > 9) {
            $html.='<span><a href="?page=showall&q=location" onclick="showall()">show all </a></span>';
        } else {
            $html.='<span></span>';
        }
    }
    echo $html;
    ?>
    <script>

        function showall() {
            $('.hide').show();
        }
    </script>
    <h4>- Pendidikan</h4>
    <?php
    $result = mysql_query("SELECT a.education_id,b.education,count(a.education_id) as jml  FROM `tb_job`a inner join tb_education b on a.education_id=b.education_id where a.status='1'
group by education_id order by 2 desc limit 10");
    $a = 1;
    $html = '<ul id="menu">';
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
//            if ($a >= 2) {
//                $class = 'class="hide"';
//            } else {
                $class = '';
//            }
            $html .='<li ' . $class . '><a href="?page=job&q=education&id=' . $row['education_id'] . '">' . $row['education'] . ' <span class="label label-default">' . $row['jml'] . '</span></a></li>';

            $a++;
        }
        $html.='</ul>';
//        print_r($a);die(0);
        if ($a > 9) {
            $html.='<span><a href="?page=showall&q=education" onclick="showall()">show all </a></span>';
        } else {
            $html.='<span></span>';
        }
    }
    echo $html;
    ?>
    <!--	<h4>Cari Lowongan</h4>
            <ul id="menu">
                    <li><a href="?q=specialization">Spesialisasi</a></li>
                    <li><a href="?q=level">Tingkat Jabatan</a></li>
                    <li><a href="?q=location">Lokasi</a></li>
            </ul>
            <br />
    
            <h4>Daftar</h4>
            <ul id="menu">
                    <li><a href="?page=company">Perusahaan</a></li>
                    <li><a href="?page=training">Tempat Kursus</a></li>
            </ul>-->
</div>
