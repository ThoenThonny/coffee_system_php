<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

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

<h3 class="text-center mb-4">Login</h3>

<div class="mb-3">
<label>Email</label>
<input type="email" id="email" class="form-control">
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" id="password" class="form-control">
</div>

<button onclick="Login()" class="btn btn-primary w-100">
Login
</button>

<div class="text-center mt-3">
i don't have account ?
<a href="register.php">Register</a>
</div>

</div>
</div>

</body>
<script>

function Login(){

let email = document.getElementById("email").value;
let password = document.getElementById("password").value;

fetch("auth/login.php",{
method:"POST",
headers:{
"Content-Type":"application/json"
},
body:JSON.stringify({
user_email:email,
user_password:password
})
})
.then(res=>res.json())
.then(data=>{

console.log(data);

if(data.status === "success"){

alert(data.message);

window.location="dashboad.php";

}else{

alert(data.message);

}

})
.catch(error=>{
console.log(error);
alert("Server Error");
});

}

</script>

</html>