<?php
include "../config/db.php";
session_start();

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin'){
    echo "Access Denied";
    exit();
}

$id = $_POST['cof_id'];

// get image first
$result = $conn->query("SELECT cof_image FROM prd_coffee WHERE cof_id=$id");
$row = $result->fetch_assoc();

if($row){
    $path = "../uploads/" . $row['cof_image'];

    if(file_exists($path)){
        unlink($path); // delete image
    }

    $conn->query("DELETE FROM prd_coffee WHERE cof_id=$id");

    echo "success";
}else{
    echo "not found";
}