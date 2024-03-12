<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIET forums</title>
</head>
<body>
    <h1>PIET forum registration</h1>
    <form method=POST>
        <b>Name: </b><input type="text" name="jm" /><br>
        <b>E-mail: </b><input type="text" name="em" value="@" /><br>
        <b>Password: </b><input type="password" name="he" /><br>
        <b>Password again: </b><input type="password" name="phe" /><br>
        <input type="submit" name="s" />
    </form>
    <?php
    function freeDiacritics($s){
        $a=str_split($s);
        foreach($a as $k=>$i){
            switch($i){
                case "Á":$a[$k]="A";
                case "Č":$a[$k]="C";
                case "Ď":$a[$k]="D";
                case "É":$a[$k]="E";
                case "Ě":$a[$k]="E";
            }
        }
    }
        if(isset($_POST["s"])){
            $jm=(isset($_POST["jm"])) ? htmlspecialchars(trim($_POST["jm"])) : "";
            $em=(isset($_POST["em"])) ? $_POST["em"] : "";
            $he=(isset($_POST["he"])) ? $_POST["he"] : "";
            $phe=(isset($_POST["phe"])) ? $_POST["phe"] : "";

            if($jm==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž]+$/",$jm) || mb_strlen($jm)<3) {
                echo "<b>The name can only contain lowercase and uppercase letters and numbers</b>";
                die();
            }

        }
    ?>
</body>
</html>
