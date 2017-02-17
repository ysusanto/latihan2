<?php
session_start();
require_once "../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['sbtComment']) {
        mysql_query("INSERT INTO tb_company_comment(company_id,parent_id,comment) VALUES('{$_SESSION['company_id']}','{$_POST['txtParentId']}','{$_POST['txtComment']}')");
    }
}

$query = "SELECT tb_company_comment.*,tb_company.company_name,tb_seeker.firstname,tb_seeker.lastname,tb_training.training_name
		FROM tb_company_comment, tb_company, tb_seeker, tb_training
		WHERE tb_company_comment.company_id = {$_SESSION['company_id']}
		AND (tb_training.training_id = tb_company_comment.training_id
		OR tb_seeker.seeker_id = tb_company_comment.seeker_id
		OR tb_company_comment.seeker_id IS NULL	 
		OR tb_company_comment.training_id IS NULL)
		ORDER BY tb_company_comment.comment_time DESC";

$result = mysql_query($query);
$rs = mysql_fetch_assoc($result);
if (!empty($rs)) {
    ?>

    <h4>Komentar</h4>
<!--    <form action="" method="post" class="form-register">
        <input type="text" class="w500" name="txtComment" placeholder="Komentar..."/>
        <input type="submit" name="sbtComment" value="Balas Komentar" class="btn"/>
    </form>-->
    <div id="pajinate">
        <?php
        // query umum untuk mencari lowongan
        $rs = mysql_query($query);
        $x = 1;
        echo "<ul id='job-list' class='alt_content'>";
        while ($row = mysql_fetch_assoc($rs)) {
            if ($row['seeker_id'] == null) {
                $name = "<h2><img src='../img/icons/house.png'class='icon' />{$row['training_name']}</h2>";
            }
            if ($row['training_id'] == null) {
                $name = "<h2><img src='../img/icons/user.png'class='icon' />{$row['firstname']} {$row['lastname']}</h2>";
            }
            if ($row['seeker_id'] == null && $row['training_id'] == null) {
                $name = "<h2><img src='../img/icons/house.png'class='icon' />{$row['company_name']}</h2>";
            }
            $posted = date('d-m-Y h:i:s', strtotime($row['comment_time']));
            echo "<li>";
            echo "	<div class='job-desc'>";
            echo "		{$name}";
            echo "		<h5><img src='../img/icons/calendartime.png'class='icon' />{$posted}</h5>";
            echo "		<p style='font-size:15px'><i>{$row['comment']}</i></p>";
            echo "<div class=\"row\">
  <div class=\"col-xs-12 col-md-8\"></div>
  <div class=\"col-xs-6 col-md-4\"><a onclick='reply" . $x . "()' href=''>Balas</a></div>
</div>";
            echo "	</div>";
            echo "<div class='job-desc' style='margin-left:10px'>";
            echo "<div id='commentbalas'>";
            if ($row['company_coment_id'] == $row['parent_id']) {
                echo "		{$name}";
                echo "		<h5><img src='../img/icons/calendartime.png'class='icon' />{$posted}</h5>";
                echo "		<p style='font-size:15px'><i>{$row['comment']}</i></p>";
            }
            echo "</div>";
            echo "<div id='divinputbalas".$x."' style='display:none'>";
            echo "<form action=\"\" method=\"post\" class=\"form-register\">
		<input type=\"text\" class=\"w500\" name=\"txtComment\" placeholder=\"Komentar...\"/>
                <input type=\"hidden\" name=\"txtParentId\" value='" . $row['company_coment_id'] . "'>
		<input type=\"submit\" name=\"sbtComment\" value=\"Balas Komentar\" class=\"btn\"/>
	</form>";
            echo "</div> ";
            echo "	</div>";
            echo "<script> ";
            echo "function reply".$x."(){ $('#divinputbalas.".$x."').show();} ";
            echo "</script>";
            echo "</li>";
            $x++;
        }
        echo "</ul>";
        ?>
        <div class="alt_page_navigation"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#pajinate').pajinate({
                items_per_page: 10,
                item_container_id: '.alt_content',
                nav_panel_id: '.alt_page_navigation'
            });
        });
    </script>
<?php
} else {
    echo "<h3>Tidak ada komentar.</h3>";
}?>