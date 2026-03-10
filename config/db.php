<?php
    $conn = new mysqli("localhost","root","","db_php_time7",3306);
    if($conn->connect_error){
        echo "<h1>Error Connection</h1>";
    }
?>