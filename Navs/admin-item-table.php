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
                        
                <th>ID <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th> 
                <th>Item <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th> 
                <th>Stock <i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th>
                <th>Borrowed<i class="fa-solid fa-sort" style="margin: 20px 0 0 10px;"></i></th>
                <th>Returned<i class="fa-solid fa-sort" style="margin: 20px 0 0 10px;"></i></th>
                <th style="margin: 20px 0 0 10px;">Actions</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
            include("../database/system_db.php");
            $sql = "SELECT * FROM item_list";
            $result = $conn->query($sql);
            
            if(!$result){
                die("Query Failed: ".$conn->error);
            }
            while ($row = $result->fetch_assoc()) {
                $item_id = $row['item_id']; // Ensure ID exists
                echo "
                <tr>
                
                    <td>$item_id</td>
                    <td>$row[item]</td>
                    <td>$row[stock]</td>
                    <td></td>
                    <td></td>
                   <td>
                    <a class='btn btn-success' href='../CRUD/edit_item.php?item_id=$row[item_id]'>Edit</a>
                    <a class='btn btn-danger' href='../CRUD/delete_item.php?item_id={$row['item_id']}'>Delete</a>
                   </td>
                </tr>

                    
                ";
            }
            
            ?>
                    </tbody>
            </table>
            <?php include "pagination.php"?><br>
        </form>
    </div>