<?php
	include("../connect.php");

	session_start();
	$added_header = "";
	$added_info = "";
	if($_GET['client_id']==-1) {
    	$sql = "SELECT * FROM consultation";
    	$added_header = "<th>Client</th>";
    }
    else {
    	$sql = "SELECT * FROM consultation WHERE client_id=".$_GET['client_id'];
    }

	echo "<table class=\"table table-striped table-bordered table-hover\" id=\"dataTables-consulation\">"
        ."<thead>"
        ."<tr>"
        ."<th>ID</th>"
        ."<th>Date</th>"
        .$added_header
        ."<th>Problem Type</th>"
        ."<th>Recommendation</th>"
        ."<th>Accepted</th>"
        ."<th>Details</th>"
        ."</tr>"
        ."</thead>"
        ."<tbody>";

   	$result = $con->query($sql);

    while($row=$result->fetch_assoc()) {
    	$accept_button = "";
    	$reject_button = "";

    	if($row['is_accepted']==-1) {
    		$accept_note = "Not yet viewed";
    	}
    	else if($row['is_accepted']==0) {
    		$accept_note = "Rejected";
    	}
    	else if($row['is_accepted']==1) {
    		$accept_note = "Accepted";
    	}

    	if($_GET['client_id']==-1) {
    		$sql2 = "SELECT * FROM user where id_num=".$row['client_id'];
        	$result2 = $con->query($sql2);
        	$row2 = $result2->fetch_assoc();

        	$added_info = "<td>".$row2['l_name'].", ".$row2['f_name']."</td>";
    	}

    	if($_SESSION['user_type']==0 && $row['is_accepted']==-1) {
			$accept_button = "  <button class=\"btn btn-sm btn-success \" name=\"view_details\" onClick=\"accept(".$row['id_num'].",1)\"><i class=\"fa fa-check-square-o  fa-fw\"></i></button>";
			$reject_button = "  <button class=\"btn btn-sm btn-danger \" name=\"view_details\" onClick=\"accept(".$row['id_num'].",0)\"><i class=\"fa fa-trash-o   fa-fw\"></i></button>";
		}

    	echo "<tr>"
    		."<td>".$row['id_num']."</td>"
            ."<td>".$row['date']."</td>"
            .$added_info
            ."<td>".$row['problem_type']."</td>"
            ."<td>".$row['recommendation']."</td>"
            ."<td>".$accept_note.$accept_button.$reject_button."</td>"
            ."<td><button class=\"btn btn-sm btn-link btn-block\" name=\"view_details\" onClick=\"generateConsultationDetails(".$row['id_num'].")\">View</button></td></tr>";
    }

    echo "</tbody></table>";

?>