<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = 'gym';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Connection successful, you can perform database operations here

?>


