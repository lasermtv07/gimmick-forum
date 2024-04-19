<?php
$b=$_POST["b"];
$g=$_POST["g"];

session_start();
if(isset($_SESSION["ad"])){
	if(file_exists($b)){
		$f=file_get_contents($b);
		$f=explode("\n",$f);
		$f[0]=$g;
		$f=implode("\n",$f);
		file_put_contents($b,$f);
	}
}
header("location: board.php?f=$b");
?>
