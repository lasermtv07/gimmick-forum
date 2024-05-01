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
//kod pro zmenu emailu/jmena uzivatele
//TODO: vytahnou email z kontroly unikatnosti jmena
if(isset($_POST["info"])){
	//kontroluje unikatnost jmena
	if(isUnique(queryLs("acc.txt"),$_POST["jm"])){
		$f=file_get_contents("acc.txt");
		$f=explode("\n",$f);
		//prepisuje
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
		//zmeni session, zapise do souboru
		$_SESSION["jm"]=$_POST["jm"];
		file_put_contents("acc.txt",$f);
		header("location: acc.php");
	}
	else {
		echo "<b>Error: Name already taken</b>";
	}

}
?>
<h2>password change</h2>
<form method=POST>
	<b>Old Password: </b><input type=password name=ohe /><br />
	<b>New Password: </b><input type=password name=he /><br />
	<b>Verify Password:</b> <input type=password name=phe /><br />
	<input type=submit name=hesla />
</form>
<?php
//kod pro zmenu hesla uzivatele
$ohe=isset($_POST["ohe"]) ? $_POST["ohe"] : "";
$he=isset($_POST["he"]) ? $_POST["he"] : "";
$phe=isset($_POST["phe"]) ? $_POST["phe"] : "";

if(isset($_POST["hesla"])){
	//validuje zadane udaje
	if($ohe===""){
		echo "<b>Error: You must enter your old password</b>";
		die();
	}
 if($he==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž.!]+$/",$he) || mb_strlen($he)<5) {
		echo "<b>Error: The password can only contain lowercase and uppercase letters, numbers, dot and ! and must be over 5 letters long! </b>";
		die();
	}
	if($he!==$phe){
		echo "<b>Error: Passwords do not match!";
		die();
	}
	//zkontroluje, zda bylo spravne zadane stare heslo
	$l=queryLs("acc.txt");
	if(isset($l[$_SESSION["jm"]])){
		if(base64_decode($l[$_SESSION["jm"]]["he"])!==$ohe){
			echo "<b>Error: THe Old Password entered is not correct<b>";
			die();
		}
	}
	else {
			echo "<b>Error: Unknown Error</b>";
			die();
	}
	//zapise nove heslo
	$f=explode("\n",file_get_contents("acc.txt"));
	foreach($f as $k=>$i){
		$t=explode(";",$i);
		if($t[0]===$_SESSION["jm"]){
			$t[2]=base64_encode($he);
		}
		$f[$k]=implode(";",$t);
	}
	$f=implode("\n",$f);
	file_put_contents("acc.txt",$f);
	echo "<b>Changed sucesfully</b>";
}
?>
</body>
</html>
