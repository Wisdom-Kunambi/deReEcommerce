<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    // Initialize variables and escape input
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($email) && !empty($password)) {
        // Fetch the user from the database
        $select = "SELECT * FROM user_form WHERE email = '$email'";
        $result = mysqli_query($conn, $select);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Verify the password
            if (md5($password) == $row['password']) { // Note: Use password_verify() and password_hash() for better security
                if ($row['user_type'] == 'admin') {
                    $_SESSION['admin_name'] = $row['name'];
                    header('Location: adminPage.php');
                } elseif ($row['user_type'] == 'user') {
                    $_SESSION['user_name'] = $row['name'];
                    header('Location: userPage.php');
                } elseif ($row['user_type'] == 'driver') {
                    $_SESSION['driver_name'] = $row['name'];
                    header('Location: driverPage.php');
                }
                exit;
            } else {
                $error[] = 'Incorrect email or password!';
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'Please fill in all fields!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="src/style/style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
                if(isset($error)){
                    foreach($error as $errorMsg){
                        echo '<span class="error-msg">'.$errorMsg.'</span>';
                    }
                }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>
</body>
</html>
