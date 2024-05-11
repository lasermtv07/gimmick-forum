<!DOCTYPE HTML>
<html>
<head>
	<title>hello</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'com.php'; menu(); ?>

<main>
<?php
session_start();

if(isset($_COOKIE["remember"]) && !isUnique(queryLs("acc.txt"),$_COOKIE["remember"])){
	$_SESSION["jm"]=$_COOKIE["remember"];
	if(queryLs("acc.txt")[$_COOKIE["remember"]]["ad"]==="yes") $_SESSION["ad"]=true;

}
if(isset($_SESSION["jm"])){
	echo "<h1>hello ".$_SESSION["jm"]."</h1>";
}
else {
	echo "<h1>hello, anon</h1>";
}
echo "Dark mode:";
echo ($_COOKIE["dark"])?"yes":"no";
echo "<br />";
footer();
?>
</main>
</body>
