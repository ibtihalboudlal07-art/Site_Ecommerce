<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "config.php";
session_start();

$error = "";

if(isset($_POST['register'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // validation
    if(empty($name) || empty($email) || empty($password)){
        $error = "All fields are required";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email";
    }
    else if(strlen($password) < 6){
        $error = "Password must be at least 6 characters";
    }
    else{

        // check email exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if($check->rowCount() > 0){
            $error = "Email already exists";
        }
        else{

            // hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
            $sql->execute([$name, $email, $hash]);
            echo "registrer ok!!";
            // redirect to login
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>

<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#0A4174,#001D39);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
width:360px;
background:white;
padding:30px;
border-radius:18px;
text-align:center;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

h2{
color:#0A4174;
margin-bottom:20px;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ddd;
border-radius:10px;
outline:none;
}

input:focus{
border-color:#0A4174;
}

.btn{
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:#0A4174;
color:white;
cursor:pointer;
font-weight:bold;
}

.btn:hover{
background:#001D39;
}

.error{
color:red;
font-size:14px;
margin-bottom:10px;
}

a{
display:block;
margin-top:10px;
color:#0A4174;
text-decoration:none;
font-size:14px;
}

</style>
</head>

<body>

<div class="box">

<h2>Create Account</h2>

<?php if($error != ""): ?>
<div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" action="registrer.php">

<input type="text" name="name" placeholder="Full name" required>

<input type="text" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register" class="btn">
Register
</button>

</form>

<a href="login.php">Already have an account? Login</a>

</div>

</body>
</html>