<div class="table-container">
        <div class="category">
        <label for="items">Category</label>
    <select name="items" id="items">
    <option value="all">All</option>
    </select>
        <form method="POST" action="">
        </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>

                        </th>
                <th>ID <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th> 
                <th>Item <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th> 
                <th>Stock <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th>
                <th>Borrowed <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th>
                <th>Returned <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th>
                <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
include("../database/system_db.php");
$sql = "SELECT * FROM item_list";
$result = $conn->query($sql);

if (!$result) {
    die("Query Failed: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    $item_id = $row['item_id'];
    echo "
    <tr>
        <td>$item_id</td>
        <td>" . htmlspecialchars($row['item']) . "</td>
        <td>" . htmlspecialchars($row['stock']) . "</td>
        <td>" . htmlspecialchars($row['borrowed_item']) . "</td>
        <td>" . htmlspecialchars($row['returned_item']) . "</td>
        <td><div class='qrcode' data-id='$item_id'></div></td>
    </tr>
    ";
}
?>
                    </tbody>
            </table>
            <?php include "pagination.php"?><br>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("QR Code script loaded successfully.");
    
    document.querySelectorAll("tbody tr").forEach(row => {
        let itemIdElement = row.querySelector("td:nth-child(1)"); // Select ID column
        let qrTd = row.querySelector("td:nth-child(6) div"); // Correct column index

        if (itemIdElement && qrTd) {
            let itemId = itemIdElement.textContent.trim(); // Extract item ID
            
            if (itemId) {
                let serverIP = "192.168.1.3"; // Replace with your correct PC's IP address
                let borrowUrl = "http://" + serverIP + "/Project_Inventory_System/Student/user_borrowed_item.php?item_id=" + itemId;

                console.log("Generating QR for:", borrowUrl);

                // Clear previous QR codes
                qrTd.innerHTML = "";

                // Generate QR code
                new QRCode(qrTd, {
                    text: borrowUrl, 
                    width: 100, 
                    height: 100
                });
            }
        }
    });
});



</script>
