<?php

    include '../dbConnection/connection.php';

    if (!isset($_COOKIE["userID"])) {
      header("location:agencyLogin.php");
      exit;
    }

    if ($_COOKIE["isAdmin"] == 0) {
      header("location:home.php");
      exit;
    }

    
    if($_SERVER["REQUEST_METHOD"]=="POST"){  
        
        $model = $_POST['model'];
        $regNumber = $_POST['regNumber'];
        $seatCapacity = $_POST['seatCapacity'];
        $rentPerDay = $_POST['rentPerDay'];
        $gearType = $_POST['gearType'];
        $maxSpeed = $_POST['maxSpeed'];
        $mileage = $_POST['mileage'];
        if (isset($_COOKIE["userID"])) {
            $userID = $_COOKIE["userID"];
        }
  
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $folder   = '../uploadCarImages/'.$file_name;
        move_uploaded_file($file_tmp , $folder);
  
        $sql = "INSERT INTO car(model,regNumber,seatCapacity,rentPerDay,gearType,maxSpeed,mileage,image,agency_id) VALUES('$model','$regNumber','$seatCapacity','$rentPerDay','$gearType','$maxSpeed','$mileage','$file_name','$userID')";
  
        $result = mysqli_query($conn,$sql);
  
        if($result){
          header("location:addCar.php");
        }
        else{
          echo "<script type ='text/javascript'> alert('Upload failed.')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Car | Add Car</title>
    <link rel="icon" href="../image/logo.svg">

    <style>
      /* Style for the modal container */
      .modal {
          display: none;
          position: fixed;
          z-index: 1;
          top: 0;
          right: 0;
          /*top: 50px;
          width: 500px;*/
          width: 100%;
          height: 100%;
          overflow: auto;
          /*background-color: rgb(0,0,0);*/
          /*background-color: rgba(0,0,0,0.4);*/
          padding-top: 60px;
      }

      /* Style for the modal content */
      .modal-content {
          background-color: #fefefe;
          margin: 5% auto;
          position: absolute;
          top: -2%;
          right: 14%;
          width:  200px;
          border-radius: 5px;
      }

      .modal-content a{
        padding: 20px;
      }

      .modal-content a:hover{
        background-color: #f8f1e6;
        color: gray;
      }
      /* Style for the close button */
      .close {
          color: #aaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
      }
      .close:hover,
      .close:focus {
          color: black;
          text-decoration: none;
          cursor: pointer;
      }
    </style>

    <link rel="stylesheet" href="../css/addCar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
    
</head>

<body>

  <?php
    include '../components/header.php';
  ?>

  <br><br><br>

  <main>
    <article>

      <section class="section get-start">
        <div class="container">

          <ul class="get-start-list">

            <li>
                <div class="get-start-card">

                    <div class="Form-box">
                        <form class="Login-form" action="addCar.php" method="POST" enctype="multipart/form-data">
                            <div class="input-box">
                                <input type="text" name="model" required>
                                <label>Model</label>
                                <ion-icon name="car-outline"></ion-icon>
                            </div>
                            <div class="input-box">
                                <input type="text" name="regNumber" required>
                                <label>Registration Number</label>
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <div class="input-box">
                                <input type="number" name="seatCapacity" required min="1">
                                <label>Seat Capacity</label>
                                <ion-icon name="people-outline"></ion-icon>
                            </div>
                            <div class="input-box">
                                <input type="text" name="rentPerDay" required>
                                <label>Rent Per Day</label>
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <div class="input-box">
                                <input type="text" name="gearType" required>
                                <label>Gear Type</label>
                                <ion-icon name="cog-outline"></ion-icon>
                            </div>
                            <div class="input-box">
                                <input type="number" name="maxSpeed" required min="0">
                                <label>Maximum Speed</label>
                                <ion-icon name="flash-outline"></ion-icon>
                            </div>
                            <div class="input-box">
                                <input type="number" name="mileage" required min="0">
                                <label>Mileage</label>
                                <ion-icon name="speedometer-outline"></ion-icon>
                            </div>
                            <div class="input-box" id="dashedLine">
                                <label for="imageInput"> 
                                    <span id="previewHeading">
                                        <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 4a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5a1 1 0 0 1 1-1z" fill="#D3D3D3"/>
                                        </svg>
                                    </span> 
                                </label>
                                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage()" style="display:none;">
                                <img src="" alt="Image Preview" class="image-preview" id="imagePreview">
                            </div>
                            <button type="submit" class="submit-btn">Add Car</button>
                        </form>
                    </div>

                </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>


  <?php
    include '../components/footer.php';
  ?>

  <!-- ionicon link -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
  <!-- user details modal -->
  <script src="../js/openModal.js"></script>
  
  <!-- hamburger -->
  <script src="../js/hamburger.js"></script>
  
  <script>
    function previewImage() {
        var input = document.getElementById('imageInput');
        var preview = document.getElementById('imagePreview');
        var previewHeading = document.getElementById('previewHeading');
        var FormBox = document.getElementsByClassName('Form-box')[0];

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                input.style.display = 'none';
                previewHeading.style.display = 'none';
                preview.style.display = 'block';
                FormBox.style.height = "1300px";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>

</body>

</html>