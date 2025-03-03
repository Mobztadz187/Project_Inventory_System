<?php
session_start();
include 'database/system_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    function decryptPassword($encrypted_password) {
        return openssl_decrypt($encrypted_password, "AES-128-ECB", SECRET_KEY);
    }

    // Check username
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $decrypted_password = decryptPassword($user['password']);

        if ($password === $decrypted_password) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
        
            if ($_SESSION['user_type'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: user_item_list.php");
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>







<!-- HTML part (Same as your original form) -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="login-container">
        <form action="#" method="POST">
            <h1>Login</h1>
            <div class="form-group">
                <input type="text" placeholder="Enter Username: " name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password: " name="password" class="form-control" required>
            </div>
            <div class="form-btn">
                <input type="submit" value="Log In" name="submit" class="btn btn-primary">
            </div>
            <div>
                <br>
                <p>No account? Just <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
