<?php
include 'com.php';
$j=$_GET["j"];
$b=$_GET["b"];
function checkAdmin($a){
	foreach(queryLs("acc.txt") as $k=>$i){
		if($k===$a && $i["ad"]=="yes") return true;
	}
	return false;
}
session_start();
if($_SESSION["ad"]){
	if(file_exists($b)){
		$f=explode("\n",file_get_contents($b));
		if(checkAdmin($j)){
			echo "<b>Cannot ban admin!</b>";
			die();
		}
		if(!preg_match("/$j~/",$f[1]))$f[1].="$j~";
		$f[1]=sanitizeCRLF($f[1]);
		var_dump($f);
		$f=implode("\n",$f);
		echo "<pre>";
		var_dump($f);
		echo "</pre>";
		file_put_contents($b,$f);
	}
}
header("location: ./board.php?f=$b");
?>
