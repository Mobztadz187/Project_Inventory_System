<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "Project_Inventory_System_db";
$conn = mysqli_connect($host, $user, $password, $dbName);
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

define("SECRET_KEY", "my_secret_key");