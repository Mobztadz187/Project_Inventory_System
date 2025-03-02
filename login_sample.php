<?php 
$host = "localhost";
$user = "root";
$password = "";
$dbname = "project_inventory_system_db";

$data = mysqli_connect($host, $user, $password, $dbname);

if($data === false){
    die("connection error");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql="SELECT * from sample_user WHERE username = '$username' AND password = '$password'";
    
    $result = mysqli_query($data, $sql);

    $row = mysqli_fetch_array($result);

    if($row["user_type"]=="user"){
        header("");
    }elseif($row["user_type"]=="admin"){
        header("location: dashboard.php");
    }else{
        echo "username or password incorrect";
    }
}
?>
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
