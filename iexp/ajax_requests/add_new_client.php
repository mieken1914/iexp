<?php
	session_start();
	include("../connect.php");
	$username = $_POST['username'];
    $password = sha1($_POST['password']);

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];

    $sql = "SELECT * FROM user WHERE username=\"$username\"";
    $result=$con->query($sql);

    if($result->num_rows>0) {
    	echo "Username existed";
    }
    else {
    	$new_query = "INSERT INTO user(username, password, user_type, f_name, l_name) VALUES(\"$username\", \"$password\", 1, \"$f_name\", \"$l_name\")";

		if($con->query($new_query)==TRUE) {
	        echo "true";
	    }

	    else {
	        echo "Something is wrong!";
	    }
    }
	

?>