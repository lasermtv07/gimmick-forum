<?php
include 'com.php';
$d=[];
foreach(scandir(__DIR__) as $i){
        if(explode("-",$i)[0]=="bo"){
                array_push($d,$i);
        }
}
if(isset($_GET["r"])){
        foreach($d as $i){
                $t=file_get_contents($i);
                $ta="";
                foreach(explode("\n",$t) as $j){
                        if(explode("~",$j)[0]!=$_GET["r"]) $ta.="$j\n";
                }
                file_put_contents($i,$ta);
        }
}
?>
