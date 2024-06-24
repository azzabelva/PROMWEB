<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'db_hotel';

$conn = mysqli_connect($server, $user, $password, $database);
if(!$conn){
    die("Gagal menghubungkan ke database : ". mysqli_connect_error())
}
?>