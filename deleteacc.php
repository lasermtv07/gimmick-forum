<?php
include "com.php";
session_start();
//TODO: check password
if(isset($_SESSION["jm"])){
    $f=file_get_contents("acc.txt");
    $f=explode("\n",$f);
    $o="";
    foreach($f as $i){
        if(explode(";",$i)[0]!==$_SESSION["jm"]){
            $o.=$i;
        }
    }
    unset($_SESSION["jm"]);
    file_put_contents("acc.txt",$o);
}

header("location: .");
?>
