<!DOCTYPE HTML>
<html>
<head>
	<title>gimmick-forum :: home</title>
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
	echo "<h1>Welcome back, ".$_SESSION["jm"]."</h1>";
}
else {
	echo "<h1>Welcome, anon</h1>";
}
?>
The gimmick forum is a forum software, writen in PHP as final project for my highschool programming class of 2024. It was written by Michal Chmelar. It was, however, inspired by a specific text channel section on a discord server I am in. There, every channel has a special gimmick, a specific set of rules that its users have to follow. It is usually based off of some spicific theme (the users having to speak as a movie villain) or having a specific limitation on what characters can be used (like every word must contain an E or none can contain E - they like E for some reason). For this project, most gimmicks are from the former cathegory, but you could say that the Hacker board has this kind of limitation (since it requires you use <a href=https://en.wikipedia.org/wiki/Leet >LEETSPEAK</a>). It was an interesting idea so that's why I chose it.
<h2>Rules</h2>
<ul>
	<li>Follow the gimmick rules of specific channels</li>
	<li>No NSFW</a>
	<li>If you find a bug, please report it :P</li>
	<li>Dont bully other people</li>
</ul>
<?php
footer();
?>
</main>
</body>
