<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "Project_Inventory_System_db";
$conn = mysqli_connect($host, $user, $password, $dbName);
if (!$conn) {
    die("Something went wrong" . mysqli_connect_error());
}

