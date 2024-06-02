<?php
session_start();
$id=$_GET["id"];
$b=$_GET["b"];
$d=(isset($_GET["d"]) && $_GET["d"]);
var_dump($d);
echo "Id: $id<br>Board: $b";
if(isset($_SESSION["jm"])){
	$jm=$_SESSION["jm"];
	echo "<br>Name: $jm<br><br>";
	$f=file_get_contents($b);
	$f=explode("\n",$f);
	if(!$d){
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
					//at nema upvote a downvote zaroven
					if(isset($t[3])){
						$o=$t[3];
						$o=explode(";",base64_decode($o));
						if(in_array($jm,$o)) $o=array_diff($o,[$jm]);
						var_dump($t[3]);
						$o=base64_encode(implode(";",$o));
						$t[3]=$o;
					}
				}
					$t=implode("~",$t);
					$f[$k]=$t;

			}
		}
	}
	else if($d){
		foreach($f as $k=>$i){
			// <3
			if(substr_count($i,"~")<3 && $i!=="" && $k!=0 && $k!=1) $f[$k].="~";
			$i=$f[$k];
			if($k!=0 && $k!=1){
				$t=explode("~",$i);
				//rozhodne nekopiroval.. xd
				$tt=base64_decode($t[3]);
				$tt=explode(";",$tt);
				if(!in_array($jm,$tt)) array_push($tt,$jm);
				else $tt=array_diff($tt,[$jm]);
				$tt=implode(";",$tt);
				$tt=base64_encode($tt);
				$t[3]=$tt;
				//at nema upvote a downvote zaroven
				//kopypasta hehe.. chci spat
				$o=$t[2];
				$o=explode(";",base64_decode($o));
				if(in_array($jm,$o)) $o=array_diff($o,[$jm]);
				$o=base64_encode(implode(";",$o));
				$t[2]=$o;
				$t=implode("~",$t);
				$f[$k]=$t;
			}
		}
	}
	$f=implode("\n",$f);
	echo "<pre>$f</pre>";
	file_put_contents($b,$f);
}
header("location: board.php?f=$b");
?>
