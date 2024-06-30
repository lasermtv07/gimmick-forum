<?php
include 'com.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>gimmick-forum :: report</title>
	<link rel=stylesheet href=css/style.css />
</head>
<body>
	<?php menu(); ?>
	<main>
	<h1>report a message</h1>
	<form method=POST >
		<b>Message ID:</b>
		<input type=text value="<?php echo isset($_GET["pre"]) ? $_GET["pre"] : ""; ?>" name=m /><br>
		<b>Additional info:</b><br><textarea name=r></textarea><br>
		<input type=submit name=s value="Submit report" />
<?php
session_start();
$m=$_POST["m"];
$r=$_POST["r"];
$j=$_SESSION["jm"];
if(isset($_POST["s"])){
	if(!isset($_SESSION["jm"])){
		echo "<br><b>Error: Must be logged in!</b>";
		footer();
		die();
	}
	if(!isRealMessage($m)){
		echo "<br><b>Error: Invalid Message ID</b>";
		footer();
		die();
	}
	if(trim($r)=="" || preg_match("/[~;]+/",$r)){
		echo "<br><b>Error: Must enter a valid reason why are you reporting!<br>";
		echo "Due to markup reason ~ and ; are not allowed within the message!</b>";
		footer();
		die();
	}
	$r=htmlspecialchars($r);
	if(preg_match("/$m;$j;$r~/",file_get_contents("reports.txt"))){
		echo "<br><b>Error: Cannot post duplicate reports!</b>";
		footer();
		die();
	}
	file_put_contents("reports.txt","$m;$j;$r~",FILE_APPEND);
	echo "<b><br>Sucessfully reported!</b>";
}
footer();
?>
	</form>
	</main>
</body>
