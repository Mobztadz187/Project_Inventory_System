<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php"); // Send non-admins back to login
    exit();
}
include "../database/system_db.php";
include "../Total/total-stock.php";
include "../Total/total-student.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    
</head>
<body>
    <?php include "../Navs/admin_nav.php"?>
<main>
    <div class="dashboard-container">
    <form action="">
        <h3>Dashboard</h3>
            <div class="total-stocks" style="background-color: skyblue">Total Stocks<span class="count"><?php echo $totalStocks; ?></span></div>     
            <div class="total-students" style="background-color: green">Total Students<span class="count"><?php echo $totalUsers; ?></span></div>
            <div class="total-borrowed" style="background-color: orange">Total Borrowed<span class="count">0</span></div>
            <div class="total-returned" style=" background-color: red">Total Returned<span class="count">0</span></div>
    </form>
    </div>
</main>
</body>
</html>