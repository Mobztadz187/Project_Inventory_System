<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_type'] === 'admin') {
    header("Location: login.php"); // Send admins back to login
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body>
<?php include "../Navs/student_nav.php"?>
    <div class="container"> 
            <input type="text" placeholder="Search">
            <i class="fas fa-search" style="font-size: 23px; color: white; background-color: #007bff; border: solid 1px black; margin-bottom: 10px"></i>
            <div class="content"><form action="">
            </form>
    </div>
    <?php include "../Navs/item-table.php"?>
</div>
</body>
</html>