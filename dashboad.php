<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    display:flex;
    min-height:100vh;
    margin:0;
    font-family: Arial, sans-serif;
}

.sidebar{
    width:250px;
    background:#4e3520;
    color:white;
    padding:20px;
}

.sidebar h4{
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px;
    border-radius:6px;
    margin-bottom:5px;
    transition: 0.2s;
    cursor: pointer;
    transition: 0.3s all;
}

.sidebar a:hover{
    background-color: #b37a4c9a;
    transition: 0.3s all;
}

.sidebar a.active{
    background:brown; 
    color:white;
}

.content{
    flex:1;
    padding:30px;
    background:#f5f5f5;
}

.card{
    margin-top:20px;
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>☕ Coffe System</h4>
    <a  data-page="pages/home_page.php" class="menu active">Dashboard</a>
    <?php if($_SESSION['user_role'] == 'admin'): ?>
    <a data-page="pages/manage_product.php" class="menu">Manage Product</a>
    <a data-page="pages/add_page.php" class="menu">Add Product</a>
    <?php endif; ?>
    <a  data-page="pages/view_product.php" class="menu">View All Product</a>
    <a  data-page="pages/order_page.php" class="menu">Orders</a>
    <a href="logout.php" class="text-danger">Logout</a>
</div>

<!-- Content -->
<div class="content">
    <div id="content_page_area">
        
    </div>
</div>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
  
    function loadPage(page) {
        $("#content_page_area").load(page);
    }

    // Initially load the dashboard/home page
    loadPage("pages/home_page.php");

    // Sidebar link click
    $(".menu").click(function(e) {
        e.preventDefault();

        // Remove active class from all links
        $(".menu").removeClass("active");

        // Add active class to clicked link
        $(this).addClass("active");

        // Get the PHP page to load
        const page = $(this).data("page");

    
        loadPage(page);
    });
});
</script>