<!DOCTYPE HTML>
<html>
<head>
	<title>delete account?</title>
</head>
<body>
<?php
include "com.php";
session_start();
?>
<h1>delete account</h1>
<p>Hello <?php echo $_SESSION["jm"]; ?>, are you sure you want to delete your account?
If yes, please type you password below:</p>
<form method=POST>
<b>Password:</b> <input type=password name=he />
<br /> <input type=submit name=s />
<?php
if(!isset($_POST["s"])){
	die();
}
if(!isUnique(queryLs("acc.txt"),$_SESSION["jm"])){
	$l=queryLs("acc.txt");
	if(base64_decode($l[$_SESSION["jm"]]["he"])!==$_POST["he"]){
		echo "<b>Error: Bad Credentials</b>";
		die();
	}
}
else {
	echo "<b>Error: Account doesnt exist</b>";
	die();
}
if(isset($_SESSION["jm"])){
    $f=file_get_contents("acc.txt");
    $f=explode("\n",$f);
    $o="";
    foreach($f as $i){
        if(explode(";",$i)[0]!==$_SESSION["jm"]){
            $o.="$i\n";
        }
    }
    unset($_SESSION["jm"]);
    file_put_contents("acc.txt",$o);
}

header("location: .");
?>
</body>
</html>
