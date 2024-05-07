<?php
session_start();
if(isset($_COOKIE["remember"])){
	setcookie("remember","xn",0,"/");
}
unset($_SESSION["jm"]);
unset($_SESSION["ad"]);
header("location: .");
?>
