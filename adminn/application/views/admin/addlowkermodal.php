<?php
//session_start();
//
//require_once "../connection/conn.php";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if ($_POST["sbtSave"]) {
//        $sql = "INSERT INTO tb_job (company_id,title,salary,experience,benefits,description,work_location,
//									education_id,location_id,specialization_id,level_id) 
//				VALUES ('{$_POST['company_id']}','{$_POST['txtTitle']}','{$_POST['txtSalary']}',
//						'{$_POST['txtExperience']}','{$_POST['txtBenefits']}','{$_POST['txtDescription']}','{$_POST['txtWorkLocation']}',
//						'{$_POST['selEducation']}','{$_POST['selLocation']}','{$_POST['selSpecialization']}','{$_POST['selLevel']}')";
//        $insert = mysql_query($sql);
//        if ($insert == true) {
//            echo "<script type='text/javascript'>
//					alert('Tambah data lowongan berhasil.');
//					window.location='index.php?page=profile';
//				 </script>";
//        } else {
//            echo "<script type='text/javascript'>alert('Maaf, penambahan gagal.');</script>";
//        }
//    }
//}
?>
<div class="modal fade" id="addlowkerModal" tabindex="-1" role="dialog" aria-labelledby="addperusahaanModal" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color:#fff">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color:#fff">Tambah Perusahaan</h4>
            </div>
            <div class="modal-body" style="min-height:300px;">
                <form class="form-addlowker" id="addLokerForm" action="<?php echo base_url('perusahaan/addlowker'); ?>" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" id="txtcompany_id" name="company_id" value=""/>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtName">Job Title *</label>
                        <input class="form-control" type="text" name="txtTitle" placeholder="Job Title" required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="logo">Salary *</label>
                        <input class="form-control" type="text" name="txtSalary" placeholder="Salary" required/>
                        <div class="help-block with-errors"></div>

                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtDescription">Experience *</label>
                        <input  class="form-control" type="text" name="txtExperience" placeholder="Experience" required>                   
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="selIndustry">Benefits *</label>
                        <textarea  class="form-control" name="txtBenefits" rows="5" cols="30" required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext" for="txtAddress">Education *</label>
                        <select   class="form-control" name="selEducation">
                            <?php
                            if (isset($edukasi)) {
                                foreach ($edukasi as $a) {
                                    echo $a;
                                }
                            }
//                            $education = mysql_query("SELECT education_id, education FROM tb_education");
//                            while ($row = mysql_fetch_array($education)) {
//                                echo "<option value='{$row['education_id']}'>{$row['education']}</option>";
//                            }
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext" for="selLocation">Specialization *</label>
                        <select class="form-control" name="selSpecialization">
                            <?php
                             if (isset($spesialisasi)) {
                                foreach ($spesialisasi as $a) {
                                    echo $a;
                                }
                            }
//                            $spesialisasi = mysql_query("SELECT specialization_id, specialization FROM tb_specialization");
//                            while ($row = mysql_fetch_array($spesialisasi)) {
//                                echo "<option value='{$row['specialization_id']}'>{$row['specialization']}</option>";
//                            }
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtPostCode">Level *</label>
                        <select class="form-control" name="selLevel">
                            <?php
                            if (isset($level)) {
                                foreach ($level as $a) {
                                    echo $a;
                                }
                            }
                            
//                            $level = mysql_query("SELECT level_id, level FROM tb_level");
//                            while ($row = mysql_fetch_array($level)) {
//                                echo "<option value='{$row['level_id']}'>{$row['level']}</option>";
//                            }
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtPhone">Work Location *</label>
                        <textarea name="txtWorkLocation" class="form-control"  required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtFax">Location *</label>
                        <select class="form-control" name="selLocation">
                            <?php
                            if (isset($lokasi)) {
                                foreach ($lokasi as $a) {
                                    echo $a;
                                }
                            }
//                            $lokasi = mysql_query("SELECT location_id, location FROM tb_location");
//                            while ($row = mysql_fetch_array($lokasi)) {
//                                echo "<option value='{$row['location_id']}'>{$row['location']}</option>";
//                            }
                            ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtWebsite">Job Description *</label>
                        <textarea id="redactor" name="txtDescription" class="form-control" required></textarea>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label formtext w160" for="txtName">Expired Date</label>
                        <input class="form-control" type="date" name="txtExpDate" />
                        <div class="help-block with-errors"></div>
                    </div>


            </div>
            <div class="modal-footer" style="border-top: none;">
                <button class="btn btn-lg btn-primary btn-block" name="sbtSave" type="submit" id="submitAdd">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(
            function ()
            {
                $('#redactor').redactor();
            }
    );
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        dataType: 'json'
    };

    $('#addLokerForm').ajaxForm(options);

    function showRequest(formData, jqForm, options) {
//        $('#submitAdd').prop('disabled', true);
        return true;
    }

    function showResponse(data) {
        if (data.status == 1) {
            $('#addLokerForm').resetForm();
            $('#logoimg').attr('src', '');
            $('#addlowkerModal').modal('hide');
             $('#ok').show();
             $('#ok').text(data.msg);
//            alert(data.msg);
location.replace('<?php echo base_url();?>admin/viewlowongan')
            viewperusahaan();
        }  else {
             $('#gagal').show();
             $('#gagal').text(data.msg);
//            alert(data.msg);
            $('#submitAdd').prop('disabled', false);
        }
    }
</script>