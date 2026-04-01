<?php
    include "../config/db.php";
    $id = intval($_POST['order_id']);
    
    if($id>0){
        $sql = "DELETE FROM `oders` WHERE order_id=$id";
        $conn->query($sql);
        echo "success";
    }else{
        echo "Invalid order ID";
    }
?>