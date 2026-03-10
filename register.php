<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

.card{
width:400px;
border-radius:15px;
}
</style>

</head>
<body>

<div class="card shadow-lg">
<div class="card-body p-4">

<h3 class="text-center mb-4">Register</h3>

<div class="mb-3">
<label>Username</label>
<input type="text" id="name" class="form-control">
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" id="email" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" id="password" class="form-control">
</div>

<button onclick="Register()" class="btn btn-primary w-100">
Register
</button>

<div class="text-center mt-3">
Already have account ?
<a href="index.php">Login</a>
</div>

</div>
</div>

</body>

<script>

function Register(){

let name = document.getElementById("name").value;
let email = document.getElementById("email").value;
let password = document.getElementById("password").value;

fetch("auth/register.php",{
method:"POST",
headers:{
"Content-Type":"application/json"
},
body:JSON.stringify({
user_name:name,
user_email:email,
user_password:password
})
})
.then(res=>res.json())
.then(data=>{

console.log(data);

if(data.status === "success"){
alert("Register Success");
window.location="index.php";
}else{
alert("Register Failed");
}

});

}

</script>

</html>