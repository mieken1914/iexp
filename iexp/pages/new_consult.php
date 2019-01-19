<?php
    session_start();
    include("../connect.php");

    if($_SESSION['logged_in']!=1) {
        header('Location: ../index.php');
    }

    if($_SESSION['user_type']!=1) {
        header('Location: ../index.php');
    }

    $sql = "SELECT * FROM user WHERE id_num=".$_SESSION['id'];
    $result = $con->query($sql);
    $user_row = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>iExpert - HOME</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">iExpert</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="home-client.php"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Consultations<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a class="active" href="new_consult.php">New</a>
                                </li>
                                <li>
                                    <a href="saved_logs-client.php">Saved Logs</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Welcome to an e2glite Consulation Steps</h1>
                        <h3>Please follow instructions below</h3>
                        <applet code="e2g.class" archive="../e2glite/e2gSwing.jar" name="e2g" WIDTH=450 HEIGHT=300 mayscript>
                          <param name="KBURL" value="../e2glite/iPhone_issues.kb">
                          <param name="APPTITLE" value="iPhone Expert">
                          <param name="PROMPTCOLOR" value="#2e2e1f">
                          <param name="BGCOLOR" value="#b8b894">
                          <param name="DEBUG" value="False">
                          <param name="JSFUNCTION" value="buttonPush">
                          <param name="PROMPTFIRST" value="true">
                          Java-enabled browser required
                          
                        </applet>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="recom_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">End result</h4>
                </div>
                <div class="modal-body">
                    <p id="result"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

    <script language="Javascript">
      function buttonPush(buttonNumber) {
          if (buttonNumber == 2) { 
              result_text = "";
              attribute_count = document.e2g.getAttrCount();

              for(i=1; i<=attribute_count; i++) {
                attribute_name = document.e2g.getAttrName(i);
                attribute_value = document.e2g.getAttrValue(i);
                

                if(attribute_value != "" && attribute_name!="recommendation") {
                  result_text = result_text + attribute_name + " = " + attribute_value + " ; ";
                  // result_text = result_text + attribute_name + "=" + attribute_value + "</br>";
                }
              }

              if(document.e2g.getGoalAttr()==0) {
                goal_index = document.e2g.getAttrIx("recommendation",1);
                goal_value = document.e2g.getAttrValue(goal_index);

                prob_index = document.e2g.getAttrIx("problem_type",1);
                prob_value = document.e2g.getAttrValue(prob_index);

                result_text = result_text + "recommendation = " + goal_value;
                // result_text = "</br>" + result_text + "recommendation=" + goal_value + "</br>";

                document.getElementById("result").innerHTML = "iExpert's recommendation is to " + goal_value;
                $('#recom_modal').modal('show'); //change this to notification
                addNewConsul(prob_value, goal_value, result_text);
              }
              // document.getElementById("demo").innerHTML = result_text;
          } 
      }

      function addNewConsul(problem_type, recommendation, details) {
        $.ajax({
          url: '../ajax_requests/add_new_consult.php',
          type: 'POST',
          dataType: 'html',
          data: {problem_type: problem_type, recommendation: recommendation, details: details},
          success: function(data) {
            if(data==="true") {
              console.log("Success");
            }
            else {
                console.log(data);
            }
          }
        });
      }
      </script>

</body>

</html>
