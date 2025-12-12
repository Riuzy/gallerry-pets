<?php
$host = "localhost";
$user = "root"; 
$pass = "";     
$db   = "sp_hewan";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database GAGAL: " . mysqli_connect_error());
}
?>