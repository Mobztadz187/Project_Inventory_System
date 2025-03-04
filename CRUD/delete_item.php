<?php
include "../database/system_db.php";
if (isset($_GET["item_id"])) {
    $item_id = $_GET["item_id"];

    // Delete the specific item
    $conn->query("DELETE FROM item_list WHERE item_id=$item_id");

    // Resequence the IDs to remove gaps
    $conn->query("SET @new_id = 0");
    $conn->query("UPDATE item_list SET item_id = (@new_id := @new_id + 1) ORDER BY item_id");
    $conn->query("ALTER TABLE item_list AUTO_INCREMENT = 1");
}

header("location:../Admin/item_list.php?message=Item deleted");
exit;
