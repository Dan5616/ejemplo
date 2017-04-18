<?php

$servername = 'localhost';
$username = 'root';
$password = 'usbw';
$dbname = 'tess';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
	echo 'Conecction Error'.mysqli_connect_error();
}
