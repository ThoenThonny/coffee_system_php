<?php
    session_start();
    session_destroy();
    if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}
?>