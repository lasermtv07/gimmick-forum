<!DOCTYPE HTML>
<html>
<head>
	<title>design hell login</title>
</head>
<body>
	<h1>design hell login</h1>
	<form method=POST>
		<b>Name: <input type=text name=jm /> <br>
		<b>Password</b>: <input type=password name=he /> <br>
		<input type=submit name=s /> <br>
	</form>
<?php
include 'com.php';
if(isset($_POST["s"])){
	$jm=(isset($_POST["jm"])) ? trim($_POST["jm"]) : "";
	$he=(isset($_POST["he"])) ? trim($_POST["he"]) : "";
	if($jm==="" || $he="" || isUnique(queryLs("acc.txt"),$jm) || base64_decode(queryLs("acc.txt")[$jm]["he"])!==$he){
		echo "<b>Bad Credentials</b>";
		die();
	}
	session_start();
	$_SESSION["jm"]=$jm;
	header("location:.");
}



?>
</body>
</html>

