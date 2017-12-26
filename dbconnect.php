<?php
require_once("/var/www/html/sample/inc/sys_info.php");
require_once("/var/www/html/sample/inc/config.php");
require_once("/var/www/html/sample/inc/function.php");
$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
} ?>