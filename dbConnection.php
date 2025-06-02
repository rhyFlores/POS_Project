<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "bookerpos_final";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
