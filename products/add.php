<?php
    include '../config/db.php';
    session_start();
    if($_SESSION['user_role']!= 'admin'){
        echo 'user is not role admin';
        exit();
    }

    $name = $_POST['cof_name'];
    $qty = $_POST['cof_qty'];
    $price = $_POST['cof_price'];

    $image = $_FILES['cof_image']['name'];
    $tmp = $_FILES['cof_image']['tmp_name'];

    $folder = '../uploads/'.$image;

    move_uploaded_file($tmp, $folder);

    $sql = "INSERT INTO prd_coffee(cof_name, cof_qty, cof_price, cof_image) VALUES ('$name',$qty,$price,'$image')";
    $conn->query($sql);

    echo 'success';
?>