<?php

$sName    = "localhost";
$uName    = "root";
$pass = "";
$db_name = "online_book_store";

$conn = mysqli_connect($sName, $uName, $pass, $db_name);

if (!$conn) {
	echo "Connection failed!";
}