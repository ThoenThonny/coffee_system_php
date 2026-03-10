
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-card{
    width:380px;
    border-radius:15px;
}

</style>

</head>
<body>

<div class="card login-card shadow-lg">
<div class="card-body p-4">

<h3 class="text-center mb-4">Login Account</h3>

<form action="login.php" method="POST">

<div class="mb-3">
<label class="form-label">Email</label>
<input 
type="email" 
name="user_email" 
class="form-control" 
placeholder="Enter your email"
required
>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input 
type="password" 
name="user_password" 
class="form-control" 
placeholder="Enter your password"
required
>
</div>

<button class="btn btn-primary w-100">
Login
</button>

<div class="text-center mt-3">
Don't have an account?
<a href="register.php">Register</a>
</div>

</form>

</div>
</div>

</body>
</html>

