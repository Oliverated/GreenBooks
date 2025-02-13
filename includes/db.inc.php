<?php

$servername = "sql311.infinityfree.com";
$username = "if0_38309070";
$password = "rYtSdZhJDHv";
$dbname = "if0_38309070_bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}


?>