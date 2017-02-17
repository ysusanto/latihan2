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
class training_model extends CI_Model {

    //put your code here
    function training_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
    }

//    
    function viewtraining() {
        $db = $this->load->database('default', TRUE);



        $sqlmenu = "SELECT  tb_training.training_id,tb_training.email,tb_training.training_name,tb_training.address,tb_location.location,tb_training.phone
		FROM tb_training
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id";
        $query = $db->query($sqlmenu);

        $shop = array();
        $dataitem = array();
        $a = 1;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $posted = date("d M Y h:i", strtotime($row['posted']));
                $delete = "<a  onclick='deleted('" . $row['training_id'] . "')' style=\"text-decoration:none;\" data-toggle=\"delete\" title=\"Delete\"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>";
                $detailitem = "<a  href='" . base_url() . "training/detail/" . $row['training_id'] . "' style=\"text-decoration:none;\" data-toggle=\"tooltip\" title=\"List Produk\"><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></a>";
//                $detaildelete = "<button onclick=\"addlowker('" . $row['company_id'] . "')\" type=\"button\" class=\"btn btn-info btn-sm\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></button>";
                $jsonshop['aaData'][] = array($row['training_name'] , $row['address'], $row['location'], $row['email'],$row['phone'], $detailitem." ".$delete);
                $a++;
            }
        } else {
            $jsonshop['aaData'] = array();
        }
        return $jsonshop;
    }

    function getdetailtraining($id) {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT  tb_training.training_id,
				tb_training.email,  
				tb_training.training_name,
				tb_training.training_logo,  
				tb_training.description,
				tb_training.address,  
				tb_industry.industry,  
				tb_location.location,  
				tb_training.phone,  
				tb_training.website
		FROM tb_training
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_training.industry_id
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id
		WHERE tb_training.training_id='".$id."'";
//                print_r($sql);die(0);
        $query = $db->query($sql);
        $a = 1;
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['training_logo'] != null || $row['training_logo'] != '') {
                $row['logo'] = "data:image/jpg;base64," . base64_encode($row['training_logo']);
            } else {
                $row['logo'] = base_url() . "assets/img/default.jpg";
            }

            
            
            $hsl = $row;
        } else {

            $hsl = null;
        }
        return $hsl;
    }

    function gettrainingexport() {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT  tb_training.training_id,tb_training.email,tb_training.training_name,tb_training.address,tb_location.location,tb_training.phone
		FROM tb_training
		INNER JOIN tb_location ON tb_location.location_id=tb_training.location_id";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $body = "<h3 class='title'>Tempat Kursus</h3>
                <p class='info'>Total Tempat Kursus : " . $query->num_rows() . "</p>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Nama Tempat Kursus</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>	
			</tr>
		</thead>
		<tbody>";
            foreach ($query->result_array() as $row) {
//                $posted = date("d M Y h:i", strtotime($row['posted']));
                $body .= "<tr>
							<td>{$row['training_name']}</td>
							<td>{$row['address']}</td>
							<td align='center'>{$row['location']}</td>
							<td align='center'>{$row['email']}</td>
							<td align='center' width='110'>{$row['phone']}</td>						
						 </tr>";
            }
            $body .= "</tbody>
	</table>";
        } else {
            $body = "<h3 class='title'>Tempat Kursus</h3>
                <p class='info'>Total Tempat Kursus : 0</p>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Nama Tempat Kursus</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>	
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
