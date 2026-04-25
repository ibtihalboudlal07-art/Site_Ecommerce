،<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require __DIR__ . "/includes/connection.php";


if (isset($_SESSION['user']['id'])) {
    header("Location: ../index.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalid";
    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = [
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email']
            ];

            header("Location: ../index.php");
            exit;

        } else {
            $error = "Email ou mot de passe incorrect";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>

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
margin-bottom:10px;
font-size:14px;
}
</style>

</head>

<body>

<div class="box">

<h2>Connexion</h2>

<?php if($error != ""): ?>
<div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" action="login.php">

<input type="text" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Mot de passe" required>

<button type="submit" name="login" class="btn">
Se connecter
</button>

</form>

</div>

</body>
</html>