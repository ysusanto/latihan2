<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Boleci</title>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/validator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.imagedrag.min.js"></script>
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/boleci.css" rel="stylesheet">
    
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #fff;border-bottom: solid 5px #297dc2;">
        <div class="container">
            <div class="navbar-header">              
                <a class="navbar-brand" href="<?php echo base_url(); ?>" style="padding-top:7px;"><img src="<?php echo base_url('assets/web/boleci_offline.png');?>" style="height:36px;"></a>
            </div>
            <div id="navbar">        
                <form class="navbar-form navbar-left" role="search" style="margin-left:20px;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" style="width:250px;">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true" style="height:20px;"></span></button>
                            </span>
                        </div>                      
                    </div>                  
                </form>
            </div>
            <div class="navbar-right">
                <div style="height:20px;margin-top:15px;margin-right:15px;">
                <?php 
                    $x='';
                    if($username){
                        $x .= '<span style="font-size:14px;font-weight:bold;">'.$username.'&nbsp;</span><a href="'.base_url('manage/logout').'">(logout)</a>';
                    }
                    echo $x;
                ?>
                </div>
            </div>
        </div>
    </nav>
    
    