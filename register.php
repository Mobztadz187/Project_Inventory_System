<?php
session_start();
include 'database/system_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];

    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    function encryptPassword($password) {
        return openssl_encrypt($password, "AES-128-ECB", SECRET_KEY);
    }

    $encrypted_password = encryptPassword($password);

    // Check if username already exists in sample_user table
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    if (!$stmt) {
        die("Error in SELECT query: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("Username already exists!");
    }

    // Insert user into sample_user table
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, username, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error in INSERT query: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $encrypted_password, $user_type);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        die("Error executing query: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
    <div class="login-container">
    



        <form action="register.php" method="post">
            <h1>Register</h1>
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name: ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name: ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username: ">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email: ">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password: ">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password: ">
            </div>
            <div class="form-group">
    <label for="user_type">Select User Type:</label>
    <select class="form-control" name="user_type" id="user_type" required>
        <option value="" disabled selected>Select user type</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
</div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
            
            <div>
                <p>Do you have an account? Then <a href="login.php">Log In</a></p>
            </div>
        </form>
    </div>
</body>

</html>