

<div class="container">
    <div id='head' style='margin-bottom: 20px'><h1> UPDATE PROFILE PERUSAHAAN</h1></div>

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
            <div class="col-xs-6 col-md-4"> 
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="option1"> <?php echo '#database'; ?>
                </label></div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="option2">  <?php echo '#database'; ?>
                </label></div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox3" value="option3">   <?php echo '#database'; ?>
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
                </label></div>
        </div><br>
       
        <div class="row">

            <div class="col-xs-6 col-md-4"> 
                <div class="form-group">            
                    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="OTHER">
                </div>
            </div>
        </div><br>
       
        <div style='margin-bottom: 20px'><h4>DESCRIPTION</h4></div>

        <div class="form-group">

            <textarea class="form-control" rows="2" id="comment"></textarea>
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
