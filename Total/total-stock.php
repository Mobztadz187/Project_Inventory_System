<?php


$result = $conn->query("SELECT COUNT(*) AS stock FROM item_list");
$row = $result->fetch_assoc();
$totalStocks = $row['stock'];


