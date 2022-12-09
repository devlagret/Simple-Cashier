<?php 
	//session_start();

$host = 'localhost';
$username = 'id19555243_admin';
$pass = 'devlagret123';
$db_name = 'id19555243_kasir';
$koneksi = mysqli_connect($host, $username, $pass, $db_name);
$con = new mysqli($host,$username,$pass,$db_name);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
?> 	