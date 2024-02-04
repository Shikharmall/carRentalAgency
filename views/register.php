<?php

   include '../dbConnection/connection.php';

   if (isset($_COOKIE["userID"])) {
    header("location:home.php");
    exit;
   }
   
  $showError = false;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $showError = false;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO user(name, email, password) VALUES ('$name','$email','$hashedPassword')";

    $result = mysqli_query($conn,$sql);

    if($result){
        header("location:login.php");
    }
    else{
        //echo "<script type ='text/javascript'> alert('Upload failed.')</script>";
        $showError = true;
    }

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Car | Register Page</title>
    <link rel="icon" href="../image/logo.svg">
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <div class="Form-box" style="margin: 5px;">
        <form class="Register-form" action="register.php" method="POST">
            <h1>Register</h1>
            <?php
                if($showError){
                  echo '<span style="color:red;"> Upload Failed! </span>';
                }
            ?>
            <div class="input-box">
                <input type="text" name="name" required>
                <label>Username</label>
                <ion-icon name="person-outline"></ion-icon>
            </div>
            <div class="input-box">
                <input type="text" name="email" required>
                <label>Email</label>
                <ion-icon name="mail-outline"></ion-icon>
            </div>
            <div class="input-box">
                <input type="password" name="password" required>
                <label>Password</label>
                <ion-icon name="lock-closed-outline"></ion-icon>
            </div>
            <button type="submit" class="submit-btn">Register</button>
            <a href="login.php">Register before ? Login</a>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>