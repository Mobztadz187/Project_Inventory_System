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
                <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
            include("database/system_db.php");
            $sql = "SELECT * FROM item_list";
            $result = $conn->query($sql);
            
            if(!$result){
                die("Query Failed: ".$conn->error);
            }
            while ($row = $result->fetch_assoc()) {
                $id = $row['id']; // Ensure ID exists
                echo "
                <tr>
                <th>
                    <td>$id</td>
                    <td>$row[item]</td>
                    <td>$row[stock]</td>
                    <td><div class='qrcode' data-id='$id'></div></td> 
                </th>
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
        document.querySelectorAll("tbody tr").forEach(row => {
            let itemIdElement = row.querySelector("td:nth-child(2)"); // Select ID column (2nd column)
            let qrTd = row.querySelector("td:nth-child(5) div"); // Select QR code container (5th column)

            if (itemIdElement && qrTd) {
                let itemId = itemIdElement.textContent.trim(); // Extract item ID
                
                if (itemId) {
                    let borrowUrl = "/Project_Inventory_System/borrow-item.php?id=" + itemId; // Modify URL accordingly

                    // Generate QR code
                    new QRCode(qrTd, {
                        text: borrowUrl, // QR code contains the borrow link
                        width: 50, // Adjusted for better visibility
                        height: 50
                    });
                }
            }
        });
    });
</script>
