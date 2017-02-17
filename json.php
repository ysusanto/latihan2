<?php
include_once "connection/conn.php";

switch($_GET['action']){
	case 'likejob' :
		likeJob($_POST['job_id'],$_POST['seeker_id']);
		break;
	case 'dislikejob' :
		dislikeJob($_POST['job_id'],$_POST['seeker_id']);
		break;
	case 'commentjob' :
		commentJob($_POST['job_id'],$_POST['seeker_id'],$_POST['company_id'],$_POST['comment']);
		break;
	case 'liketraining' :
		likeTraining($_POST['training_id'],$_POST['seeker_id'],$_POST['company_id']);
		break;
	case 'disliketraining' :
		dislikeTraining($_POST['training_id'],$_POST['seeker_id'],$_POST['company_id']);
		break;
	case 'commenttraining' :
		commentTraining($_POST['training_id'],$_POST['seeker_id'],$_POST['company_id'],$_POST['comment']);
		break;
	case 'likecompany' :
		likeCompany($_POST['company_id'],$_POST['seeker_id'],$_POST['training_id']);
		break;
	case 'dislikecompany' :
		dislikeCompany($_POST['company_id'],$_POST['seeker_id'],$_POST['training_id']);
		break;
	case 'commentcompany' :
		commentCompany($_POST['company_id'],$_POST['seeker_id'],$_POST['training_id'],$_POST['comment']);
		break;
	default: break;
}

// JOB
function likeJob($job_id,$seeker_id){
	$rs_check = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND seeker_id={$seeker_id} AND status='like'");
	$r_check = mysql_fetch_assoc($rs_check);

	if(!empty($r_check)){
		mysql_query("DELETE FROM tb_job_vote WHERE job_id={$job_id} AND seeker_id={$seeker_id} AND status='like'");
		$data = 'dislike this';
	}
	else {
		$dislike_check = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND seeker_id={$seeker_id} AND status='dislike'");
		$dl_check = mysql_fetch_assoc($dislike_check);
		if(!empty($dl_check)){
			mysql_query("UPDATE tb_job_vote SET status='like' WHERE job_id='{$job_id}' AND seeker_id='{$seeker_id}'");
			$data = 'dislike this';
		} else {
			mysql_query("INSERT INTO tb_job_vote (job_id,seeker_id,status) VALUES('{$job_id}','{$seeker_id}','like')");
			$data = 'like this';
		}
	}
	$like = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND status='like'");
	$dislike = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND status='dislike'");	
	$total['like'] = mysql_num_rows($like);
	$total['dislike'] = mysql_num_rows($dislike);
	$json['json'] = $total;
	echo json_encode($json);
	exit();
}

function dislikeJob($job_id,$seeker_id){
	$rs_check = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND seeker_id={$seeker_id} AND status='dislike'");
	$r_check = mysql_fetch_assoc($rs_check);

	if(!empty($r_check)){
		mysql_query("DELETE FROM tb_job_vote WHERE job_id={$job_id} AND seeker_id={$seeker_id} AND status='dislike'");
		$data = 'like this';
	}
	else {
		$like_check = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND seeker_id={$seeker_id} AND status='like'");
		$l_check = mysql_fetch_assoc($like_check);
		if(!empty($l_check)){
			mysql_query("UPDATE tb_job_vote SET status='dislike' WHERE job_id='{$job_id}' AND seeker_id='{$seeker_id}'");
			$data = 'dislike this';
		} else {
			mysql_query("INSERT INTO tb_job_vote (job_id,seeker_id,status) VALUES('{$job_id}','{$seeker_id}','dislike')");
			$data = 'like this';
		}
	}
	$like = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND status='like'");
	$dislike = mysql_query("SELECT * FROM tb_job_vote WHERE job_id={$job_id} AND status='dislike'");	
	$total['like'] = mysql_num_rows($like);
	$total['dislike'] = mysql_num_rows($dislike);
	$json['json'] = $total;
	echo json_encode($json);
	exit();
}

function commentJob($job_id,$seeker_id = null, $company_id = null, $comment) {
	if($company_id == null){
		mysql_query("INSERT INTO tb_job_comment (job_id,seeker_id,comment) VALUES('{$job_id}','{$seeker_id}','{$comment}')");
		$totals = mysql_query("SELECT * FROM tb_job_comment WHERE job_id={$job_id} AND seeker_id={$seeker_id}");
		//$sql = "SELECT * FROM tb_job_comment WHERE job_id={$job_id} AND seeker_id={$seeker_id}";
	}
	else if($seeker_id == null){
		mysql_query("INSERT INTO tb_job_comment (job_id,company_id,comment) VALUES('{$job_id}','{$company_id}','{$comment}')");
		$totals = mysql_query("SELECT * FROM tb_job_comment WHERE job_id={$job_id} AND company_id={$company_id}");
	}

	$total = mysql_num_rows($totals);
	echo json_encode($total);
	exit();
}


// TRAINING
function likeTraining($training_id,$seeker_id = null, $company_id = null){
	$rs_check = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND (seeker_id={$seeker_id} OR company_id={$company_id}) AND status='like'");
	$r_check = mysql_fetch_assoc($rs_check);

	if(!empty($r_check)){
		mysql_query("DELETE FROM tb_training_vote WHERE training_id={$training_id} AND (seeker_id={$seeker_id} OR company_id={$company_id}) AND status='like'");
		$data = 'dislike this';
	}
	else {
		$dislike_check = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND (seeker_id={$seeker_id} OR company_id={$company_id}) AND status='dislike'");
		$dl_check = mysql_fetch_assoc($dislike_check);
		if(!empty($dl_check)){
			mysql_query("UPDATE tb_training_vote SET status='like' WHERE training_id='{$training_id}' AND (seeker_id={$seeker_id} OR company_id={$company_id})");
			$data = 'dislike this';
		} else {
			mysql_query("INSERT INTO tb_training_vote (training_id,seeker_id,company_id,status) VALUES('{$training_id}','{$seeker_id}','{$company_id}','like')");
			$data = 'like this';
		}
	}
	$like = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND status='like'");
	$dislike = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND status='dislike'");
	$total['like'] = mysql_num_rows($like);
	$total['dislike'] = mysql_num_rows($dislike);
	$json['json'] = $total;
	echo json_encode($json);
	exit();
}

function dislikeTraining($training_id,$seeker_id = null, $company_id = null){
	$rs_check = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND (seeker_id={$seeker_id} OR company_id={$company_id}) AND status='dislike'");
	$r_check = mysql_fetch_assoc($rs_check);

	if(!empty($r_check)){
		mysql_query("DELETE FROM tb_training_vote WHERE training_id={$training_id} AND (seeker_id={$seeker_id} OR company_id={$company_id}) AND status='dislike'");
		$data = 'like this';
	}
	else {
		$like_check = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND (seeker_id={$seeker_id} OR company_id={$company_id}) AND status='like'");
		$l_check = mysql_fetch_assoc($like_check);
		if(!empty($l_check)){
			mysql_query("UPDATE tb_training_vote SET status='dislike' WHERE training_id='{$training_id}' AND (seeker_id={$seeker_id} OR company_id={$company_id})");
			$data = 'dislike this';
		} else {
			mysql_query("INSERT INTO tb_training_vote (training_id,seeker_id,company_id,status) VALUES('{$training_id}','{$seeker_id}','{$company_id}','dislike')");
			$data = 'like this';
		}
	}
	$like = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND status='like'");
	$dislike = mysql_query("SELECT * FROM tb_training_vote WHERE training_id={$training_id} AND status='dislike'");
	$total['like'] = mysql_num_rows($like);
	$total['dislike'] = mysql_num_rows($dislike);
	$json['json'] = $total;
	echo json_encode($json);
	exit();
}

function commentTraining($training_id,$seeker_id = null, $company_id = null, $comment) {
	
	if($company_id == null){
		mysql_query("INSERT INTO tb_training_comment (training_id,seeker_id,comment) VALUES('{$training_id}','{$seeker_id}','{$comment}')");
	}
	else if($seeker_id == null){
		mysql_query("INSERT INTO tb_training_comment (training_id,company_id,comment) VALUES('{$training_id}','{$company_id}','{$comment}')");
	}
	exit();
}


// COMPANY
function likeCompany($company_id,$seeker_id = null, $training_id = null){
	$rs_check = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND (seeker_id={$seeker_id} OR training_id={$training_id}) AND status='like'");
	$r_check = mysql_fetch_assoc($rs_check);

	if(!empty($r_check)){
		mysql_query("DELETE FROM tb_company_vote WHERE company_id={$company_id} AND (seeker_id={$seeker_id} OR training_id={$training_id}) AND status='like'");
		$data = 'dislike this';
	}
	else {
		$dislike_check = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND (seeker_id={$seeker_id} OR training_id={$training_id}) AND status='dislike'");
		$dl_check = mysql_fetch_assoc($dislike_check);
		if(!empty($dl_check)){
			mysql_query("UPDATE tb_company_vote SET status='like' WHERE company_id='{$company_id}' AND (seeker_id={$seeker_id} OR training_id={$training_id})");
			$data = 'like this';
		} else {
			mysql_query("INSERT INTO tb_company_vote (company_id,seeker_id,training_id,status) VALUES('{$company_id}','{$seeker_id}','{$training_id}','like')");
			$data = 'like this';
		}
	}
	$like = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND status='like'");
	$dislike = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND status='dislike'");
	$total['like'] = mysql_num_rows($like);
	$total['dislike'] = mysql_num_rows($dislike);
	$json['json'] = $total;
	echo json_encode($json);
	exit();
}

function dislikeCompany($company_id,$seeker_id = null, $training_id = null){
	$rs_check = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND (seeker_id={$seeker_id} OR training_id={$training_id}) AND status='dislike'");
	$r_check = mysql_fetch_assoc($rs_check);

	if(!empty($r_check)){
		mysql_query("DELETE FROM tb_company_vote WHERE company_id={$company_id} AND (seeker_id={$seeker_id} OR training_id={$training_id}) AND status='dislike'");
		$data = 'like this';
	}
	else {
		$like_check = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND (seeker_id={$seeker_id} OR training_id={$training_id}) AND status='like'");
		$l_check = mysql_fetch_assoc($like_check);
		if(!empty($l_check)){
			mysql_query("UPDATE tb_company_vote SET status='dislike' WHERE company_id='{$company_id}' AND (seeker_id={$seeker_id} OR training_id={$training_id})");
			$data = 'dislike this';
		} else {
			mysql_query("INSERT INTO tb_company_vote (company_id,seeker_id,training_id,status) VALUES('{$company_id}','{$seeker_id}','{$training_id}','dislike')");
			$data = 'dislike this';
		}
	}
	$like = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND status='like'");
	$dislike = mysql_query("SELECT * FROM tb_company_vote WHERE company_id={$company_id} AND status='dislike'");
	$total['like'] = mysql_num_rows($like);
	$total['dislike'] = mysql_num_rows($dislike);
	$json['json'] = $total;
	echo json_encode($json);
	exit();
}

function commentCompany($company_id,$seeker_id = null, $training_id = null, $comment) {
	if($training_id == null){
		mysql_query("INSERT INTO tb_company_comment (company_id,seeker_id,comment) VALUES('{$company_id}','{$seeker_id}','{$comment}')");
	}
	else if($seeker_id == null){
		mysql_query("INSERT INTO tb_company_comment (company_id,training_id,comment) VALUES('{$company_id}','{$training_id}','{$comment}')");
	}
	exit();
}
?>