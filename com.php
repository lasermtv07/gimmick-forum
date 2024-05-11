<?php
include 'menu.php';
include 'footer.php';
//E:PHP file for functions common or expected-to-be-common across multiple files
//C:PHP soubor pro funkce ktere planuju pouzivat ve vice souborech
function queryLs($l){
        $f=file_get_contents($l);
        $o=[];
        foreach(explode("\n",$f) as $i){
                $t=explode(";",$i);
                if(sizeof($t)>=5){
                        $o[$t[0]]=["em"=>$t[1],"he"=>$t[2],"ad"=>$t[3],"th"=>$t[4]]; //E: ad tells abt admin privilegies C: ad rika esi ma uzivatel adminska prava
                }
        }
        return $o;
}
//E:using $l since its more like a list than database
//C:pouzivam $l protoze je to spise jako seznam nez databaze
function isUnique($l,$s){
        return !array_key_exists($s,$l);
}
    function encodeName($s){
        $a=mb_str_split(mb_strtolower($s));
        foreach($a as $k=>$i){
                if($i==='á') $a[$k]="a";
                if($i==="č") $a[$k]="c";
                if($i==="ď") $a[$k]="d";
                if($i==="é") $a[$k]="e";
                if($i==="ě") $a[$k]="e";
                if($i==="í") $a[$k]="i";
                if($i==="ň") $a[$k]="n";
                if($i==="ó") $a[$k]="o";
                if($i==="ř") $a[$k]="r";
                if($i==="š") $a[$k]="s";
                if($i==="ť") $a[$k]="t";
                if($i==="ú") $a[$k]="u";
                if($i==="ů") $a[$k]="u";
                if($i==="ý") $a[$k]="y";
                if($i==="ž") $a[$k]="z";
                if($i===" ") $a[$k]="-";
                }
                $a=implode("",$a);
                return $a;
    }
function extractName($j){
	$j=explode("-",$j)[1];
	$j=explode(".",$j)[0];
	$j=str_split($j);
	$j[0]=strtoupper($j[0]);
	$j=implode("",$j);
	return $j;
}
?>
