<?php

error_reporting(~E_ALL & ~E_DEPRECATED &  ~E_NOTICE);

// Report all warnings and errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// create PDO instance
$db_host = 'xxx';
$db_name = 'xxx';
$db_user = 'xxx';
$db_password = 'xxx';
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

?>
