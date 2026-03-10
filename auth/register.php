<?php
include '../config/db.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['user_name'];
$email = $data['user_email'];
$password = password_hash($data['user_password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (user_name,user_email,user_password,user_role)
VALUES ('$name','$email','$password','staff')";

$result = $conn->query($sql);

if($result){
    echo json_encode([
        "status"=>"success",
        "message"=>"Register success"
    ]);
}else{
    echo json_encode([
        "status"=>"error",
        "message"=>"Register failed"
    ]);
}

?>