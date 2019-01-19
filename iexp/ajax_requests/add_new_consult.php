<?php
	session_start();
	include("../connect.php");
	$pt = $_POST['problem_type'];
	$recom = $_POST['recommendation'];
	$dt = $_POST['details'];
	$id = $_SESSION['id'];

	$new_query = "INSERT INTO consultation(date, details, problem_type, recommendation, is_accepted, client_id) VALUES(NOW(), \"$dt\", \"$pt\", \"$recom\", -1, $id)";

	if($con->query($new_query)==TRUE) {
        echo "true";
    }

    else {
        echo $new_query;
    }

?>