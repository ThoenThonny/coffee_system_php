<?php
     include '../config/db.php';

     $id = intval($_POST['cof_id']);

     $check = $conn->query("SELECT * FROM oders WHERE cof_id=$id");

     if($check->num_rows>0){
        $sql = "UPDATE oders SET qty= qty+1 WHERE cof_id=$id";
        
     }else{
        $sql = "INSERT INTO oders (cof_id, qty) VALUES ($id,1)";
     }

     $conn->query($sql);

     echo "success"
?>