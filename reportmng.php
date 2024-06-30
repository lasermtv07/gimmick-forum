<?php
include "com.php";
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>gimmick-forum :: report management</title>
	<link rel=stylesheet href=css/style.css />
</head>
<body>
<?php menu(); ?>
	<main>
	<h1>reports management</h1>
<?php
$r=explode("~",file_get_contents("reports.txt"));
//vytvori pole vsech reportu pro jednotlive zpravy
$l=[];
foreach($r as $i){
	$t=explode(";",$i);
	if(gettype($l[$t[0]])=="NULL") $l[$t[0]]=[];
	array_push($l[$t[0]],[$t[1],$t[2]]);
}
foreach($l as $k=>$i){
	if($k!="" && isRealMessage($k)){
		echo "<hr />";
		echo "<div>";
		$n=explode("|",base64_decode($k));
		echo "A message by <b>".$n[0]."</b> sent on <b>".gmdate("d/m/Y H:i",$n[1]+2*3600)."</b> - ";
		echo sizeof($i)."x reports";
		echo "<br><i>$k</i>";
		echo "</div><div>";
		echo explode("~",getMessageById($k)[1])[1];
		echo "</div>";
		echo "<div>";
		echo "<a href=board.php?f=boards/".getMessageById($k)[0]."#$k >[JUMP]</a> ";
		echo "<a href=delete.php?o=boards/".getMessageById($k)[0]."&r=$k>[DELETE]</a>";
		echo "</div><ul>";
		foreach($i as $j){
			echo "<li><b>$j[0]</b> - $j[1] - ";
			echo "<a href=dismiss.php?i=$k;$j[0];$j[1] >[DISMMIS]</a>";
		}
		echo "</ul>";
	}
}
footer();
?>
</main>
</body>
</html>
