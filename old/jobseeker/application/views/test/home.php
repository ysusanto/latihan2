<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Boleci</title>
<script type="text/javascript" src="script/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="script/jquery.form.js"></script>
<script type="text/javascript" src="script/dist/js/bootstrap.js"></script>
<link href="script/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="script/boleci.css" rel="stylesheet">
</head>

<body>
<div id="wrapper">
	<div id="header" class="navbar-fixed-top">
    	<div id="headerwrap">
        	<div id="logo"><img src="assets/logo.png" /></div>
            <div id="searcharea"><input type="text" name="search_txt" placeholder="Search" class="form-control" style="width:250px;height:30px;background-image:url(assets/search.png);background-position:230px 8px;background-repeat:no-repeat;background-size:15px;"></div>
            <div id="accountarea">
            	<div id="loginarea1">
                    <div class="loginform">
                        <input type="text" name="email" placeholder="Email" class="form-control" style="height:22px;margin-top:7px;background-color:#F8F8F8;border-radius:7px;width:160px;float:left;padding:0px 12px;">
                    </div>
                    <input type="checkbox" name="remember" value="remember" style="margin-right:10px;"><span style="font-size: 12px;">Remember me</span>
                </div>
                <div id="loginarea2">
                    <div class="loginform">
                        <input type="password" name="pass" placeholder="Password" class="form-control" style="height:22px;margin-top:7px;background-color:#F8F8F8;border-radius:7px;width:160px;float:left;padding:0px 12px;">
                    </div>
                    <div class="loginform2">
                        <span style="font-size: 12px;"><a href="<?php base_url();?>testing/register">Register</a>  |  Forget Password?</span> 
                    </div>
                </div>
                <div id="loginbuttonarea">
                	<img src="assets/login.png" style="margin-top:7px;float:right;" />
                </div>
            </div>
        </div>
        <div id="menu"></div>
    </div>
    <div id="banner"></div>
    <div id="content" style="height:1000px"></div>
</div>
</body>
</html>