<?php
    include '../config/db.php';

    $id = $_POST['cof_id'];

    $sql = "SELECT * FROM prd_coffee WHERE cof_id= $id";

    $result = $conn->query($sql);

    $row = mysqli_fetch_assoc($result);

   
        echo json_encode($row);
    
    
?>