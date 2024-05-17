<?php
include 'com.php';
$j=isset($_GET["j"]) ? $_GET["j"] : " ";
$b=$_GET["b"];
session_start();
if($_SESSION["ad"]){
	if(file_exists($b)){
		$f=file_get_contents($b);
		$f=explode("\n", $f);
		if(sizeof($f)>2) $bans=explode("~", $f[1]);
		foreach($bans as $k=>$i){
			if($i===$j) unset($bans[$k]);
		}
		$bans=implode("~", $bans);
		$f[1]=$bans;
		var_dump($f);
		$f=implode("\n",$f);
		echo $f;
		file_put_contents($b,$f);
	}
}
header("location: ./board.php?f=$b");
?>
