<?php
    session_start();
    include("../connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>iExpert - Online iPhone Expert</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group"><label>Enter E-mail</label>
                                    <input class="form-control" placeholder="Enter E-mail" id="username" name="username" autofocus>
                                </div>
                                <div class="form-group"><label>Enter Password</label>
                                    <input class="form-control" placeholder="Enter Password" id="password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm Password" id="password2" name="password2" type="password" value="">
                                </div>
                                <label>Enter Name</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" id="f_name" placeholder="Enter First Name" name="f_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" id="l_name" placeholder="Enter Last Name" name="l_name">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <button class="btn btn-lg btn-success btn-block" name="register" onclick="addNewUser(); return false;">Confirm</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        function addNewUser() {
            var l_name = $('#l_name').val();
            var f_name = $('#f_name').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var password2 = $('#password2').val();
            
            if(password==password2) {
                $.ajax({
                  url: '../ajax_requests/add_new_client.php',
                  type: 'POST',
                  dataType: 'html',
                  data: {username: username, password: password, f_name: f_name, l_name: l_name},
                  success: function(data) {
                    if(data==="true") {
                        window.location.href = 'login.php';
                    }
                    else {
                        alert(data);
                    }
                  }
                });
            }
            else {
                alert("Password mismatched!");
            }
            
          }
    </script>

</body>

</html>
