<?php
session_start();
require_once "connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["sbtApply"]) {
        if ($_SESSION["seeker_id"] == null) {
            echo "<script type='text/javascript'>
					alert('Silahkan Login terlebih dahulu.');
					window.location='index.php?page=login';
				 </script>";
        } else {
            $rs_cek = mysql_query("SELECT * FROM tb_apply_job WHERE seeker_id='{$_SESSION['seeker_id']}' AND job_id='{$_GET['id']}'");
            $rs = mysql_fetch_assoc($rs_cek);
            if (!empty($rs)) {
                echo "<script type='text/javascript'>
						alert('Anda telah mengirim lamaran untuk pekerjaan ini.');
						window.location='index.php?page=view-job&id={$_GET['id']}';
					 </script>";
            } else {
                $sql = "INSERT INTO tb_apply_job (seeker_id,job_id) VALUES ('{$_SESSION['seeker_id']}','{$_GET['id']}')";
                $result = mysql_query($sql);
                if ($result == true) {
                    echo "<script type='text/javascript'>
						alert('Lamaran berhasil di kirim.');
						window.location='index.php?page=view-job&id={$_GET['id']}';
					 </script>";
                } else {
                    echo "<script type='text/javascript'>
						alert('Lamaran gagal dikirim.');
					 </script>";
                }
            }
        }
    }
} else {
    $sql = "SELECT  tb_job.title,tb_job.salary,tb_job.experience,tb_job.benefits,tb_job.description,
					tb_job.work_location,tb_education.education_id,tb_location.location,tb_specialization.specialization,tb_level.level,
					tb_company.company_id,tb_company.email,tb_company.company_name,tb_company.description AS 'company_desc',
					tb_company.address,tb_industry.industry,tb_company.phone,tb_company.website 
			FROM tb_job
			INNER JOIN tb_location ON tb_location.location_id=tb_job.location_id
			INNER JOIN tb_education ON tb_education.education_id=tb_job.education_id
			INNER JOIN tb_specialization ON tb_specialization.specialization_id=tb_job.specialization_id
			INNER JOIN tb_level ON tb_level.level_id=tb_job.level_id
			INNER JOIN tb_company ON tb_company.company_id=tb_job.company_id
			INNER JOIN tb_industry ON tb_industry.industry_id=tb_company.industry_id
			WHERE tb_job.job_id={$_GET['id']}";

    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
}
?>
<div id="job-action">
    <!--	<form action="" method="post">
                    <input type="submit" name="sbtApply" class="btn" value="Lamar Sekarang"/>
                     <a href="#" class="btn">Lamar Sekarang</a> 
            </form>-->
</div>
<div id="view-job">
    <table>
        <tr>
            <td>
                <div id="job-detail">
                    <h3>Deskripsi Pekerjaan</h3>
                    <?php echo $row["description"]; ?>
                    <br /><br />

                    <h3>Lokasi Kerja</h3>
                    <?php echo $row["work_location"] . " " . $row["location"]; ?>

                </div>
            </td>
            <td width="350">
                <div id="company-detail">
                    <h3>Detail Perusahaan</h3>
                    <div id="detail">
                        <!--<div class="row">-->
                            <!--adad-->
                            <dl >
                                <dt>Nama Perusahaan</dt>
                                <dd><?php echo $row['company_name']; ?></dd>
                                
                                <dt>Industri</dt>
                                <dd><?php echo $row['industry']; ?></dd>
                                
                                <dt>Website</dt>
                                <dd><a href="<?php echo $row['website']; ?>" target="_blank" ><?php echo $row['website']; ?></a></dd>
                                
                                <dt>Telepon</dt>
                                <dd><?php echo $row['phone']; ?></dd>
                                
                                <dt>Email</dt>
                                <dd><a href="mailto:#"><?php echo $row['email']; ?></a></dd>
                                <dt>Alamat</dt>
                                <dd><address><?php echo $row['address'] . " " . $row['location']; ?></address></dd>
                            </dl>
                        <!--</div>-->
                    </div>
                    
                    <h3>Tentang Perusahaan</h3>
                    <?php echo $row["company_desc"]; ?>
                </div>
            </td>
        </tr>
    </table>
</div>