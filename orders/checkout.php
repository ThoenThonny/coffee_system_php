<?php
    include "../config/db.php";
    $sql = "DELETE FROM oders";
    $conn->query($sql);
    
    echo "success";
?>