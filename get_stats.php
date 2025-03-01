<?php
// Database connection (same as before)
// ...

header('Content-Type: application/json');

$stats = [
    'students' => $conn->query("SELECT COUNT(*) FROM users WHERE is_logged_in = 1")->fetch_row()[0],
    'stocks' => $conn->query("SELECT COUNT(*) FROM items")->fetch_row()[0],
    'borrowed' => $conn->query("SELECT SUM(quantity) FROM transactions WHERE status = 'borrowed'")->fetch_row()[0],
    'returned' => $conn->query("SELECT SUM(quantity) FROM transactions WHERE status = 'returned'")->fetch_row()[0]
];

echo json_encode($stats);
$conn->close();
?>