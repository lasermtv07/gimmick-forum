<!DOCTYPE HTML>
<html>
<head>
	<title>a test board</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/board.css" />
</head>
<body>
<?php
include 'com.php';
menu();
session_start();
?>
<main>
	<h1>Hello</h1>
<?php
$f=isset($_GET["f"]) ? $_GET["f"] : "";
if(!file_exists($f)){
	echo "<b>File doesnt exist!</b>";
	die();
}
//tohle zapomenou by byla VELKA CHYBA!
if(explode("-",$f)[0]!=="bo"){
	echo "<b>Dont</b>";
	die();
}
$f=file_get_contents($f);
$fo=explode("\n",$f);
?>
<div class=split>
<div class=gimmick >
		<h3>Gimmick</h3>
<?php
if(isset($_SESSION["ad"]) && $_SESSION["ad"]) echo "<form method=POST>\n<textarea name=gUpdate>";
echo $fo[0];
if(isset($_SESSION["ad"]) && $_SESSION["ad"]){
	echo "\n</textarea><br />";
	echo '<input type=submit value="Update" />';
	echo '<style>.gimmick {height: 300px;} .bans .scroll {height:300px;}</style>';
	echo '<style> @media screen and (max-width:780px){.gimmick {width:93%;}}</style>';
}
if(isset($_POST["gUpdate"]) && isset($_SESSION["ad"]) && $_SESSION["ad"]){
	$temp=$fo;
	$temp[0]=$_POST["gUpdate"];
	$t2="";
	//tady jsem eml problemy s kodovanim newlinu a nl2br je neopravilo,
	//tak jsem newliny a carriage return smazal rucne
	foreach(mb_str_split($temp[0]) as $i){
		if($i!=="\n" && $i!=="\r"){
			$t2.=$i;
		}
	}
	$temp[0]=$t2;
	$temp=implode("\n",$temp);
	file_put_contents($_GET["f"],$temp);
	header("location: board.php?f=".$_GET["f"]);
}
?>
</div>

<div class=bans >
		<h3>Bans</h3>
<div class=scroll >
<?php
$bl=explode("~",$fo[1]);
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
</div>
</div>
</div>
<h3>Posts</h3>
<form method=POST>
<b>Write your post:</b><br />
<textarea name=po rows=5 cols=50></textarea>
<br /><input type="submit" name="s"/>
<?php

function writeOut($fo){
	$fo=array_reverse($fo);
	foreach($fo as $i){
		if($i!==""){
			echo "<div class=post >";
			$t=explode("~",$i);
			$tj=explode("|",base64_decode($t[0]));
			$time=gmdate("d/m/Y H:i",$tj[1]);
			echo "<b>".$tj[0]."</b> - <i>".$time."</i>";
			if($_SESSION["ad"]){
				echo "<span class=man>";
				echo  "<a href=delete.php?r=".$t[0]."&o=".$_GET["f"].">";
				echo "<span>[DELETE]</span>";
				echo "</a>";
				echo "<a href=ban.php?j=".$tj[0]."&b=".$_GET["f"].">";
				echo "<span>[BAN]</span>";
				echo "</a>";
				echo "</span>";
			}
			echo "<br>";
			echo $t[1];
			echo "</div>";
		}

}
}
if(isset($_POST["s"])){

echo "catch";
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
if(!$_SESSION["ad"]){
	die();
}
?>
	<script type="text/javascript" src="./js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init(
			{
				language : 'cs',
				selector: 'textarea[name=gUpdate]',
				theme: 'modern',
				plugins: [
					'hr anchor pagebreak',
					'searchreplace wordcount visualblocks visualchars code',
					'insertdatetime nonbreaking save table directionality',
					'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
				],
				toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
				toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
				image_advtab: true,
			});
	</script>
</main>
</body>
</html>

