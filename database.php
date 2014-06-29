<?php

require_once('config.php');

function db_connect() {
	$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (mysqli_connect_errno()) {
		
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
}
return $connection;
}
?>

