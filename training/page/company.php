<?php
session_start();
require_once "../connection/conn.php";

$query = "SELECT tb_company.*, 
				tb_industry.*,
				tb_location.*,
				(SELECT COUNT(tb_company_vote.training_id) FROM tb_company_vote WHERE tb_company_vote.company_id=tb_company.company_id AND tb_company_vote.status='like') AS 'like',
				(SELECT COUNT(tb_company_vote.training_id) FROM tb_company_vote WHERE tb_company_vote.company_id=tb_company.company_id AND tb_company_vote.status='dislike') AS 'dislike'
		FROM tb_company
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_company.industry_id
		INNER JOIN tb_location ON tb_location.location_id=tb_company.location_id
		ORDER BY `like` > dislike DESC";
		
		
$result = mysql_query($query);
$rs = mysql_fetch_assoc($result);
if(!empty($rs)){
?>

	<h4>Perusahaan</h4>
	<div id="pajinate">
	<?php
		// query umum untuk mencari lowongan
		$rs = mysql_query($query);
		echo "<ul id='job-list' class='alt_content'>";
		while ($row = mysql_fetch_assoc($rs)) {
			$like = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$row['company_id']} AND status='like'");
			$dislike = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$row['company_id']} AND status='dislike'");
			$comment = mysql_query("SELECT * FROM tb_company_comment WHERE company_id={$row['company_id']}");
			$total_like= mysql_num_rows($like);
			$total_dislike = mysql_num_rows($dislike);
			$total_comment = mysql_num_rows($comment);
			$logo = '<img src="data:image/jpg;base64,' .  base64_encode($row['company_logo'])  . '" />';
			echo "<li>";
			echo "	<div class='job-desc'>";			
			echo "		<h2><img src='../img/icons/house.png'class='icon' />{$row['company_name']}</h2>";
			echo "		<div class='logo'>{$logo}</div>";
			echo "		<h5><img src='../img/icons/location.png'class='icon' /> {$row['address']}, {$row['location']} - {$row['post_code']}</h5>";
			echo "		<h5><img src='../img/icons/industri.png'class='icon' /> {$row['industry']}</h5>";
			echo "		<h5><img src='../img/icons/telephone.png'class='icon' /> {$row['phone']}</h5>";
			echo "		<h5><img src='../img/icons/fax.png'class='icon' /> {$row['fax']}</h5>";
			echo "		<h5><img src='../img/icons/email.png'class='icon' /> {$row['email']}</h5>";
			echo "		<h5><img src='../img/icons/web.png'class='icon' /> {$row['website']}</h5>";
			echo "		<p>{$row['description']}...</p>";
			echo "		<p>{$row['posted']}</p>";
			if($_SESSION['training_id']!=null){
			echo "		<div align='right' class='actions'>";
			echo " 			<span class='like-total'>{$total_like}</span> <img src='../img/icons/like.png' class='icon like' id='{$row['company_id']}'/> ";
			echo " 			<span class='dislike-total'>{$total_dislike}</span> <img src='../img/icons/dislike.png' class='icon dislike' id='{$row['company_id']}'/> ";
			echo " 			<span class='comment-total'>{$total_comment}</span> <img src='../img/icons/comment.png' class='icon comment' id='{$row['company_id']}'/> ";
			echo "			<div class='comment-box'>
								<input type='hidden' class='company_id' name='company_id' value='{$row['company_id']}'/>
								<input type='hidden' class='training_id' name='training_id' value='{$_SESSION['training_id']}'/>
								<input type='text' class='comment' name='comment' placeholder='Komentar...' autofocus/>";
			$comments = mysql_query("SELECT DISTINCT tb_company_comment.*,tb_seeker.firstname,tb_seeker.lastname,tb_training.training_name,tb_company.company_name FROM tb_company_comment,tb_seeker,tb_training,tb_company WHERE tb_company_comment.company_id={$row['company_id']} GROUP BY tb_company_comment.company_comment_id ORDER BY tb_company_comment.comment_time DESC ");
			echo "<ul class='comments'>";
			while($comment = mysql_fetch_assoc($comments)){
				if ($comment['training_id']==null&&$comment['seeker_id']==null){$name = $comment['company_name'];}
				else if ($comment['training_id']==null){ $name = $comment['firstname'].' '.$comment['lastname'];}
				else if($comment['seeker_id']==null){ $name = $comment['training_name'];}
				
				echo "<li>
						<div>
							<b>{$name}</b> {$comment['comment']}
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
	?>
	<div class="alt_page_navigation"></div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#pajinate').pajinate({
			items_per_page : 3,
			item_container_id : '.alt_content',
			nav_panel_id : '.alt_page_navigation'
		});

		$('.like').click(function(){
			var training_id = $(this).nextAll('div.comment-box').children('input.training_id').val();
			var company_id = $(this).nextAll('div.comment-box').children('input.company_id').val();			
			var $this = $(this);
			$.post("../json.php?action=likecompany", {company_id:company_id,training_id:training_id,seeker_id:null}, function(data){
				var json_obj = $.parseJSON(data);//parse JSON
				$.each(json_obj,function(i,e){
				 	$this.prevAll('span.like-total').html(e.like);
				 	$this.nextAll('span.dislike-total').html(e.dislike);
				});
		    });
		});

		$('.dislike').click(function(){
			var training_id = $(this).nextAll('div.comment-box').children('input.training_id').val();
			var company_id = $(this).nextAll('div.comment-box').children('input.company_id').val();			
			var $this = $(this);
			$.post("../json.php?action=dislikecompany", {company_id:company_id,training_id:training_id,seeker_id:null}, function(data){
				var json_obj = $.parseJSON(data);//parse JSON
				$.each(json_obj,function(i,e){
				 	$this.prevAll('span.like-total').html(e.like);
				 	$this.prevAll('span.dislike-total').html(e.dislike);
				});
		    });
		});

		$('div.comment-box').hide();
		$('img.comment').toggle(
			function(){
				$('div.comment-box').slideUp('fast');
				$(this).next('div.comment-box').slideDown('fast');
			},
			function(){
				$('div.comment-box').slideUp('fast');
			}
		);

		$('input.comment').keypress(function(event) {
			var key = event.which;
			if (key == 13) {
				var comment = $(this).val();
				var training_id = $(this).prev().val();
				var company_id = $(this).prev().prev().val();
				var $this = $(this);
				$.post('../json.php?action=commentcompany', {company_id:company_id,training_id:training_id,comment:comment}, function(data){
					location.reload();
				})
			}
		});
	});	
</script>
<?php } else { echo "<h3>Tidak ada perusahaan.</h3>"; }?>