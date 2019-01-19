<?php
	$servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "iexpert_db";
    $con = new mysqli($servername, $username, $password, $db_name) or die("Failed to connect to MySQL!" . mysql_error());
?>