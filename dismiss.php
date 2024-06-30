<?php
include "com.php";
//namovaci konvence tady pls nereste :3
session_start();
if($_SESSION["ad"]){
	$i=$_GET["i"];
	if($i==""){
		echo "<b>Error: no parameter</b>";
		die();
	}
	dismiss($i);
	header("location:reportmng.php");
}
else echo "<b>Error: must be admin!</b>";
?>
