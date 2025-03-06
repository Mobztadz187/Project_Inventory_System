<?php
session_start();
include("../database/system_db.php");

// Check if item_id is provided in the URL
if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Fetch item details
    $sql = "SELECT * FROM item_list WHERE item_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if (!$item) {
        die("<h3>Item not found.</h3>");
    }
} else {
    die("<h3>No item selected.</h3>");
}

// Success message after borrowing
$success_message = isset($_GET['success']) ? $_GET['success'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <?php include "../Navs/student_nav.php"?>
    <main class="container mt-4">
        <h2>Borrow Item</h2>

        <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <p><strong>Item Name:</strong> <?php echo htmlspecialchars($item['item']); ?></p>
        <p><strong>Stock Available:</strong> <?php echo htmlspecialchars($item['stock']); ?></p>

        <form action="process_borrow.php" method="POST">
            <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
            <button type="submit" class="btn btn-primary">Confirm Borrow</button>
        </form>
    </main>
</body>
</html>
