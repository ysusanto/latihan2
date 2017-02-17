<script>
$( document ).ready(function() {
         $('#formupdate').hide();
     });
</script>

<div class="container">
    <div id='view'><?php if(isset($view)){
        echo $view;
    }?></div>
    <div id='formupdate'>
        <div id='head' style='margin-bottom: 20px'><h1> UPDATE PROFILE TC (KURSUS)</h1></div>

        <form>
            <div class="modal-footer"></div>


            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="form-group">

                        <label  for="exampleInputEmail1">User Id :</label>
                        <?php echo 'User id database'; ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nama :</label>
                        <?php echo 'nama database'; ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Uploud Foto</label>
                        <input type="file" id="exampleInputFile">
                    </div>
                </div>

                <!--            <div class="col-xs-6 col-md-4"></div>
                            <div class="imgprofil" >
                
                                <img src="<?php echo base_url(); ?>assets/images/man.jpg" class="img-responsive" alt="Responsive image">
                            </div>-->
            </div><BR>
            <div class="modal-footer"></div>

            <div id='head' style='margin-bottom: 20px'><h4>INDUSTRI </h4></div>
            <div class="row">
                <?php
                $x = '';
                if (isset($industri)) {
                    foreach ($industri as $value) {
//

                        $x.= '<div class="col-xs-6 col-md-4"> 
                <label class="checkbox-inline">
                    <input type="checkbox" id="industri" name="industri[]" value="' . $value['id_industri'] . '">' . $value['nama'] . '
                </label></div>';
                    }
                }
                echo $x;
                ?>
                <!--            <div class="col-xs-6 col-md-4"> 
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> 
                                </label></div>-->
                <!--            <div class="col-xs-6 col-md-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2">  
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3">   
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="radio-inline">
                                    <input type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">   <?php echo '#database'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="radio-inline">
                                    <input type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">  <?php echo '#database'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="radio-inline">
                                    <input type="checkbox" name="inlineRadioOptions" id="inlineRadio3" value="option3">  <?php echo '#database'; ?>
                                </label></div>-->
            </div><br>
            <div class="modal-footer"></div>
            <!--            <div style='margin-bottom: 20px'><h4>SUB INDUSTRI</h4></div>
                        <div style='margin-bottom: 20px'><h6>IT/DATABASE</h6></div>
                        <div class="row">
                            <div class="col-xs-6 col-md-4"> 
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> <?php echo 'PROGRAMER'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox2" value="option2">  <?php echo 'DATABASE'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox3" value="option3">   <?php echo 'DESIGN'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="radio-inline">
                                    <input type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">   <?php echo '#database'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="radio-inline">
                                    <input type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">  <?php echo '#database'; ?>
                                </label></div>
                            <div class="col-xs-6 col-md-4">
                                <label class="radio-inline">
                                    <input type="checkbox" name="inlineRadioOptions" id="inlineRadio3" value="option3">  <?php echo '#database'; ?>
                                </label></div>-->
            <!--</div>-->
            <br>
            <div class="row">

                <div class="col-xs-6 col-md-4"> 
                    <div class="form-group">            
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="OTHER">
                    </div>
                </div></div><BR>
            <br>
            <div class="row">

<!--                <div class="col-xs-6 col-md-4"> 
                    <div class="form-group">            
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="OTHER">
                    </div>
                </div>-->
            </div><br>
            <div class="modal-footer"></div>
            <div style='margin-bottom: 20px'><h4>DESCRIPTION</h4></div>

            <div class="form-group">

                <textarea class="form-control" rows="2" id="desc"></textarea>
            </div>
            <div class="row">

                <div class="col-xs-6 col-md-4"> 
                    <div class="form-group">            
                        <input type="text" class="form-control" id="exampleInputEmail2" placeholder="WEBSITE">
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
            <button type="submit" class="btn btn-default" onclick='do_register()'>Submit</button>
        </form>
    </div>
</div>
<!--</div>-->
