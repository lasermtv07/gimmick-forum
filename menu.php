<?php
session_start();
require_once "com.php";
function menu(){
		session_start();
		if(!isset($_COOKIE["dark"])) setcookie("dark","0",time()+3600*24*30,"/");
		echo '<link rel=stylesheet href="css/menu.css" /> <div class="menu" >         <a href=index.php /><img src=img/logo.svg /></a>                 <span class="links">';
		foreach(scandir(__DIR__."/boards") as $i){
			//kvuli vim .swp souborum
			if($i[0]==="." || explode(".",$i)[sizeof(explode(".",$i))-1]==="swp") continue;
			if($i!=="." && $i!=="..") echo "<a href=board.php?f=boards/$i />".extractName($i)."</a>";
		}
	if($_SESSION["ad"]){
		echo "&nbsp;";
		echo "<span class=frame-link>";
		echo "<a href=boardmng.php />Manage&nbsp;boards</a>";
		echo "</span>";
	}

	if($_COOKIE["dark"]=="1") echo "<link rel=stylesheet href=css/dark-menu.css />";
	echo "<span class=right >";
	if(isset($_SESSION["jm"])){
		if($_SESSION["ad"]){
			echo "&nbsp;";
			echo "<span class=frame-link>";
			echo "<a href=reportmng.php />Manage&nbsp;reports</a>";
			echo "</span> ";
		}
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
