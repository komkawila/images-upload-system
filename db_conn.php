<?php  

$sname = "localhost";
// $uname = "root";
// $password = "12345678";
$uname = "komkawila";
$password = "Kkomprmw20_1111";

$db_name = "images_db";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}