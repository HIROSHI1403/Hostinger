<?php
require_once 'userfunctions.php';

$_SESSION = array();

if (isset($_COOKIE["PHPSESSID"])) {
	setcookie("PHPSESSID", '', time() - 1800, '/');
}

session_destroy();

header("Location: {$rootURLdist}userlogin.php?logout=YES");