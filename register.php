<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>design hell</title>
</head>
<body>
    <h1>design hell forum registration</h1>
    <form method=POST>
        <b>Name: </b><input type="text" name="jm" /><br>
        <b>E-mail: </b><input type="text" name="em" value="@" /><br>
        <b>Password: </b><input type="password" name="he" /><br>
        <b>Password again: </b><input type="password" name="phe" /><br>
        <input type="submit" name="s" />
    </form>
    <?php
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
        if(isset($_POST["s"])){
            $jm=(isset($_POST["jm"])) ? htmlspecialchars(trim($_POST["jm"])) : "";
            $em=(isset($_POST["em"])) ? $_POST["em"] : "";
            $he=(isset($_POST["he"])) ? $_POST["he"] : "";
            $phe=(isset($_POST["phe"])) ? $_POST["phe"] : "";

            if($jm==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž ]+$/",$jm) || mb_strlen($jm)<3) {
                echo "<b>The name can only contain lowercase and uppercase letters and numbers</b>";
                die();
						}
						if($em==="" || !preg_match("/^.+@.+\..+$/",$em)/* || preg_match("/:/",$em)*/) {
                echo "<b>Please enter a valid email addres!</b>";
                die();
						}
            if($he==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž.!]+$/",$he) || mb_strlen($he)<5) {
                echo "<b>The password can only contain lowercase and uppercase letters, numbers, dot and ! and must be over 5 letters long! </b>";
                die();
						}
						if($he!==$phe) {
							echo "<b>Passwords do not match!</b>";
							die();
						}
						echo "<h1>success</h1>";
        }
    ?>
</body>
</html>
