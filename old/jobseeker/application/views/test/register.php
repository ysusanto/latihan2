<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Boleci</title>
<script type="text/javascript" src="script/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>
<script type="text/javascript" src="script/dist/js/bootstrap.js"></script>
<script type="text/javascript" src="script/combodate-1.0.7/combodate.js"></script>
<script type="text/javascript" src="script/combodate-1.0.7/moment.min.js"></script>
<link href="script/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="script/boleci.css" rel="stylesheet">
<script>
    $( document ).ready(function() {
        $('#dob').combodate(); 
        
        $('#registerform').ajaxForm({          
            success: callback,
            error: AjaxError                               
        });
        
        $('#loginform').ajaxForm({          
            success: callback,
            error: AjaxError                               
        });
    });
    
    function callback(responseText, statusText) {
        alert(responseText);
    }
    
    function AjaxError() {
	alert("Error saving to database");
    }
    
    function register(){
        $('#registerform').trigger('submit');
    }
    function login(){
        $('#loginform').trigger('submit');
    }
</script>
</head>
<body>
<div id="wrapper">
	<div id="header" class="navbar-fixed-top">
    	<div id="headerwrap">
        	<div id="logo"><img src="assets/logo.png" /></div>
            <div id="searcharea"><input type="text" name="search_txt" placeholder="Search" class="form-control" style="width:250px;height:30px;background-image:url(assets/search.png);background-position:230px 8px;background-repeat:no-repeat;background-size:15px;"></div>
            <div id="accountarea">
            	<div id="loginarea1">
                        <form id="loginform" name="loginform" method="post" autocomplete="off"  enctype="multipart/form-data" action="<?php echo base_url(); ?>login">
                    <div class="loginform">
                        <input type="text" name="email" placeholder="Email" class="form-control" style="height:22px;margin-top:7px;background-color:#F8F8F8;border-radius:7px;width:160px;float:left;padding:0px 12px;">
                    </div>
                    <input type="checkbox" name="remember" value="remember" style="margin-right:10px;"><span style="font-size: 12px;">Remember me</span>
                </form>
                </div>
                <div id="loginarea2">
                    <div class="loginform">
                        <input type="password" name="pass" placeholder="Password" class="form-control" style="height:22px;margin-top:7px;background-color:#F8F8F8;border-radius:7px;width:160px;float:left;padding:0px 12px;">
                    </div>
                    <div class="loginform2">
                        <span style="font-size: 12px;"><a href="<?php base_url();?>register">Register</a>  |  Forget Password?</span> 
                    </div>
                </div>
                <div id="loginbuttonarea">
                        <input type="image" src="<?php echo base_url();?>assets/login.png" alt="Submit" style="margin-top:7px;float:right;">
                </div>
            </div>
        </div>
        <div id="menu"></div>
    </div>
    
    <div id="content" style="margin-top:91px">
        <div id="wrapcontent">
            <div class="round" style="width:100%;min-height:500px;">
                <div class="title" style="float:left;">
                    <span style="font-size: 20px;font-weight: bold;margin-left:20px;">Register</span>
                </div>
                <div class="title2" style="float:left;">
                </div>
                <form id="registerform" name="registerform" method="post" autocomplete="off"  enctype="multipart/form-data" action="<?php echo base_url(); ?>doregister">
                    <table align="center" style="margin-top:40px;">
                        <tr class="registertr">
                            <td style="width:300px"><span><b>First Name*</b></span><br/></td>
                            <td><input type="text" class="form-control" style="width:500px;" id="title" name="firstname" placeholder="First Name" required autofocus ></td>
                        </tr>
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Last Name</b></span><br/></td>
                            <td><input type="text" class="form-control" style="width:500px;" id="title" name="lastname" placeholder="Last Name" required autofocus ></td>
                        </tr>
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Email</b></span><br/></td>
                            <td><input type="email" class="form-control" style="width:500px;" id="title" name="email" placeholder="example@boleci.com"  required autofocus ></td>
                        </tr>
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Password</b></span><br/></td>
                            <td><input type="password" class="form-control" style="width:500px;" id="title" name="password"  required></td>
                        </tr>
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Confirm Password</b></span><br/></td>
                            <td><input type="password" class="form-control" style="width:500px;" id="title" name="confirmpassword" required></td>
                        </tr>
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Gender</b></span><br/></td>
                            <td>&nbsp<input type="radio" name="sex" value="male" checked> Male &nbsp
                                <input type="radio" name="sex" value="female"> Female
                            </td>
                        </tr> 
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Date Of Birth</b></span><br/></td>
                            <td>
                                <input type="text" id="dob" data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="dob" value="<?php echo date('d-m-Y');?>" required>
                            </td>
                        </tr>     
                        <tr class="registertr">
                            <td style="width:300px"><span><b>Phone Number</b></span><br/></td>
                            <td><input type="text" class="form-control bfh-phone" data-country="ID" required></td>
                        </tr>
                    </table> 
                    <div id="registerbtndiv">
                        <div id="registerbtn">
                            <input type="image" src="<?php echo base_url();?>assets/createanaccount.png" alt="Submit" style="margin:0 auto;">
                        </div>
                    </div>
                    &nbsp;<br/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>