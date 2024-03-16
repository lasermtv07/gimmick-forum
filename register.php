<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>design hell</title>
</head>
<body>
<?php
include "com.php";
menu();
?>
    <h1>design hell forum registration</h1>
    <form method=POST>
        <b>Name: </b><input type="text" name="jm" /><br>
        <b>E-mail: </b><input type="text" name="em" value="@" /><br>
        <b>Password: </b><input type="password" name="he" /><br>
        <b>Password again: </b><input type="password" name="phe" /><br>
        <input type="submit" name="s" />
    </form>
<?php
        if(isset($_POST["s"])){
            $jm=(isset($_POST["jm"])) ? htmlspecialchars(trim($_POST["jm"])) : "";
            $em=(isset($_POST["em"])) ? $_POST["em"] : "";
            $he=(isset($_POST["he"])) ? $_POST["he"] : "";
            $phe=(isset($_POST["phe"])) ? $_POST["phe"] : "";

            if($jm==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž ]+$/",$jm) || mb_strlen($jm)<3) {
                echo "<b>The name can only contain lowercase and uppercase letters and numbers and must be atleast 3 letters long!</b>";
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
						if(!isUnique(queryLs("acc.txt"),$jm)){
							echo "<b>Account with such name already exists!</b>";
							die();
						}
						echo "<h1>success</h1>";
						$he=base64_encode($he);
						file_put_contents("acc.txt","$jm;$em;$he;no;no\n",FILE_APPEND);
						var_dump(queryLs("acc.txt"));
				}

    ?>
</body>
</html>
