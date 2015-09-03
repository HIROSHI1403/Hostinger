<?php

require_once 'functions.php';

$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
	setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();
header("Location: {$rootURL}manage/managelogin.php?logout=YES");
