<?php
session_start();

require_once "../connection/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["sbtSave"]) {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $companyid=$_SESSION['company_id'];
        $username = $_SESSION["company_name"];
        $sql = "INSERT INTO tb_job (company_id,title,salary,experience,benefits,description,work_location,
									education_id,location_id,specialization_id,level_id,status,expired_date,create_date,create_by,modified_date,modified_by) 
				VALUES ('{$companyid}','{$_POST['txtTitle']}','{$_POST['txtSalary']}',
						'{$_POST['txtExperience']}','{$_POST['txtBenefits']}','{$_POST['txtDescription']}','{$_POST['txtWorkLocation']}',
						'{$_POST['selEducation']}','{$_POST['selLocation']}','{$_POST['selSpecialization']}','{$_POST['selLevel']}','1','{$_POST['txtExpDate']}','{$tgl}','{$username}','{$tgl}','{$username}')";
//        print_r($sql);die(0);
                                                $insert = mysql_query($sql);
        if ($insert == true) {
            echo "<script type='text/javascript'>
					alert('Tambah data lowongan berhasil.');
					window.location='index.php?page=profile';
				 </script>";
        } else {
            echo "<script type='text/javascript'>alert('Maaf, penambahan gagal.');</script>";
        }
    }
}
?>
<div id="content-form">
    <h2>Lowongan Pekerjaan</h2>
    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtName">Job Title*</label>
            <div class="col-sm-10">
            <input class="form-control" type="text" name="txtTitle" placeholder="Job Title" required />
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="logo">Salary*</label>
            <div class="col-sm-10">
            <input class="form-control" type="text" name="txtSalary" placeholder="Salary" required/>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtDescription">Experience*</label>
            <div class="col-sm-10">
            <input  class="form-control" type="text" name="txtExperience" placeholder="Experience" required>                   
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="selIndustry">Benefits*</label>
            <div class="col-sm-10">
            <textarea  class="form-control" name="txtBenefits" rows="5" cols="30" required></textarea>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtAddress">Education*</label>
            <div class="col-sm-10">
            <select   class="form-control" name="selEducation">
                <?php
                $education = mysql_query("SELECT education_id, education FROM tb_education");
                while ($row = mysql_fetch_array($education)) {
                    echo "<option value='{$row['education_id']}'>{$row['education']}</option>";
                }
                ?>
            </select>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label formtext" for="selLocation">Specialization*</label>
            <div class="col-sm-10">
            <select class="form-control" name="selSpecialization">
                <?php
                $spesialisasi = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
                while ($row = mysql_fetch_array($spesialisasi)) {
                    echo "<option value='{$row['specialization_id']}'>{$row['specialization']}</option>";
                }
                ?>
            </select>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPostCode">Level*</label>
            <div class="col-sm-10">
            <select class="form-control" name="selLevel">
                <?php
                $level = mysql_query("SELECT level_id, level FROM tb_level");
                while ($row = mysql_fetch_array($level)) {
                    echo "<option value='{$row['level_id']}'>{$row['level']}</option>";
                }
                ?>
            </select>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtPhone">Work Location*</label>
            <div class="col-sm-10">
            <textarea name="txtWorkLocation" class="form-control"  required></textarea>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtFax">Location*</label>
            <div class="col-sm-10">
            <select class="form-control" name="selLocation">
                <?php
                $lokasi = mysql_query("SELECT location_id, location FROM tb_location");
                while ($row = mysql_fetch_array($lokasi)) {
                    echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
                }
                ?>
            </select>
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtWebsite">Job Description*</label>
            <div class="col-sm-10">
            <textarea id="redactor" name="txtDescription" class="form-control" required></textarea>
            <div class="help-block with-errors"></div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label" for="txtName">Expired Date</label>
            <div class="col-sm-10">
            <input class="form-control" type="date" name="txtExpDate" />
            <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="form-footer">
            <input type="submit" class="btn" name="sbtSave" value="Save" />
            <a href="index.php?page=profile" class="btn">Cancel</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(
            function ()
            {
                $('#redactor').redactor();
            }
    );
</script>