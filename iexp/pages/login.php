<?php
    session_start();
    include("../connect.php");

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

        $result = $con->query($sql);
        $user_row = $result->fetch_assoc();

        if($result->num_rows == 1) {
            $_SESSION['user_type'] = $user_row['user_type'];
            $_SESSION['logged_in'] = 1;
            $_SESSION['id'] = $user_row['id_num'];

            if($_SESSION['user_type']==1) {
                header('Location: home-client.php');
            }
            else if($_SESSION['user_type']==0) {
                header('Location: home-admin.php');
            }
            
        }
    }

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
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button class="btn btn-lg btn-success btn-block" name="login">Login</button>
                                <label>
                                    <a href="register.php" class="btn btn-xs btn-link btn-block">New User? Register</a>
                                </label>
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

</body>

</html>
