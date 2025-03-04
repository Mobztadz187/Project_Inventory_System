<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://kit.fontawesome.com/YOUR_FA_KIT.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include "../Navs/admin_nav.php"?>

    <div class="container">
        
            <input type="text" placeholder="Search">
            <i class="fas fa-search" style="font-size: 23px; color: white; background-color: #007bff; border: solid 1px black; margin-bottom: 10px"></i>
            <div class="content"><form action="">

            </form>
    </div>
    <?php include "../Navs/admin_borrowed_table.php"?>
</body>
</html>