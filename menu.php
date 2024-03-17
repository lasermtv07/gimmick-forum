<?php
function menu(){
	echo "<h1>gimmick forum</h1>";
	echo"<hr />";
	echo '<a href="index.php">Home</a> <a href="login.php">Login</a> <a href="register.php">Register</a>';
	echo '<span style=float:right><a href="logout.php">Logout </a>';
	session_start();
	if(isset($_SESSION["jm"])) echo $_SESSION["jm"];
	else echo "anon";
	echo "</span>\n<hr />";
	foreach(scandir(__DIR__) as $i){
		if(explode("-",$i)[0]==="bo") echo "<a href=board.php?f=$i>$i</a> ";
		}
}
?>
