<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pekerja_model
 *
 * @author ASUS
 */
class pekerja_model extends CI_Model {

    //put your code here
    function pekerja_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
    }

//    
    function viewpekerja() {
        $db = $this->load->database('default', TRUE);



        $sqlmenu = "SELECT * FROM tb_seeker";
        $query = $db->query($sqlmenu);

        $shop = array();
        $dataitem = array();
        $a = 1;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $posted = date("d M Y h:i", strtotime($row['posted']));
                $detailitem = "<a  href='" . base_url() . "pekerja/detail/" . $row['seeker_id'] . "' style=\"text-decoration:none;\" data-toggle=\"tooltip\" title=\"List Produk\"><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></a>";
//                $detaildelete = "<button onclick=\"addlowker('" . $row['company_id'] . "')\" type=\"button\" class=\"btn btn-info btn-sm\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></button>";
                $jsonshop['aaData'][] = array($row['firstname'] . " " . $row['lastname'], $row['email'], $row['phone'], $row['address'], $detailitem);
                $a++;
            }
        } else {
            $jsonshop['aaData'] = array();
        }
        return $jsonshop;
    }

    function getdetailpekerja($id) {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT tb_seeker.*
				FROM tb_seeker 
				WHERE tb_seeker.seeker_id='" . $id . "'";
//                print_r($sql);die(0);
        $query = $db->query($sql);
        $a = 1;
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['photo'] != null || $row['photo'] != '') {
                $row['logo'] = "data:image/jpg;base64," . base64_encode($row['photo']);
            } else {
                $row['logo'] = base_url() . "assets/img/default.jpg";
            }

            $sql = "SELECT tb_seeker_edu.*,tb_education.education
						FROM tb_seeker_edu 
						INNER JOIN tb_education ON tb_education.education_id=tb_seeker_edu.education_id
						WHERE tb_seeker_edu.seeker_id='" . $id . "'";
//                print_r($sql);die(0);
            $query1 = $db->query($sql);
            if($query1->num_rows()>0){
                $values=$query1->row_array();
            }else{
                $values='';
            }
             $sql = "SELECT tb_seeker_exp.*,tb_location.location,tb_specialization.specialization,tb_industry.industry
						FROM tb_seeker_exp
						INNER JOIN tb_location ON tb_location.location_id=tb_seeker_exp.location_id
						INNER JOIN tb_specialization ON tb_specialization.specialization_id=tb_seeker_exp.specialization_id
						INNER JOIN tb_industry ON tb_industry.industry_id=tb_seeker_exp.industry_id
						WHERE tb_seeker_exp.seeker_id='" . $id . "'";
//                print_r($sql);die(0);
            $query2 = $db->query($sql);
            if($query2->num_rows()>0){
                $exp=$query2->row_array();
                $exp['salary'] = number_format($exp['salary'],0,',','.');
            }else{
                $exp='';
            }
            
            
            $hsl = array("pribadi"=>$row,"edukasi"=>$values,"exp"=>$exp);
        } else {

            $hsl = null;
        }
        return $hsl;
    }

    function getlowonganexport() {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT  tb_job.job_id,tb_company.company_name,tb_job.title, tb_job.salary,tb_location.location,tb_job.posted 
		FROM tb_job
		INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
		INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
		ORDER BY tb_job.posted DESC";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $body = "<h3 class='title'>Lowongan</h3>
                <p class='info'>Total Lowongan : " . $query->num_rows() . "</p>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Lowongan Kerja</th>
					<th>Perusahaan</th>
					<th>Lokasi</th>
					<th>Gaji</th>
					<th>Tanggal Posting</th>
			</tr>
		</thead>
		<tbody>";
            foreach ($query->result_array() as $row) {
                $posted = date("d M Y h:i", strtotime($row['posted']));
                $body .= "<tr>
							<td>{$row['title']}</td>
							<td>{$row['company_name']}</td>
							<td align='center'>{$row['location']}</td>
							<td align='center' width='100'>Rp. {$row['salary']}</td>
							<td align='center' width='150'>{$posted}</td>						
						 </tr>";
            }
            $body .= "</tbody>
	</table>";
        } else {
            $body = "<h3 class='title'>Lowongan</h3>
                <p class='info'>Total Lowongan : 0</p>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Lowongan Kerja</th>
					<th>Perusahaan</th>
					<th>Lokasi</th>
					<th>Gaji</th>
					<th>Tanggal Posting</th>
			</tr>
		</thead>
		<tbody>
                <tr>
				<td colspan='5' align='center'>Kosong</td>
					
			</tr>";
            $body .= "</tbody>
	</table>";
        }
        return $body;
    }

}
