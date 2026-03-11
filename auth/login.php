<?php
include '../config/db.php';
session_start();
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['user_email'];
$password = $data['user_password'];

$sql = "SELECT * FROM users WHERE user_email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

       

    if (password_verify($password, $user['user_password'])) {
         $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_role'] = $user['user_role'];
        echo json_encode([
            "status" => "success",
            "message" => "Login success"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Wrong Password"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Login failed"
    ]);
}
?>
