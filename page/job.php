<?php
require_once "connection/conn.php";
?>
<div id="menu">
    <!--	<h4>Cari Lowongan</h4>
            <ul id="menu">
                    <li><a href="?q=specialization">Spesialisasi</a></li>
                    <li><a href="?q=level">Tingkat Jabatan</a></li>
                    <li><a href="?q=location">Lokasi</a></li>
            </ul>
            <br />-->

    <h4>Daftar</h4>
    <ul id="menu">
        <li><a href="?page=company">Perusahaan</a></li>
        <li><a href="?page=training">Tempat Kursus</a></li>
    </ul>
</div>

<div id="content">
    <h4>Daftar Lowongan Pekerjaan</h4>
    <div id="pajinate">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        // query umum untuk mencari lowongan
        $query = "SELECT tb_job.job_id, 
						   tb_job.title, 
						   tb_job.salary, 
						   tb_job.experience, 
						   tb_job.benefits, 
						   CONCAT(LEFT(tb_job.description,120),'</b>') AS 'description', 
						   tb_job.posted,
						   tb_location.location,
						   tb_education.education,
						   tb_specialization.specialization,
						   tb_level.level,
						   tb_company.company_name,
						   tb_company.company_logo
					FROM tb_job
					INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id  
					INNER JOIN tb_education ON tb_education.education_id=tb_job.education_id 
					INNER JOIN tb_specialization ON tb_specialization.specialization_id=tb_job.specialization_id
					INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id 
					INNER JOIN tb_level ON tb_level.level_id=tb_job.level_id ";

        // Jika mencari lowongan melalui link di halaman utama
        if (isset($_GET["q"])) {
            $sql = $query . " WHERE tb_job." . $_GET["q"] . "_id='{$_GET['id']}'" . ' ORDER BY tb_job.posted DESC';

            $result = mysql_query($sql);
            echo "<ul id='job-list' class='alt_content'>";
            while ($row = mysql_fetch_array($result)) {
                $like = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$row['job_id']} AND status='like'");
                $dislike = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$row['job_id']} AND status='dislike'");
                $comment = mysql_query("SELECT * FROM tb_job_comment WHERE job_id={$row['job_id']}");
                $total_like = mysql_num_rows($like);
                $total_dislike = mysql_num_rows($dislike);
                $total_comment = mysql_num_rows($comment);
                $logo = '<img src="data:image/jpg;base64,' . base64_encode($row['company_logo']) . '" />';
                echo "<li>";
                echo "	<div class='job-desc'>";
                echo "		<h4><a href='?page=view-job&id={$row['job_id']}' target=\"_blank\"><ins>{$row['title']}</ins></a>    <small>Terbit : ".date('d-m-Y H:i:s', strtotime($row['posted']))."</small></h4>";
                echo "		<h5><img src='img/icons/house.png'class='icon' />{$row['company_name']} | <img src='img/icons/location.png'class='icon' /> {$row['location']} | <img src='img/icons/money.png'class='icon' /> {$row['salary']}</h5>";
                echo "		<div class='logo'>{$logo}</div>";
//                echo "		<h5><img src='img/icons/location.png'class='icon' /> {$row['location']}</h5>";
//                echo "		<h5><img src='img/icons/money.png'class='icon' /> {$row['salary']}</h5>";
                echo "		<p>" . substr($row['description'], 0, 250) . "...</p>";
//                echo "		<p>" . date('Y-m-d H:i:s', strtotime($row['posted'])) . "</p>";
                if ($_SESSION['seeker_id'] != null) {
                    echo "		<div align='right' class='actions'>";
                    echo " 			<span class='like-total'>{$total_like}</span> <img src='img/icons/like.png' class='icon like' id='{$row['job_id']}'/> ";
                    echo " 			<span class='dislike-total'>{$total_dislike}</span> <img src='img/icons/dislike.png' class='icon dislike' id='{$row['job_id']}'/> ";
                    echo " 			<span class='comment-total'>{$total_comment}</span> <img src='img/icons/comment.png' class='icon comment' id='{$row['job_id']}'/> ";
                    echo "			<div class='comment-box'>";
                    echo "				<input type='hidden' class='job_id' name='job_id' value='{$row['job_id']}'/>
									<input type='hidden' class='seeker_id' name='seeker_id' value='{$_SESSION['seeker_id']}'/>
									<input type='text' class='comment' name='comment' placeholder='Komentar...' autofocus/>";
                    $comments = mysql_query("SELECT tb_job_comment.*,tb_seeker.* FROM tb_job_comment,tb_seeker WHERE tb_job_comment.job_id={$row['job_id']} AND tb_job_comment.seeker_id=tb_seeker.seeker_id ORDER BY tb_job_comment.comment_time DESC");
                    echo "<ul class='comments'>";
                    while ($comment = mysql_fetch_assoc($comments)) {
                        echo "<li>
							<div>
								<b>{$comment['firstname']} {$comment['lastname']}</b> {$comment['comment']}
							<div>
						</li>";
                    }
                    echo "</ul>";
                    echo "			</div>";
                    echo "		</div>";
                }
                echo "	</div>";
                echo "</li>";
            }
            echo "</ul>";
        }
        // Jika mengklik menu Lowongan
        else {
            // jika dilakukan pencarian melalui form dan menekan tombol Cari
            if ($_POST['sbtSearch']) {
                $title = $_POST["txtJobTitle"];
                $location = $_POST["selLocation"];
                $specialization = $_POST["selSpecialization"];
                $salary = $_POST["txtSalary"];
                $where = "";

                if ($title != "") {
                    $where .= "WHERE tb_job.title LIKE '%" . $title . "%' OR tb_company.company_name LIKE '%" . $title . "%'";
                }
                if ($location > 0) {
                    if ($title != "")
                        $where .= "AND tb_job.location_id=" . $_POST["selLocation"];
                    else
                        $where = "WHERE tb_job.location_id=" . $_POST["selLocation"];
                }
                if ($specialization > 0) {
                    if ($location > 0 || $title != "") {
                        $where .= "AND tb_job.specialization_id=" . $_POST["selSpecialization"];
                    } else {
                        $where = "WHERE tb_job.specialization_id=" . $_POST["selSpecialization"];
                    }
                }
                if ($salary != "") {
                    if ($location > 0 || $title != "" || $specialization > 0) {
                        $where .= "AND tb_job.salary >=" . $_POST["txtSalary"] . "OR tb_job.salary='Gaji dapat dinegosiasi'";
                    } else {
                        $where = "WHERE tb_job.salary >=" . $_POST["txtSalary"] . " OR tb_job.salary='Gaji dapat dinegosiasi'";
                    }
                }

                $sql = $query . $where . ' ORDER BY tb_job.posted DESC';

                $result = mysql_query($sql);
                echo "<ul id='job-list' class='alt_content'>";
                while ($row = mysql_fetch_array($result)) {
                    $like = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$row['job_id']} AND status='like'");
                    $dislike = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$row['job_id']} AND status='dislike'");
                    $comment = mysql_query("SELECT * FROM tb_job_comment WHERE job_id={$row['job_id']}");
                    $total_like = mysql_num_rows($like);
                    $total_dislike = mysql_num_rows($dislike);
                    $total_comment = mysql_num_rows($comment);
                    $logo = '<img src="data:image/jpg;base64,' . base64_encode($row['company_logo']) . '" />';
                    echo "<li>";
                    echo "	<div class='job-desc'>";
                    echo "		<h3><a href='?page=view-job&id={$row['job_id']}' target=\"_blank\">{$row['title']}</a>   <small>Terbit : ".date('d-m-Y H:i:s', strtotime($row['posted']))."</small></h4>";
                    echo "		<h5><img src='img/icons/house.png'class='icon' />{$row['company_name']} | <img src='img/icons/location.png'class='icon' /> {$row['location']} | <img src='img/icons/money.png'class='icon' /> {$row['salary']}</h5>";
                    echo "		<div class='logo'>{$logo}</div>";
//                    echo "		<h5><img src='img/icons/location.png'class='icon' /> {$row['location']}</h5>";
//                    echo "		<h5><img src='img/icons/money.png'class='icon' /> {$row['salary']}</h5>";
                    echo "		<p>" . substr($row['description'], 0, 250) . "...</p>";
//                    echo "		<p>" . date('Y-m-d H:i:s', strtotime($row['posted'])) . "</p>";
                    if ($_SESSION['seeker_id'] != null) {
                        echo "		<div align='right' class='actions'>";
                        echo " 			<span class='like-total'>{$total_like}</span> <img src='img/icons/like.png' class='icon like' id='{$row['job_id']}'/> ";
                        echo " 			<span class='dislike-total'>{$total_dislike}</span> <img src='img/icons/dislike.png' class='icon dislike' id='{$row['job_id']}'/> ";
                        echo " 			<span class='comment-total'>{$total_comment}</span> <img src='img/icons/comment.png' class='icon comment' id='{$row['job_id']}'/> ";
                        echo "			<div class='comment-box'>";
                        echo "				<input type='hidden' class='job_id' name='job_id' value='{$row['job_id']}'/>
 										<input type='hidden' class='seeker_id' name='seeker_id' value='{$_SESSION['seeker_id']}'/>
										<input type='text' class='comment' name='comment' placeholder='Komentar...' autofocus/>";
                        $comments = mysql_query("SELECT tb_job_comment.*,tb_seeker.* FROM tb_job_comment,tb_seeker WHERE tb_job_comment.job_id={$row['job_id']} AND tb_job_comment.seeker_id=tb_seeker.seeker_id ORDER BY tb_job_comment.comment_time DESC");
                        echo "<ul class='comments'>";
                        while ($comment = mysql_fetch_assoc($comments)) {
                            echo "<li>
								<div>
									<b>{$comment['firstname']} {$comment['lastname']}</b> {$comment['comment']}
								<div>
							</li>";
                        }
                        echo "</ul>";
                        echo "			</div>";
                        echo "		</div>";
                    }
                    echo "	</div>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            // Jika mengklik menu Lowongan
            else {
                $sql = $query . " ORDER BY tb_job.posted DESC";

                $result = mysql_query($sql);
                echo "<ul id='job-list' class='alt_content'>";
                while ($row = mysql_fetch_array($result)) {
                    $like = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$row['job_id']} AND status='like'");
                    $dislike = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$row['job_id']} AND status='dislike'");
                    $comment = mysql_query("SELECT * FROM tb_job_comment WHERE job_id={$row['job_id']}");
                    $total_like = mysql_num_rows($like);
                    $total_dislike = mysql_num_rows($dislike);
                    $total_comment = mysql_num_rows($comment);
                    $logo = '<img src="data:image/jpg;base64,' . base64_encode($row['company_logo']) . '" />';
                    echo "<li>";
                    echo "	<div class='job-desc'>";
                    echo "		<h4><a href='?page=view-job&id={$row['job_id']}' target='_blank'><ins>{$row['title']}</ins></a>   <small>Terbit : ".date('d-m-Y H:i:s', strtotime($row['posted']))."</small></h4>";
                    echo "		<h5><img src='img/icons/house.png'class='icon' />{$row['company_name']} | <img src='img/icons/location.png'class='icon' /> {$row['location']} | <img src='img/icons/money.png'class='icon' /> {$row['salary']}</h5>";
                    echo "		<div class='logo'>{$logo}</div>";
//                    echo "		<h5></h5>";
//                    echo "		<h5></h5>";
                    echo "		<p>" . substr($row['description'], 0, 250) . "...</p>";
//                    echo "		<p>" . date('d-m-Y H:i:s', strtotime($row['posted'])) . "</p>";
                    if ($_SESSION['seeker_id'] != null) {
                        echo "		<div align='right' class='actions'>";
                        echo " 			<span class='like-total'>{$total_like}</span> <img src='img/icons/like.png' class='icon like' id='{$row['job_id']}'/> ";
                        echo " 			<span class='dislike-total'>{$total_dislike}</span> <img src='img/icons/dislike.png' class='icon dislike' id='{$row['job_id']}'/> ";
                        echo " 			<span class='comment-total'>{$total_comment}</span> <img src='img/icons/comment.png' class='icon comment' id='{$row['job_id']}'/> ";
                        echo "			<div class='comment-box'>";
                        echo "				<input type='hidden' class='job_id' name='job_id' value='{$row['job_id']}'/>
										<input type='hidden' class='seeker_id' name='seeker_id' value='{$_SESSION['seeker_id']}'/>
										<input type='text' class='comment' name='comment' placeholder='Komentar...' autofocus/>";
                        $comments = mysql_query("SELECT tb_job_comment.*,tb_seeker.* FROM tb_job_comment,tb_seeker WHERE tb_job_comment.job_id={$row['job_id']} AND tb_job_comment.seeker_id=tb_seeker.seeker_id ORDER BY tb_job_comment.comment_time DESC");
                        echo "<ul class='comments'>";
                        while ($comment = mysql_fetch_assoc($comments)) {
                            echo "<li>
								<div>
									<b>{$comment['firstname']} {$comment['lastname']}</b> {$comment['comment']}
								<div>
							</li>";
                        }
                        echo "</ul>";
                        echo "			</div>";
                        echo "		</div>";
                    }
                    echo "	</div>";
                    echo "</li>";
                }
                echo "</ul>";
            }
        }
        ?>
        <div class="alt_page_navigation"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pajinate').pajinate({
            items_per_page: 15,
            item_container_id: '.alt_content',
            nav_panel_id: '.alt_page_navigation'
        });

        $('.like').click(function () {
            var job_id = $(this).nextAll('div.comment-box').children('input.job_id').val();
            var seeker_id = $(this).nextAll('div.comment-box').children('input.seeker_id').val();
            var $this = $(this);

            $.post("json.php?action=likejob", {job_id: job_id, seeker_id: seeker_id}, function (data) {
                var json_obj = $.parseJSON(data);//parse JSON
                $.each(json_obj, function (i, e) {
                    $this.prevAll('span.like-total').html(e.like);
                    $this.nextAll('span.dislike-total').html(e.dislike);
                });
            });
        });

        $('.dislike').click(function () {
            var job_id = $(this).nextAll('div.comment-box').children('input.job_id').val();
            var seeker_id = $(this).nextAll('div.comment-box').children('input.seeker_id').val();
            var $this = $(this);

            $.post("json.php?action=dislikejob", {job_id: job_id, seeker_id: seeker_id}, function (data) {
                var json_obj = $.parseJSON(data);//parse JSON
                $.each(json_obj, function (i, e) {
                    $this.prevAll('span.like-total').html(e.like);
                    $this.prevAll('span.dislike-total').html(e.dislike);
                });
            });
        });

        $('div.comment-box').hide();
        $('img.comment').toggle(
                function () {
                    $('div.comment-box').slideUp('fast');
                    $(this).next('div.comment-box').slideDown('fast');
                },
                function () {
                    $('div.comment-box').slideUp('fast');
                }
        );

        $('input.comment').keypress(function (event) {
            var key = event.which;
            if (key == 13) {
                var comment = $(this).val();
                var seeker_id = $(this).prev().val();
                var job_id = $(this).prev().prev().val();
                var $this = $(this);
                $.post('json.php?action=commentjob', {job_id: job_id, seeker_id: seeker_id, comment: comment}, function () {
                    location.reload();
                })
            }
        });


    });
</script>
