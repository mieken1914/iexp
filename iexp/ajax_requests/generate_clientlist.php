<?php
	include("../connect.php");

	session_start();

	echo "<table class=\"table table-striped table-bordered table-hover\" id=\"dataTables-clients\">"
        ."<thead>"
        ."<tr>"
        ."<th>ID</th>"
        ."<th>Name</th>"
        ."<th>Consultation Count</th>"
        ."<th></th>"
        ."</tr>"
        ."</thead>"
        ."<tbody>";

   	$sql = "SELECT * FROM user WHERE user_type=1";

   	$result = $con->query($sql);

    while($row=$result->fetch_assoc()) {
        $sql2 = "SELECT * FROM consultation where client_id=".$row['id_num'];
        $result2 = $con->query($sql2);

        $consultation_count = $result2->num_rows;

    	echo "<tr>"
    		."<td>".$row['id_num']."</td>"
            ."<td>".$row['l_name'].", ".$row['f_name']."</td>"
            ."<td>".$consultation_count."</td>"
            ."<td><button class=\"btn btn-sm btn-link btn-block\" name=\"view_account\" onclick=\"location.href='view_client_account.php?client_id=".$row['id_num']."';\">View</button></td></tr>";
    }

    echo "</tbody></table>";

?>