<!DOCTYPE HTML>
<html>
<head>
	<title>gimmick-forum :: login</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
include 'com.php';
menu();
session_start();
?>
<main>
	<h1>Login</h1>
	<p>Note: If you havent registered yet, please register on the <a href="register.php"> Registration</a> page.
	<form method=POST>
	<table>
		<tr><td><b>Name:</b> </td><td><input type=text name=jm /> </td> </tr>
		<tr><td><b>Password</b>: </td><td><input type=password name=he /> </td> </tr>
		<tr><td colspan="2"><label><input type="checkbox" name="cookie" />Keep me logged in?</label></td></tr>
		<tr><td><input type=submit name=s value="Login" /></td></tr>
	</table>
	</form>
<?php
if(isset($_SESSION["jm"])){
	echo "<b>Error: User already logged in</b>";
	footer();
	die();
}

if(isset($_POST["s"])){
	$jm=(isset($_POST["jm"])) ? trim($_POST["jm"]) : "";
	$he=(isset($_POST["he"])) ? trim($_POST["he"]) : "";
	if($jm==="" || $he="" || isUnique(queryLs("acc.txt"),$jm) || base64_decode(queryLs("acc.txt")[$jm]["he"])!==$he){
		echo "<b>Bad Credentials</b>";
		footer();
		die();
	}
	if($_POST["cookie"]=="on"){
		//zapamatuje si uzivatele na 30 dni
		setcookie("remember",$jm,time()+3600*24*30,"/");
	}
	$_SESSION["jm"]=$jm;
	if(queryLs("acc.txt")[$jm]["ad"]==="yes") $_SESSION["ad"]=true;
	header("location:.");
}


footer();
?>
</main>
</body>
</html>

