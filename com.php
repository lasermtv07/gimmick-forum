<?php
include 'menu.php';
include 'footer.php';
error_reporting(E_ALL && ~E_NOTICE && ~E_WARNING);
//PHP soubor pro funkce ktere planuju pouzivat ve vice souborech
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
function extractName($j){
	$j=explode("-",$j)[1];
	$j=explode(".",$j)[0];
	$j=str_split($j);
	$j[0]=strtoupper($j[0]);
	$j=implode("",$j);
	return $j;
}
function sanitizeCRLF($s){
	$o="";
	foreach(mb_str_split($s) as $i){
		if($s!=="\n" && $s!=="\r"){
			$o.=$i;
		}
	}
	return $o;
}

?>
