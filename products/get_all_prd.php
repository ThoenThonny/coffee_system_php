<?php
     include '../config/db.php';
     header("Content-Type: application/json");

     $sql = "SELECT * FROM prd_coffee";

     $result = $conn->query($sql);
     $products = [];

     if($result->num_rows > 0){
        while($row=$result->fetch_assoc()){
            $products[] = $row;
        }
     }

     echo json_encode($products);

?>