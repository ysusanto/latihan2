<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lowongan_model
 *
 * @author ASUS
 */
class lowongan_model extends CI_Model {

    //put your code here
    function lowongan_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function viewlowongan() {
        $db = $this->load->database('default', TRUE);



        $sqlmenu = "SELECT  tb_job.status,tb_job.job_id,tb_company.company_name,tb_job.title, tb_job.salary,tb_location.location,tb_job.posted 
		FROM tb_job
		INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
		INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
		ORDER BY tb_job.posted DESC";
        $query = $db->query($sqlmenu);

        $shop = array();
        $dataitem = array();
        $a = 1;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $posted = date("d M Y h:i", strtotime($row['posted']));
                $delete = "<a  onclick='deleted('" . $row['job_id'] . "')' style=\"text-decoration:none;\" data-toggle=\"delete\" title=\"Delete\"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>";
                $detailitem = "<a  href='" . base_url() . "lowongan/detail/" . $row['job_id'] . "' style=\"text-decoration:none;\" data-toggle=\"tooltip\" title=\"List Produk\"><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></a>";
                if($row['status']=='0'){
                $stat = "<button onclick=\"statlow('" . $row['job_id'] . "')\" type=\"button\" class=\"btn btn-info btn-sm\"><span class=\"glyphicon glyphicon-minus-sign\" aria-hidden=\"true\"></span></button>";
                }else{
                $stat = "<button onclick=\"statlow('" . $row['job_id'] . "')\" type=\"button\" class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span></button>";    
                }
                $jsonshop['aaData'][] = array($row['title'], $row['company_name'], $row['location'], "Rp. " . $row['salary'], $posted, $detailitem." ".$delete);
                $a++;
            }
        } else {
            $jsonshop['aaData'] = array();
        }
        return $jsonshop;
    }

    function getdetaillowongan($id) {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT  tb_job.title,tb_job.salary,tb_job.experience,tb_job.benefits,tb_job.description,
				tb_job.work_location,tb_education.education,tb_location.location,tb_specialization.specialization,tb_level.level,
				tb_company.company_id,tb_company.email,tb_company.company_name,tb_company.description AS 'company_desc',
				tb_company.address,tb_industry.industry,tb_company.phone,tb_company.website 
		FROM tb_job
		INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
		INNER JOIN tb_education ON tb_education.education_id=tb_job.education_id
		INNER JOIN tb_specialization ON tb_specialization.specialization_id=tb_job.specialization_id
		INNER JOIN tb_level ON tb_level.level_id=tb_job.level_id
		INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_company.industry_id
		WHERE tb_job.job_id={$id}";
//                print_r($sql);die(0);
        $query = $db->query($sql);
        $a = 1;
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $hsl = $row;
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
                $posted = date("d M Y h:i",strtotime($row['posted']));
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
