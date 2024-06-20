<?php
include 'com.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>gimmick forum :: board management</title>
	<link rel=stylesheet href="css/style.css" />
</head>
<body>
<?php menu(); ?>
<main>
	<h1>administration: board management</h1>
	<p>This page is used to modify and manage boards on the forum. All admins, please obey these
	rules or thy shall be smitten for breaking my trashy code:
	<ul>
		<li>Dont do any weird Unicode magic</li>
		<li>Dont put HTML into the names, it is not sanitized</li>
		<li>Dont use weird board names, they are not safe for work</li>
	</ul>
	<b>This feature is still in development! You have been warned!</b>
	</p>
	<h3>manage existing boards</h3>
<?php
session_start();
if(!$_SESSION["ad"]) {
	echo "<b>Error: This is an admin only feature</b>";
	die();
}
function encodeName($s){
	if(explode("-",$s)[0]==="bo") return $s;
	return "bo-".strtolower($s).".txt";
}
foreach(scandir("boards") as $i){

	if(explode("-",$i)[0]=="bo"){
		echo "<form method=POST>";
		echo "<h2><input type=text name=tname value=".extractName($i)." />";
		echo "<input type=submit name=delete value=Delete />";
		echo "<input type=submit name=rename value=Rename />";
		echo "<input type=hidden name=name value=$i />";
		echo "</h2></form>";
	}
}
?>
<h3>create a new board</h3>
<form method=POST>
	<b>Name: </b><input type=text name=name /><br>
	<b>Gimmick:</b><br>
	<textarea name=gimmick ></textarea><br>
	<input type=submit name=create value=Create />
</form>
<?php
if(isset($_POST["delete"])){
	$n=$_POST["name"];
	echo "Going to <b>delete</b> $n.";
	unlink("boards/$n");
	header("location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}
if(isset($_POST["rename"])){
	$n=$_POST["name"];
	$nn=$_POST["tname"];
	echo "Going to <b>rename</b> $n to $nn.";
	rename("boards/$n","boards/$nn");
	header("location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}
if(isset($_POST["create"])){
	$n=$_POST["name"];
	$g=$_POST["gimmick"];
	if(!file_exists("boards/".encodeName($n))){
		echo "<b>Created</b> board $n with gimmick $g.";
		file_put_contents("boards/".encodeName($n),sanitizeCRLF($g)."\n\n");
		header("location: board.php?f=boards/".encodeName($n));
	}
	else {
		echo "Board already exists";
	}
}

footer();
?>
</main>
</body>
</html>
