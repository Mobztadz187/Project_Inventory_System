<?php
include "../Navs/admin_nav.php";
include "../database/system_db.php";  

$id = "";
$item = "";
$stock = "";
$input = "";
$output = "";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['item_id'])) {
        header("location:../Admin/item-list.php");
        exit;
    }

    $item_id = $_GET['item_id'];
    $sql = "SELECT * FROM item_list WHERE item_id=$item_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ../Admin/item-list.php");
        exit;
    }

    $item = $row["item"];
    $stock = $row["stock"];
} else {
    $item_id = $_POST["item_id"] ?? "";
    $item = $_POST["item"] ?? "";
    $stock = $_POST["stock"] ?? "";

    $sql = "UPDATE item_list SET item='$item', stock='$stock' WHERE item_id='$item_id'";
    $result = $conn->query($sql);

    if ($result) {
        $success = "Item updated successfully!";
    } else {
        $error = "Error updating item: " . $conn->error;
    }
    header("location:../Admin/item-list.php?message=Item edited");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
        <title>Update Item</title>
</head>

<body>
    <div class="col-lg-6 m-auto">
        <form method="post">
            <br><br>
            <div class="card">
                <div class="card-header bg-warning">
                    <h1 class="text-white text-center"> Update Item </h1>
                </div><br>

                <!-- Display success or error messages -->
                <?php if ($error) { echo "<p class='text-danger text-center'>$error</p>"; } ?>
                <?php if ($success) { echo "<p class='text-success text-center'>$success</p>"; } ?>

                <input type="hidden" name="id" value="<?php echo $item_id; ?>" class="form-control"> <br>

                <label> ITEM: </label>
                <input type="text" name="item" value="<?php echo $item; ?>" class="form-control"> <br>

                <label> STOCK: </label>
                <input type="number" name="stock" value="<?php echo $stock; ?>" class="form-control"> <br>

                <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="../Admin/item-list.php" style="background-color: red; color: white; border-color: maroon;"> Cancel </a><br>
            </div>
        </form>
    </div>
</body>

</html>
