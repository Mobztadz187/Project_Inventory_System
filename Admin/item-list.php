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
<?php include "../Navs/admin_nav.php"?>
 

    <div class="container">
        <h1>Return Items</h1>
    <?php
    if (isset($_GET['message'])) {
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert' id='autoCloseAlert'>
                " . htmlspecialchars($_GET['message']) . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
?>
            <input type="text" placeholder="Search">
            <i class="fas fa-search" style="font-size: 23px; color: white; background-color: #007bff; border: solid 1px black; margin-bottom: 10px"></i>
            <div class="content"><form action="">

            </form>
    </div>
    <?php include "../Navs/admin-item-table.php"?>
</div>

<script>
    
    setTimeout(function() {
        var alert = document.getElementById('autoCloseAlert');
        if (alert) {
            alert.remove(); // Directly remove the alert from the DOM
        }
    }, 3000);
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"></script>
</body>
<script>
    
</script>
</html>