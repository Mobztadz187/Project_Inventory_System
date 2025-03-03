<?php
include "../Navs/admin_nav.php";
include "../database/system_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = trim($_POST["item"]); // Trim to remove unnecessary spaces
    $stock = $_POST["stock"];

    // **1️⃣ Check if item already exists**
    $stmtCheck = $conn->prepare("SELECT stock FROM item_list WHERE item = ?");
    $stmtCheck->bind_param("s", $item);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // **2️⃣ If item exists, update the stock**
        $newStock = $row['stock'] + $stock;
        $stmtUpdate = $conn->prepare("UPDATE item_list SET stock = ? WHERE item = ?");
        $stmtUpdate->bind_param("is", $newStock, $item);
        $stmtUpdate->execute();
        $stmtUpdate->close();
    } else {
        // **3️⃣ If item doesn't exist, insert a new row**
        $stmtInsert = $conn->prepare("INSERT INTO item_list (item, stock) VALUES (?, ?)");
        $stmtInsert->bind_param("si", $item, $stock);
        $stmtInsert->execute();
        $stmtInsert->close();
    }

    $stmtCheck->close();
    $conn->close();

    // **4️⃣ Redirect back with success message**
    header("Location: ../Admin/item-list.php?message=Item added or updated");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Add New Item</title>
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning">
                <h1 class="text-white text-center"> Add Item </h1>
            </div>
            <form action="add_item.php" method="post"> <!-- Corrected form action -->
                <div class="mb-3">
                    <label for="item" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="item" name="item" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                <a href="item_list.php" class="btn btn-danger">Cancel</a> <!-- Fixed Cancel button -->
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
