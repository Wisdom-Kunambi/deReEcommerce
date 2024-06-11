<?php 
@include 'config.php';

session_start();

if(!isset($_SESSION['driver_name'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Driver Page</title>
    <link rel="stylesheet" href="src/style/style.css">
</head>
<body>

<div class="container">
    <div class="content">
        <h3>hi, <span>Driver</span></h3>
        <h1>welcome <span> <?php echo $_SESSION['driver_name'] ?> </span></h1>
        <p>this is an driver page</p>
        <a href="login.php" class="btn">login</a>
        <a href="register.php" class="btn">register</a>
        <a href="logout.php" class="btn">logout</a>
    </div>
</div>

</body>
</html>