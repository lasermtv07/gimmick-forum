<!DOCTYPE HTML>
<html>
<head>
	<title>hello</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION["jm"])){
	echo "<h1>hello ".$_SESSION["jm"]."</h1>";
}
else {
	echo "<h1>hello, loser</h1>";
}
?>
</body>
