<?php
function menu(){
		if(!isset($_COOKIE["dark"])) setcookie("dark","0",time()+3600*24*30,"/");
	echo file_get_contents("menu.html");
	if($_COOKIE["dark"]=="1") echo "<link rel=stylesheet href=css/dark-menu.css />";
	echo "<span class=right >";
	session_start();
	if(isset($_SESSION["jm"])){
		echo "<span class=frame-link><a href=acc.php>".$_SESSION["jm"]."</a></span> ";
		echo "<span class=frame-link><a href=logout.php>Logout</a></span> ";

	}
	else echo "<span class=frame-link><a href=login.php >Login</a></span> <span class=frame-link><a href=register.php >Register</a></span>";
		if($_COOKIE["dark"]==0) echo " <span class=frame-link> <a href=switch-mode.php?f=".$_SERVER['REQUEST_URI']."> Dark </a></span>";
		else echo " <span class=frame-link> <a href=switch-mode.php?f=".$_SERVER['REQUEST_URI']."> Light </a></span>";
	echo "</span>\n</div>";
	if($_COOKIE["dark"]=="1") echo "<link rel=stylesheet href=css/dark.css />";
}
?>
