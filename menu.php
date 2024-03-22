<?php
function menu(){
	echo "<h1>gimmick forum</h1>";
	echo"<hr />";
	echo '<a href="index.php">Home</a> <a href="login.php">Login</a> <a href="register.php">Register</a>';
	echo '<span style=float:right>';
	session_start();
	if(isset($_SESSION["jm"])){
		echo '<a href="logout.php">Logout </a>';
		echo $_SESSION["jm"];
	}
	else echo "anon";
	if(isset($_SESSION["ad"]) && $_SESSION["ad"]) echo "<span style=color:red>[ADMIN]</span>";
	echo "</span>\n<hr />";
	foreach(scandir(__DIR__) as $i){
		if(explode("-",$i)[0]==="bo") echo "<a href=board.php?f=$i>$i</a> ";
		}
}
?>
