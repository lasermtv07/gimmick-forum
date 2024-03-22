<?php
session_start();
unset($_SESSION["jm"]);
unset($_SESSION["ad"]);
header("location: .");
?>
