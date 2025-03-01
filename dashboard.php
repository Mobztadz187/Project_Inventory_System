<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this if using another user
$password = ""; // Change this if your MySQL user has a password
$database = "project_inventory_system_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get counts from database
$total_students = $conn->query("SELECT COUNT(*) FROM users WHERE is_logged_in = 1")->fetch_row()[0];
$total_stocks = $conn->query("SELECT COUNT(*) FROM items")->fetch_row()[0];
$total_borrowed = $conn->query("SELECT SUM(quantity) FROM transactions WHERE status = 'borrowed'")->fetch_row()[0];
$total_returned = $conn->query("SELECT SUM(quantity) FROM transactions WHERE status = 'returned'")->fetch_row()[0];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="https://kit.fontawesome.com/YOUR_FA_KIT.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <?php include "nav.php"?>
<main>
    <div class="dashboard-container">
        

    <form action="">
    <h3>Dashboard</h3>
    <div class="total-students">Total Students: <span id="total-students">0</span></div>
    <div class="total-stocks">Total Stocks: <span id="total-stocks">0</span></div>
    <div class="total-borrowed">Total Borrowed: <span id="total-borrowed">0</span></div>
    <div class="total-returned">Total Returned: <span id="total-returned">0</span></div>
</form>

<script>
    async function fetchDashboardData() {
        try {
            const response = await fetch('/api/dashboard-data'); // Replace with your actual API URL
            const data = await response.json();

            document.getElementById('total-students').textContent = data.totalStudents;
            document.getElementById('total-stocks').textContent = data.totalStocks;
            document.getElementById('total-borrowed').textContent = data.totalBorrowed;
            document.getElementById('total-returned').textContent = data.totalReturned;
        } catch (error) {
            console.error("Error fetching dashboard data:", error);
        }
    }

    // Fetch data every 5 seconds
    setInterval(fetchDashboardData, 5000);
    fetchDashboardData(); // Initial call
</script>
    </div>

</main>
</body>
</html>