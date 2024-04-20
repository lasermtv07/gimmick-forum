<!DOCTYPE HTML>
<html>
<head>
	<title>hello</title>
</head>
<body>
<?php include 'com.php'; menu(); ?>
<?php
session_start();
if(isset($_SESSION["jm"])){
	echo "<h1>hello ".$_SESSION["jm"]."</h1>";
}
else {
	echo "<h1>hello, anon</h1>";
}
footer();
?>
</body>
