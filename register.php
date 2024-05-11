<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css" />
    <title>gimmick-forum :: register</title>
</head>
<body>
<?php
include "com.php";
menu();
?>
<main>
		<h1>Registration</h1>
		<p>Already have an account? <a href="login.php">Login</a> on the appropriate page.
		<h3>Security requirements</h3>
		<ul>
			<li>All input characters are restricted to alphanumeric characters (including Czech orthographics)</li>
			<li>In password, you can also use a full stop and exclamation mark</li>
			<li>Name must be alteast 3 letters long, and password atleast 5 letters</li>
			<li>Email address must contain @ and afull stop</li>
		</ul>
		<form method=POST>
				<table>
        <tr><td><b>Name: </b></td><td><input type="text" name="jm" /></td></tr>
        <tr><td><b>E-mail: </b></td><td><input type="text" name="em" value="@" /></td></tr>
        <tr><td><b>Password: </b></td><td><input type="password" name="he" /></td></tr>
        <tr><td><b>Password again: </b></td><td><input type="password" name="phe" /></td></tr>
				<tr><td><input type="submit" name="s" value="Register"/></td></tr>
				</table>
    </form>
<?php
        if(isset($_POST["s"])){
            $jm=(isset($_POST["jm"])) ? htmlspecialchars(trim($_POST["jm"])) : "";
            $em=(isset($_POST["em"])) ? $_POST["em"] : "";
            $he=(isset($_POST["he"])) ? $_POST["he"] : "";
            $phe=(isset($_POST["phe"])) ? $_POST["phe"] : "";

            if($jm==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž ]+$/",$jm) || mb_strlen($jm)<3) {
                echo "<b>The name can only contain lowercase and uppercase letters and numbers and must be atleast 3 letters long!</b>";
								footer();
								die();
						}
						if($em==="" || !preg_match("/^.+@.+\..+$/",$em)/* || preg_match("/:/",$em)*/) {
							echo "<b>Please enter a valid email addres!</b>";
							footer();
                die();
						}
            if($he==="" || !preg_match("/^[A-Za-z0-9ÁČĎÉĚÍŇÓŘŠŤÚŮÝŽáčďéěíňóřšťúůýž.!]+$/",$he) || mb_strlen($he)<5) {
                echo "<b>The password can only contain lowercase and uppercase letters, numbers, dot and ! and must be over 5 letters long! </b>";
								footer();
								die();
						}
						if($he!==$phe) {
							echo "<b>Passwords do not match!</b>";
							footer();
							die();
						}
						if(!isUnique(queryLs("acc.txt"),$jm)){
							echo "<b>Account with such name already exists!</b>";
							footer();
							die();
						}
						$he=base64_encode($he);
						file_put_contents("acc.txt","$jm;$em;$he;no;no\n",FILE_APPEND);
				}
footer();
?>
</main>
</body>
</html>
