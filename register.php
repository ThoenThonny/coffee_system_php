<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.register-card{
    width:400px;
    border-radius:15px;
}
</style>

</head>
<body>

<div class="card register-card shadow-lg">
<div class="card-body p-4">

<h3 class="text-center mb-4">Create Account</h3>

<form action="register.php" method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="user_name" class="form-control" placeholder="Enter username" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="user_email" class="form-control" placeholder="Enter email" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="user_password" class="form-control" placeholder="Enter password" required>
</div>


<button type="submit" class="btn btn-primary w-100">
Register
</button>

<div class="text-center mt-3">
Already have account? 
<a href="index.php">Login</a>
</div>

</form>

</div>
</div>

</body>
</html>