<!-- BASIC AUTH -->
<?php
if (!isset($_SERVER["PHP_AUTH_USER"]) || !($_SERVER["PHP_AUTH_USER"] == "root" && $_SERVER["PHP_AUTH_PW"] == "admin")) {
	header("WWW-Authenticate: Basic realm=\"Cooking community\"");
	header("HTTP/1.0 401 Unauthorized");
	echo "BASIC認証の認証ができませんでした。<br><br>";
	echo "<a href=\"userkanri.php\">会員管理ページ</a>";
	exit();
}

