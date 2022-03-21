<?php
$hostname = "localhost";
$database = "mlbbcomm_anggota";
$username = "mlbbcomm_admin";
$password = "Adminpalsu";
$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("Connection Failed: " . mysqli_connect_error());
}