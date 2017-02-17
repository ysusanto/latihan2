<?php 
$username = "k3477807_root";
$password = "Kursuskerja123";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
//select a database to work with
$select_db = mysql_select_db("k3477807_kursuskerja",$dbhandle) or die("Could not select k3477807_kursuskerja");
?>