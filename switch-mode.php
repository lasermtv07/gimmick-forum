<?php
echo $_GET["f"];
if(!isset($_COOKIE["dark"])) setcookie("dark","1",time()+3600*24*30,"/");
else {
	if($_COOKIE["dark"]=="0") setcookie("dark","1",time()+3600*24*30,"/");
	else if($_COOKIE["dark"]=="1") setcookie("dark","0",time()+3600*24*30,"/");
}
header("location: ".$_GET["f"]);
?>

