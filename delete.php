<?php
include 'com.php';
$d=[];
foreach(scandir(__DIR__) as $i){
        if(explode("-",$i)[0]=="bo"){
                array_push($d,$i);
        }
}
session_start();
if(isset($_GET["r"]) && $_SESSION["ad"]){
        foreach($d as $i){
                $t=file_get_contents($i);
                $ta="";
                foreach(explode("\n",$t) as $j){
                        if(explode("~",$j)[0]!=$_GET["r"]) $ta.="$j\n";
								}
								echo $ta;
                file_put_contents($i,$ta);
        }
}
echo $_SESSION["ad"];
header("location: board.php?f=".$_GET["o"]);
?>
