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
    <?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    $errors = array();

    // Validate inputs
    if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
        array_push($errors, "All fields are required.");
    }
    if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        array_push($errors, "Username must be 3-20 characters long and contain only letters, numbers, or underscores.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format.");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }
    if ($password !== $confirmPassword) {
        array_push($errors, "Passwords do not match.");
    }

    // Connect to database
    require_once "database/system_db.php";

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Corrected order: username first, then email
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Email or Username already exists.");
        }
    } else {
        error_log("MySQL Error (SELECT query): " . mysqli_error($conn)); // Log for debugging
        array_push($errors, "An unexpected error occurred. Please try again later.");
    }

    // Display errors
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // Securely hash the password with SHA-256 and a salt
        $salt = bin2hex(random_bytes(32)); // Generate a secure salt
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        // Insert into the database
        $sql = "INSERT INTO users (username, first_name, last_name, email, password, salt) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssss", $username, $firstName, $lastName, $email, $passwordHashed, $salt);
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            } else {
                error_log("MySQL Error (INSERT query): " . mysqli_error($conn));
                echo "<div class='alert alert-danger'>Something went wrong while inserting data.</div>";
            }
        } else {
            error_log("MySQL Error (INSERT query preparation): " . mysqli_error($conn));
            die("An error occurred while preparing the INSERT query.");
        }
    }
}
?>


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
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
            <div>
                <p>Do you have an account? Then <a href="login.php">Log In</a></p>
            </div>
        </form>
    </div>
</body>

</html>