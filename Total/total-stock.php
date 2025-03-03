<?php


$result = $conn->query("SELECT SUM(stock) AS total_stock FROM item_list");
$row = $result->fetch_assoc();
$totalStocks = $row['total_stock'];


