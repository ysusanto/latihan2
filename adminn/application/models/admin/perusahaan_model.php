<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of perusahaan_model
 *
 * @author ASUS
 */
class perusahaan_model extends CI_Model {

    function shopitem_model() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('date');
//        $this->load->model('ws_global_model', 'globalmodel');
    }

    function viewperusahaan() {
        $db = $this->load->database('default', TRUE);



        $sqlmenu = "SELECT  tb_company.company_id,tb_company.email,tb_company.company_name,tb_company.address,tb_location.location,tb_company.phone
		FROM tb_company
		INNER JOIN tb_location ON tb_location.location_id=tb_company.location_id";
        $query = $db->query($sqlmenu);

        $shop = array();
        $dataitem = array();
        $a = 1;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
//                $dataitem['cond'] = array(
//                    'shop_id' => $row['_id'],
//                    'fdelete' => '1'
//                );
//                $dataproduct = $this->Get_Item($dataitem);
//                $row['shop_id'] = $row['_id']->{'$id'};
//                $row['lokasi_id'] = ($row['lokasi_id'] != '' ? $row['lokasi_id']->{'$id'} : '');
//                unset($row['_id']);
//                $datauser = $this->globalmodel->getOneRecordWithCond($cond, 'tuser');
//                $datalogin = $this->globalmodel->getOneRecordWithCond(array('user_id' => $row['user_id']), 'tlogin');
                $delete = "<button onclick=\"deleted('" . $row['company_id'] . "')\" style=\"text-decoration:none;\" data-toggle=\"tooltip\" title=\"Delete\" data-placement=\"right\" type=\"button\" class=\"btn btn-primary btn-xs\"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>";
                $detailitem = "<a  href='" . base_url() . "perusahaan/detail/" . $row['company_id'] . "' style=\"text-decoration:none;\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"List Produk\"><button type=\"button\" class=\"btn btn-primary btn-xs\"><span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span></button></a>";
                $detaildelete = "<button onclick=\"addlowker('" . $row['company_id'] . "')\" type=\"button\" class=\"btn btn-primary btn-xs\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></button>";
                $jsonshop['aaData'][] = array($row['company_name'], $row['location'], $row['email'], $row['phone'], $detailitem . " | " . $delete, $detaildelete);
                $a++;
            }
        } else {
            $jsonshop['aaData'] = array();
        }
        return $jsonshop;
    }

    function registerPerusahaan($data) {
        $db = $this->load->database('default', TRUE);
        $password = sha1($data["txtPassword"]);
        $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
        //$logo = file_get_contents($_FILES['logo']['tmp_name']);
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d H:i:s');
        $username = $this->session->userdata('username');
         $sqltemp = "INSERT INTO tb_temp_passw (nama,password,create_date) 
				VALUES ('{$data['txtName']}',
						'{$data["txtPassword"]}',
						'{$tanggal}')";

        $inserttemp = $db->query($sqltemp);
        $sql = "INSERT INTO tb_company (email,password,company_name,company_logo,
										description,address,industry_id,location_id,post_code,
										phone,fax,website,contact_person,create_by,create_date,modified_by,modified_date) 
				VALUES ('{$data['txtEmail']}',
						'{$password}',
						'{$data['txtName']}',
						'{$logo}',
						'{$data['txtDescription']}',
						'{$data['txtAddress']}',
						'{$data['selIndustry']}',
						'{$data['selLocation']}',
						'{$data['txtPostCode']}',
						'{$data['txtPhone']}',
						'{$data['txtFax']}',
						'{$data['txtWebsite']}',
						'{$data['txtCP']}',
						'{$username}',
						'{$tanggal}',
						'{$username}',
						'{$tanggal}')";

        $insert = $db->query($sql);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }

        // untuk mengirim keterangan pendaftaran ke email
        /*
          $message = "Kepada Yth. {$_POST['txtName']}, <br /><br />
          Untuk mengaktifkan akun Anda, silahkan lakukan pembayaran untuk Akun yang Anda daftarkan degan rincian sebagai berikut : <br /><br />
          - Paket Valid : {$row['month']} Bulan <br />
          - Maksimum Lowongan : {$row['job']} <br />
          - Harga + ppn 10% : Rp. {$price},-<br /><br />
          Silahkan tansfer ke Akun : <br />
          - Bank : Mandiri <br />
          - No. Rek : 123-00-0000123-99-0 <br />
          - Atas Nama : Cari Kerja dot com <br /><br />
          Terima Kasih.";

          $to = $_POST['txtEmail'];
          $subject = "Selamat datang di CariKerja";
          $message = $message;
          $headers = "From: admin@carikerja.com";

          mail($to, $subject, $message, $headers); */
    }

    function addLowongan($data) {
        $db = $this->load->database('default', TRUE);
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $username = $this->session->userdata('username');

        $sql = "INSERT INTO tb_job (status,company_id,title,salary,experience,benefits,description,work_location,
									education_id,location_id,specialization_id,level_id,status,expired_date,create_date,create_by,modified_date,modified_by) 
				VALUES ('1',{$data['company_id']}','{$data['txtTitle']}','{$data['txtSalary']}',
						'{$data['txtExperience']}','{$data['txtBenefits']}','{$data['txtDescription']}','{$data['txtWorkLocation']}',
						'{$data['selEducation']}','{$data['selLocation']}','{$data['selSpecialization']}','{$data['selLevel']}','1',{$data['txtExpDate']}','{$tgl}','{$username}','{$tgl}','{$username}')";
        $insert = $db->query($sql);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    function getdetailprofile($id) {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT  tb_company.company_id,
				tb_company.email,  
				tb_company.company_name,
				tb_company.company_logo,  
				tb_company.description,
				tb_company.address,  
				tb_industry.industry,  
				tb_location.location,  
				tb_company.phone,  
				tb_company.website
		FROM tb_company
		INNER JOIN tb_industry ON tb_industry.industry_id=tb_company.industry_id
		INNER JOIN tb_location ON tb_location.location_id=tb_company.location_id
		WHERE tb_company.company_id={$id}";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $row['nama'] = $row['company_name'];
            if ($row['company_logo'] != null || $row['company_logo'] != '') {
                $row['logo'] = "data:image/jpg;base64," . base64_encode($row['company_logo']);
            } else {
                $row['logo'] = base_url() . "assets/img/default.jpg";
            }
            $hsl = $row;
        } else {
            $hsl = null;
        }
        return $hsl;
    }

    function getperusahaanexport() {
        $db = $this->load->database('default', TRUE);
        $sql = "SELECT  tb_company.company_id,tb_company.email,tb_company.company_name,tb_company.address,tb_location.location,tb_company.phone
		FROM tb_company
		INNER JOIN tb_location ON tb_location.location_id=tb_company.location_id";
        $query = $db->query($sql);
        if ($query->num_rows() > 0) {
            $body = "<h3 class='title'>Perusahaan</h3>
                <p class='info'>Total Perusahaan : " . $query->num_rows() . "</p>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Nama Perusahaan</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>
			</tr>
		</thead>
		<tbody>";
            foreach ($query->result_array() as $row) {
                $body .= "<tr>
							<td>{$row['company_name']}</td>
							<td>{$row['address']}</td>
							<td align='center'>{$row['location']}</td>
							<td align='center'>{$row['email']}</td>
							<td align='center' width='110'>{$row['phone']}</td>						
						 </tr>";
            }
            $body .= "</tbody>
	</table>";
        } else {
            $body = "<h3 class='title'>Perusahaan</h3>
                <p class='info'>Total Perusahaan : 0</p>
	<table id='seeker' class='dataprint'>
		<thead>
			<tr>
				<th>Nama Perusahaan</th>
				<th>Alamat</th>
				<th>Lokasi</th>
				<th>Email</th>
				<th>No. Telepon</th>
			</tr>
		</thead>
		<tbody>";
            $body .= "</tbody>
	</table>";
        }
        return $body;
    }

    function deleteperusahaan($data) {
        
    }

    //put your code here
}
