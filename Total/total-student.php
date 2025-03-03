<?php
$resultUsers = $conn->query("SELECT COUNT(*) AS total_users FROM user WHERE user_type = 'user'");
$rowUsers = $resultUsers->fetch_assoc();
$totalUsers = isset($rowUsers['total_users']) ? $rowUsers['total_users'] : 0;
