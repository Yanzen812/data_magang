<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "data_magang";
$kon = mysqli_connect($host, $username, $password, $database);
if (!$kon) {
    die("Connection failed: " . mysqli_connect_error());
}
?>