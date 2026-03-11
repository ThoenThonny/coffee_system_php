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
}

.sidebar{
width:250px;
background:#212529;
color:white;
padding:20px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:10px;
border-radius:6px;
margin-bottom:5px;
}

.sidebar a:hover{
background:#343a40;
}

.content{
flex:1;
padding:30px;
background:#f5f5f5;
}

</style>

</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

<h4 class="mb-4">Admin Panel</h4>

<a href="#">Dashboard</a>

<a href="#">Add Product</a>

<a href="#">Manage Products</a>

<a href="#">Orders</a>

<a href="logout.php" class="text-danger">Logout</a>

</div>

<!-- Content -->
<div class="content">

<h2>Welcome To Dashboard</h2>

<p>Manage your coffee products here.</p>

<!-- Example Product Table -->

<div class="card mt-4">
<div class="card-header">
Product List
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<tr>
<td>1</td>
<td>Latte</td>
<td>$2.50</td>

<td>

<button class="btn btn-warning btn-sm">Update</button>

<button class="btn btn-danger btn-sm">Delete</button>

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>