<?php
include '../config/db.php';
$id = intval($_POST['order_id']);
$type = $_POST['type'];
$result = $conn->query("SELECT * FROM oders WHERE order_id=$id");
$row = $result->fetch_assoc();
$qty = $row['qty'];
if($type=="plus"){
    $qty++;
}else{
   $qty = max(1, $qty - 1); 
}
$conn->query("UPDATE oders SET qty=$qty WHERE order_id=$id");
echo "success";
?>