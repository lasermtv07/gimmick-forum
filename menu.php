<?php
function menu(){
/*	echo "<h1>gimmick forum</h1>";
	echo"<hr />";
	echo '<a href="index.php">Home</a> <a href="login.php">Login</a> <a href="register.php">Register</a>';
	echo '<span style=float:right>';*/
	echo file_get_contents("menu.html");
	echo "<span class=right >";
	session_start();
	if(isset($_SESSION["jm"])){
		echo "<span class=frame>".$_SESSION["jm"]."</span> ";
		echo "<span class=frame-link><a href=logout.php>Logout</a></span>";
	}
	else echo "<span class=frame-link><a href=login.php >Login</a></span> <span class=frame-link><a href=register.php >Register</a></span>";
	echo "</span>\n</div>";

}
?>
