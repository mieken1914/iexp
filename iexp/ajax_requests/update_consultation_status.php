<?php
	include("../connect.php");

	$sql = "UPDATE consultation SET is_accepted=".$_POST['new_status']." WHERE id_num=".$_POST['consultation_id'];

	if($con->query($sql)==TRUE) {
		echo "true";
	}
	else {
		echo "false";
	}
?>