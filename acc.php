<!DOCTYPE HTML>
<html>
<head>
	<title>account</title>
</head>
<body>
<?php
include 'com.php';
session_start();
if(isset($_SESSION["jm"])){
	$jm=$_SESSION["jm"];
	$mail=queryLs("acc.txt")[$jm]["em"];
}
else {
	echo "<b>Error: No one is logged in</b>";
	die();
}
?>
	<h2>user info</h1>
	<form method=POST>
	<b>Name: </b><input type=text name=jm value="<?php echo $jm ?>"/> <br>
	<b>Email: </b><input type=text name=mail value="<?php echo $mail; ?>" /> <br>
	<input type="submit" name="info" />
	</form>
<?php
if(isset($_POST["info"])){
	if(isUnique(queryLs("acc.txt"),$_POST["jm"])){
		$f=file_get_contents("acc.txt");
		$f=explode("\n",$f);
		foreach($f as $k=>$i){
			$t=explode(";",$i);
			if($t[0]==$jm){
				$t[0]=$_POST["jm"];
				$t[1]=$_POST["mail"];
			}
			$t=implode(";",$t);
			$f[$k]=$t;
		}
		$f=implode("\n",$f);
		$_SESSION["jm"]=$_POST["jm"];
		file_put_contents("acc.txt",$f);
		header("location: acc.php");
	}
	else {
		echo "<b>Error: Name already taken</b>";
	}
}
?>
</body>
</html>
