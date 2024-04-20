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
	echo "<b>Total visits:</b> ".file_get_contents("counter.txt")."<br />";
	$c=(isset($_COOKIE["counter"])) ? $_COOKIE["counter"] : "0";
	echo "<b>Your visits:</b>: $c</br />";
}
?>
