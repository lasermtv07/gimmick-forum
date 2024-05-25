<?php
session_start();
$id=$_GET["id"];
$b=$_GET["b"];
echo "Id: $id<br>Board: $b";
if(isset($_SESSION["jm"])){
	$jm=$_SESSION["jm"];
	echo "<br>Name: $jm<br><br>";
	$f=file_get_contents($b);
	$f=explode("\n",$f);
	foreach($f as $k=>$i){
		$t=explode("~",$i);
		if(sizeof($t)>1){
			if($t[0]===$id){
				//dvojty t!
				//basically zkontroluje esi uzivatel uz neupvotl a pokud ne tak za nej upvotne
				$tt=base64_decode($t[2]);
				$tt=explode(";",$tt);
				if(!in_array($jm,$tt)) array_push($tt,$jm);
				else $tt=array_diff($tt,[$jm]);
				$tt=implode(";",$tt);
				$tt=base64_encode($tt);
				$t[2]=$tt;
				$t=implode("~",$t);
				$f[$k]=$t;

			}
		}
	}
	$f=implode("\n",$f);
	file_put_contents($b,$f);
}
header("location: board.php?f=$b");
?>
