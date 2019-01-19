<?php
	include("../connect.php");

	session_start();

	$sql = "SELECT * FROM consultation WHERE id_num=".$_GET['consultation_id'];

	$result = $con->query($sql);

	if($result->num_rows) {
		$row=$result->fetch_assoc();
		$details = str_replace(";", "</br>", $row['details']);
		echo $details;
	}
	else {
		echo "No further details found";
	}


?>