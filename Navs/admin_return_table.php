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
                <th>Date of Return<i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th>
                <th>Name<i class="fa-solid fa-sort" style="margin:20px 0 0 10px;"></i></th>
                
                    </tr>
                </thead>
                    <tbody>
                    <?php
            include("../database/system_db.php");
            $sql = "SELECT * FROM return_items";
            $result = $conn->query($sql);
            
            if(!$result){
                die("Query Failed: ".$conn->error);
            }
            while ($row = $result->fetch_assoc()) {
                $return_id = $row['return_id']; // Ensure ID exists
                echo "
                <tr>
                
                    <td></td>// borrow id
                    <td>$row[item]</td>
                    <td></td> //date of borrow
                    <td></td> //name
                    
                </tr>

                    
                ";
            }
            
            ?>
                    </tbody>
            </table>
            <?php include "pagination.php"?><br>
        </form>
    </div>