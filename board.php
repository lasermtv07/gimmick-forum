<!DOCTYPE HTML>
<html>
<head>
	<title>a test board</title>
</head>
<body>
<?php
include 'com.php';
menu();
?>
	<h1>Hello</h1>
<?php
$f=isset($_GET["f"]) ? $_GET["f"] : "";
if(!file_exists($f)){
	echo "<b>File doesnt exist!</b>";
	die();
}
//E:there was a space for a mistake of huge magnitude
//C:tohle zapomenou by byla VELKA CHYBA!
if(explode("-",$f)[0]!=="bo"){
	echo "<b>Dont</b>";
	die();
}
$f=file_get_contents($f);
$fo=explode("\n",$f);
?>
<h3>Gimmick</h3>
<?php
echo $fo[0];
array_shift($fo);
?>
<h3>Bans</h3>
<?php
echo $fo[0];
array_shift($fo);
?>
<h3>Posts</h3>
<form method=POST>
<b>Write your post:</b><br />
<textarea name=po rows=5 cols=50></textarea>
<br /><input type="submit" name="s"/>
<?php
function writeOut($fo){
	foreach($fo as $i){
		if($i!==""){
			echo "<hr />";
			$t=explode("~",$i);
			$tj=explode("|",base64_decode($t[0]));
			echo "<b>".$tj[0]."</b> - <i>".$tj[1]."</i><br />";
			echo $t[1];
		}

}
}
if(isset($_POST["s"])){
	session_start();
	if(!isset($_SESSION["jm"])){
		echo "<b>Must be logged in to post!</b>";
		writeOut($fo);
		die();
	}
	if($_POST["po"]===""){
		echo "<b>Dont post empty posts</b>";
		writeOut($fo);
		die();
	}
	if(preg_match("/~/",$_POST["po"])){
		echo "<b>Dont use that character</b>";
		writeOut($fo);
		die();
	}
	$h=base64_encode($_SESSION["jm"]."|".((string) time()));
	$z=nl2br(htmlspecialchars(trim($_POST["po"])));
	$z=preg_replace("/[\n\r]/","",$z); 
	file_put_contents($_GET["f"],"$h~$z\n",FILE_APPEND);
	header("location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}
writeOut($fo);
?>
</body>
</html>

