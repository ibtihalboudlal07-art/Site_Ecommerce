<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

$user = $_SESSION['user'];
?>

<h2>Welcome <?php echo $user['name']; ?></h2>

<img src="<?php echo $user['picture']; ?>" width="80">

<p><?php echo $user['email']; ?></p>

<br>

<a href="logout.php">Logout</a>