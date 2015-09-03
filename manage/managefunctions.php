<?php
session_start();
ini_set('display_errors', 'Off');

$rootURLmanage = "http://development.roundstone.besaba.com/jios/manage/";
$rootURL = "http://development.roundstone.besaba.com/jios/";
$mySQLAddress = "mysql.hostinger.jp";
$mainDbUserName = "u406628090_root2";
$mainDbPass = "rnw1234";
$mainDbName = "u406628090_demo";

if ($_GET['logout']=="YES") {
	header("Location: {$rootURL}manage/managelogin.php?logout=YES");
}

if (!isset($_SESSION['basicAuth'])){
	session_start();
	header("Location:{$rootURL}basicAuth.php");
}elseif (!isset($_SESSION)){
	if (!isset($_SESSION['managenamge'])) {
		if ($_GET['logout']=="YES") {
			session_start();
			header("Location: {$rootURL}manage/managelogin.php?logout=YES");
		}else{
			session_start();
			header("Location:{$rootURLmanage}managelogin.php");
		}
	}
	session_start();
	header("Location {$rootURL}basicAuth.php");
}

$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
if ($mysqli->connect_error){
	$mysqli->close();
	exit();
}

$msg_row = array();
$query_str_msg = "SELECT msg FROM msg";
$msg_result = $mysqli->query($query_str_msg);
if (!$msg_result){
	exit();
}else {

	while ($rowrow = $msg_result->fetch_assoc()) {
		$msg_row[] = $rowrow;
	}

	// $msg_row = $msg_result->fetch_array();
}

echo <<< EOT
	<style>
		body { padding-top: 51px; }
	</style>
EOT;

function rewrite($var){
	$ver=null;
}

function manage_login($manage_id,$manage_pass){

	global $mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName,$rootURLmanage,$mysqli,$msg_row;

	$query_str_managelogin = "SELECT * FROM admin_user WHERE admin_un = '".$manage_id."'";
	$manage_result = $mysqli->query($query_str_managelogin);
	if (!$manage_result){
		exit();
	}else {
		while ($manage_row = $manage_result->fetch_assoc()){
			if (password_verify($manage_pass, $manage_row['admin_pw'])){
				return $msg_row['1']['msg'];
				exit();
			}else {
				return $msg_row['3']['msg'];
				exit();
			}
		}
	}

}

function RUN_SQLI_DEFAULTLOGIN($SQL_STR,$USERNAME){
	if (!isset($SQL_STR)) {
		return $msg_row['3']['msg'];
	}
	global $mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName,$rootURLmanage,$mysqli,$msg_row;
	return $mysqli->query($SQL_STR);
}


function manage_counter($select_category){
	global $mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName,$rootURLmanage,$mysqli,$msg_row;

	$today = date('Y-m-d');

	switch ($select_category){
		case "user":
				$query_str_manage_countuser = "SELECT COUNT(no) FROM user";
				$manage_result_countuser = $mysqli->query($query_str_manage_countuser);
				$user_num = $manage_result_countuser->fetch_assoc();
				return $user_num['COUNT(no)'];
			break;
		case "comp":
				$query_str_manage_countercomp = "SELECT COUNT(comp_id) FROM comp_info";
				$manage_result_countcomp = $mysqli->query($query_str_manage_countercomp);
				$comp_num = $manage_result_countcomp->fetch_assoc();
				return $comp_num['COUNT(comp_id)'];
			break;
		case "job":
				$query_str_manage_countjob = "SELECT COUNT(job_info_id) FROM job_info";
				$manage_result_countjob = $mysqli->query($query_str_manage_countjob);
				$job_num = $manage_result_countjob->fetch_assoc();
				return $job_num['COUNT(job_info_id)'];
			break;
		case "cal":
				$query_str_manage_countcal = "SELECT COUNT(cal_id) FROM calData WHERE cal_date >= '{$today}'";
				$manage_result_countcal = $mysqli->query($query_str_manage_countcal);
				$cal_num = $manage_result_countcal->fetch_assoc();
				return $cal_num['COUNT(cal_id)'];
			break;
	}
}











?>
