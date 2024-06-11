<?php
include 'com.php';
foreach(scandir("boards") as $i){

	if(explode("-",$i)[0]=="bo"){
		echo "<form method=POST>";
		echo "<h2><input type=text name=tname value=\"$i\" />";
		echo "<input type=submit name=delete value=Delete />";
		echo "<input type=submit name=rename value=Rename />";
		echo "<input type=hidden name=name value=$i />";
		echo "</h2></form>";
	}
}
?>
<h3>Create a new board</h3>
<form method=POST>
	<b>Name: </b><input type=text name=name /><br>
	<b>Gimmick:</b><br>
	<textarea name=gimmick ></textarea><br>
	<input type=submit name=create value=Create />
</form>
<?php
if(isset($_POST["delete"])){
	$n=$_POST["name"];
	echo "Going to <b>delete</b> $n.";
	unlink("boards/$n");
	header("location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}
if(isset($_POST["rename"])){
	$n=$_POST["name"];
	$nn=$_POST["tname"];
	echo "Going to <b>rename</b> $n to $nn.";
	rename("boards/$n","boards/$nn");
	header("location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
}
if(isset($_POST["create"])){
	$n=$_POST["name"];
	$g=$_POST["gimmick"];
	if(!file_exists("boards/$n")){
		echo "<b>Created</b> board $n with gimmick $g.";
		file_put_contents("boards/$n",sanitizeCRLF($g)."\n\n");
		header("location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	}
	else {
		echo "Board already exists";
	}
}
?>
