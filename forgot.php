<?php
include "com.php";
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>gimmick forum :: forgotten password</title>
	<link rel=stylesheet href=css/style.css />
</head>
<body>
	<?php menu(); ?>
<main>
	<h1>forgotten password</h1>
	<p>Note that this will not prompt you to change your password, it will merely send the password in plaintext, because website telling me what to do is literally 1984 moment (yes Im making this at 1AM howd you know). However, it is recommended that you change it in the accounts page (click the icon with your name on the menu bar), since Im, y know, sending it in plaintext, which is not very safe.</p>
	<form method=POST>
		<b>email: </b><input type=text name=m /><br />
		<input type=submit name=s value="Check email" />
	</form>
<?php
session_start();
if(isset($_SESSION["jm"])){
	echo "<b>Error: Must not be logged in</b>";
	die();
}
$e=true;
if(isset($_POST["s"]) && $_POST["m"]!==""){
	$a=file_get_contents("acc.txt");
	$a=explode("\n",$a);
	foreach($a as $i){
		$t=explode(";",$i);
		$p=base64_decode($t[2]);
		if($t[1]==$_POST["m"]){
			$e=false;
			$m="Dear ".$t[0].",\nwe have received a request saying you forgot your password.\n";
			$m.="Hence, we are mailing you your password. Keep in mind that its a good practice to reset password after forgetting it, which you can do in the account tab.";
			$m.="\nYour password is: $p\nBest wishes,\nAdministration";
			mail($t[1], "gimmick forum :: forgotten password","",$m);
			echo "<b>Email has been sent</b>";
		}
		
	}
	if($e) echo "<b>Error: The entered email is invalid!</b>";
}
footer();
?>
</main>
</body>
</html>
