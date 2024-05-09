<!DOCTYPE HTML>
<html>
<head>
	<title>account</title>
	<link rel=stylesheet href=css/style.css />
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
menu();
?>
<main>
	<h2>user info</h1>
	<form method=POST>
	<b>Name: </b><input type=text name=jm value="<?php echo $jm ?>"/> <br>
	<b>Email: </b><input type=text name=mail value="<?php echo $mail; ?>" /> <br>
	<input type="submit" name="info" value="Change"/>
	</form>
<?php
//kod pro zmenu emailu/jmena uzivatele
if(isset($_POST["info"])){
	//kontroluje unikatnost jmena
	if(isUnique(queryLs("acc.txt"),$_POST["jm"] || $_POST["jm"]===$_SESSION["jm"])){
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
	if(isset($_COOKIE["remember"])) setcookie("remember","",1,"/");
	}
	else {
		echo "<b>Error: Name already taken</b>";
	}

}
?>
<h2>password change</h2>
<form method=POST>
<table>
	<tr><td><b>Old Password: </b></td><td><input type=password name=ohe /></td></tr>
	<tr><td><b>New Password: </b></td><td><input type=password name=he /></td></tr>
	<tr><td><b>Verify Password:</b></td><td><input type=password name=phe /></td></tr>
	<tr colspan=2><td><input type=submit name=hesla value="Change" /></td></tr>
</table>
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
<h1>delete account</h1>
<p>Were sorry that you are leaving! However, before you go, please confirm your password so we know it's really you and not some impostor.</p>
<form method=POST>
<b>Password: </b> <input type=password name=dhe /><br />
<input type=submit name=ds value=Delete />
</form>
<?php
if(isset($_POST["ds"])){
	$l=queryLs("acc.txt");
if(isset($l[$_SESSION["jm"]])){
		if(base64_decode($l[$_SESSION["jm"]]["he"])!==$_POST["dhe"]){
			echo "<b>Error: The Password entered is not correct<b>";
			die();
		}
	}
	else {
			echo "<b>Error: Unknown Error</b>";
			die();
	}
	$f=explode("\n",file_get_contents("acc.txt"));
	$o="";
	foreach($f as $i){
		if(explode(";",$i)[0]!==$_SESSION["jm"]) $o.="$i\n";
	}
	file_put_contents("acc.txt",$o);
	if(isset($_COOKIE["remember"])) setcookie("remember","",1,"/");
	unset($_SESSION["jm"]);
	header("location: .");
}
?>
footer();
?>
</main>
</body>
</html>
