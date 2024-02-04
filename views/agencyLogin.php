<?php

  include '../dbConnection/connection.php';

  $login = false;
  $showError = false;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $showError = true;
    $email = $_POST['email'];
    $password  = $_POST['password'];
 
    $sql = "Select * from agency where email = '$email'";
 
    $result = mysqli_query($conn,$sql);
    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $storedHashedPassword = $row['password'];
  
      if (password_verify($password, $storedHashedPassword)) {
        $name = "LoggedIn";
        $login = true;
        $expiration_time = time() + (3600*24);

        $name1 = "isAdmin";
        $admin = true;

        $name2 = "userID";
        $userid = $row['id'];

        setcookie($name, $login ? 1 : 0, $expiration_time, "/");
        setcookie($name1, $admin ? 1 : 0, $expiration_time, "/");
        setcookie($name2, $userid, $expiration_time, "/");
        header("location:home.php");

      } else {
        $showError = true;
      }
    } else {
      $showError = true;
    }
     
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Car | Agency Login Page</title>
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="Form-box">


        <form class="Login-form" action="agencyLogin.php" method="POST">
            <h1>Agency Login</h1>
            <?php
                if($showError){
                  echo '<span style="color:red;"> Invalid Credentials </span>';
                }
            ?>
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
            <button type="submit" class="submit-btn">Login</button>
            <div> Don't have an account ? <a href="agencyRegister.php" style="text-decoration: underline;">Register</a> </div> 
            <a href="home.php" style="text-decoration: underline;">Home</a>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>