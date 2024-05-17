<?php
function footer(){
	echo "<hr />";
	session_start();
	if(!$_SESSION["checked"]){
		$i=(file_get_contents("counter.txt")!=="") ? (int) file_get_contents("counter.txt") : 0;
		$i++;
		file_put_contents("counter.txt",(string) $i);
		$_SESSION["checked"]=true;
		if(isset($_COOKIE["counter"])){
			echo "test";
			setcookie("counter",(int) $_COOKIE["counter"]+1,time()+65536,"/");
		}
		else {
			setcookie("counter",1,time()+65536,"/");
		}
	}
	$c=(isset($_COOKIE["counter"])) ? $_COOKIE["counter"] : "0";
	echo "<center>";
	echo "<div class=counterc>";
	echo "<table class=counter>\n";
	echo "<tr class=labels><td>Visists Total</td><td>Your Visists</td></tr>";
	echo "<tr class=numbers><td>".file_get_contents('counter.txt')."</td><td>$c</td></tr>";
	echo "</table>";
	echo "<span>(c) Michal Chmelar, 2024. Under the UNLICENSE.<br></span>";
	echo "</div>";
	echo "</center>";
}
?>
