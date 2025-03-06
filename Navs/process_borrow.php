<?php
session_start();
include("../database/system_db.php");

// Check if user is logged in (assuming user session is stored)
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to borrow an item.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID
$item_id = $_POST['item_id'];

// Fetch the current stock and borrowed count
$sql = "SELECT stock, borrowed_item FROM item_list WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item || $item['stock'] <= 0) {
    die("Item not available for borrowing.");
}

$updatedStock = $item['stock'] - 1;
$updatedBorrowed = $item['borrowed_item'] + 1;

// Insert into borrow log (Assuming a `borrowed_items` table)
$sql = "INSERT INTO borrowed_items (user_id, item_id, borrow_date) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $item_id);
$stmt->execute();

// Update stock and borrowed count
$sql = "UPDATE item_list SET stock = ?, borrowed_item = ? WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $updatedStock, $updatedBorrowed, $item_id);
$stmt->execute();

header("Location: ../Student/user_borrowed_item.php?success=1");
exit();
?>
