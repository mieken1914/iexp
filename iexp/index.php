<?php
	session_start();
	$_SESSION['logged_in']=0;

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="0;url=pages/login.php">
<title>iExpert - Online iPhone Expert</title>
<script language="javascript">
    window.location.href = "pages/login.php"
</script>
</head>
<body>
Go to <a href="pages/login.html">/pages/login.php</a>
</body>
</html>
