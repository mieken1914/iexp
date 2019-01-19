<?php
    session_start();
    include("../connect.php");

    if($_SESSION['logged_in']!=1) {
        header('Location: ../index.php');
    }

    if($_SESSION['user_type']!=0) {
        header('Location: ../index.php');
    }

    $sql = "SELECT * FROM user WHERE id_num=".$_GET['client_id'];
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
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: gray">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home-admin.php" style="color: white;">iExpert</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="color: white;"></i> <i class="fa fa-caret-down" style="color: white;"></i>
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
                            <a href="home-admin.php"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="clientlist-admin.php"  class="active"><i class="fa fa-users fa-fw"></i> Clients</a>
                        </li>
                        <li>
                            <a href="consultationlist-admin.php"><i class="fa fa-list-alt fa-fw"></i> Consultations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Viewing <?php echo $user_row['f_name']." ".$user_row['l_name'] ?>'s Page</h1>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <?php echo $user_row['f_name']." ".$user_row['l_name'] ?>'s past consulations
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div id="gen_cons_data"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Consultation details</h4>
                </div>
                <div class="modal-body">
                    <div id="gen_details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <script src="../dist/js/sb-admin-2.js"></script>

    <script>
        $(document).ready(function() {
            generateConsultationList();
        });

        function generateConsultationList() {
            client_id = <?php echo $_GET['client_id'] ?>;
            $.ajax({
              url: '../ajax_requests/generate_client_saved_logs.php',
              type: 'GET',
              dataType: 'html',
              data: {client_id: client_id},
              success: function(data) {
                $('#gen_cons_data').html(data);
                $('#dataTables-consulation').DataTable({
                    responsive: true
                });
              }
            });
          }

        function generateConsultationDetails(consultation_id) {
            // alert(consultation_id);
            $.ajax({
              url: '../ajax_requests/generate_logs_details.php',
              type: 'GET',
              dataType: 'html',
              data: {consultation_id: consultation_id},
              success: function(data) {
                $('#gen_details').html(data);
                $('#details_modal').modal('show');
              }
            });
        }

        function accept(consultation_id, new_status) {
            $.ajax({
              url: '../ajax_requests/update_consultation_status.php',
              type: 'POST',
              dataType: 'html',
              data: {consultation_id: consultation_id, new_status: new_status},
              success: function(data) {
                generateConsultationList();
              }
            });
        }
    </script>

</body>

</html>
