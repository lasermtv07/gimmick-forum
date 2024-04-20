<!DOCTYPE HTML>
<html>
<head>
	<title>a test board</title>
<style>
	table td {
		border: 1px solid black;
	}
	table {
		border-collapse: collapse;
	}
</style>
</head>
<body>
<?php
include 'com.php';
menu();
session_start();
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
if($_SESSION["ad"]){
	echo "<form method=\"post\" action=\"update-gimmick.php\">";
	echo "<input type=\"hidden\" name=\"b\" value=\"".$_GET["f"]."\" />";
	echo '<textarea name="g">';
}
echo $fo[0];
if($_SESSION["ad"]){
	echo "</textarea><br />";
	echo '<input type="submit" value="update" />';
}
array_shift($fo);
?>
<h3>Bans</h3>
<?php
$bl=explode("~",$fo[0]);
echo "<table>\n";
foreach($bl as $i){
	if($i!=""){
		echo "<tr><td>$i</td>";
		if(isset($_SESSION["ad"])){
			echo "<td><a href=\"unban.php?j=$i&b=".$_GET["f"]."\" style=\"color:red\">[UNBAN]</a></td></tr>";
		}
		else {
			echo "<td>[BANNED]</td></tr>";
		}
	}
}
echo "</table>";
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
			echo "<b>".$tj[0]."</b> - <i>".$tj[1]."</i>";
			if($_SESSION["ad"]){
				echo  "<a href=delete.php?r=".$t[0]."&o=".$_GET["f"].">";
				echo "<span style=\"color:red; float:right\">[DELETE]</span>";
				echo "</a>";
				echo "<a href=ban.php?j=".$tj[0]."&b=".$_GET["f"].">";
				echo "<span style=color:red;float:right;padding-right:5px; >[BAN]</span>";
				echo "</a>";
			}
			echo "<br>";
			echo $t[1];
		}

}
}
if(isset($_POST["s"])){
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
	if(in_array($_SESSION["jm"],$bl)){
		echo "<b>You are banned!</b>";
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
footer();
?>
</body>
</html>

