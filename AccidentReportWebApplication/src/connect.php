<?php
$host = "localhost";
$user = "root";
$pass = "password";
$name = "AccidentReport";

$con = mysqli_connect($host, $user, $pass, $name);

if (mysqli_connect_error()) {
	echo "Fail to connect to mysql: " . mysqli_connect_error();
}
?>