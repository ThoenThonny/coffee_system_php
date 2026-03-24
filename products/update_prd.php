<?php
include '../config/db.php';
session_start();
if ($_SESSION['user_role'] != 'admin') {
    echo 'user is not role admin';
    exit();
}

$id = $_POST['cof_id'];
$name = $_POST['cof_name'];
$qty = $_POST['cof_qty'];
$price = $_POST['cof_price'];
$olde_image = $_POST['old_image'];

if (!empty($_FILES['cof_image']['name'])) {

    unlink("../uploads/".$olde_image);

    $image = $_FILES['cof_image']['name'];
    $tmp = $_FILES['cof_image']['tmp_name'];

    $folder = '../uploads/' . $image;

    move_uploaded_file($tmp, $folder);

    $sql = "UPDATE prd_coffee SET cof_name='$name',cof_qty=$qty,cof_price =$price,cof_image='$image' WHERE cof_id=$id";
}else{
    $sql = "UPDATE prd_coffee SET cof_name='$name',cof_qty=$qty,cof_price =$price  WHERE cof_id=$id";

}

$conn->query($sql);

echo json_encode([
    "status" => "success",
    "id" => $id,
    "name" => $name,
    "qty" => $qty,
    "price" => $price,
    "image" => $image ?? $olde_image
]);
