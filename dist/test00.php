<?php 
$rootURLmanage = "http://development.roundstone.besaba.com/jios/manage/";
$rootURL = "http://development.roundstone.besaba.com/jios/";
$mySQLAddress = "mysql.hostinger.jp";
$mainDbUserName = "u406628090_root2";
$mainDbPass = "rnw1234";
$mainDbName = "u406628090_demo";

header("Content-type: text/html; charset=utf-8");

$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
$result = $mysqli->query("SELECT COUNT(id) FROM msg");

$row = $result->fetch_assoc();

echo (var_dump($row['COUNT(id)']));

 ?>