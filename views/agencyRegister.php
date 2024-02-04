<?php

   include '../dbConnection/connection.php';

  $showError = false;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $showError = false;
    $name = $_POST['name'];
    $address = $_POST['address'];
    $owner = $_POST['owner'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO agency(name, address, owner, email, password) VALUES ('$name','$address','$owner','$email','$hashedPassword')";

    $result = mysqli_query($conn,$sql);

    if($result){
        header("location:agencyLogin.php");
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
    <title>Rental Car | Agency Register Page</title>
    <link rel="icon" href="../image/logo.svg">
    <link rel="stylesheet" href="../css/agencyRegister.css">
</head>
<body>
    <div class="Form-box" style="margin: 5px;">
        <form class="Register-form" action="agencyRegister.php" method="POST">
            <h1>Agency Register</h1>
            <?php
                if($showError){
                  echo '<span style="color:red;"> Upload Failed! </span>';
                }
            ?>
            <div class="input-box">
                <input type="text" name="name" required>
                <label>Agency Name</label>
                <ion-icon name="business-outline"></ion-icon>
            </div>
            <div class="input-box">
                <input type="text" name="address" required>
                <label>Address</label>
                <ion-icon name="location-outline"></ion-icon>
            </div>
            <div class="input-box">
                <input type="text" name="owner" required>
                <label>Owner</label>
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
            <a href="agencyLogin.php">Register before ? Login</a>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>