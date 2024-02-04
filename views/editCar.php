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

    if(isset($_GET['carID'])) {
      $carID = $_GET['carID'];
      $sql = "SELECT * FROM `car` where id = '$carID'";
      $result = mysqli_query($conn,$sql);
      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
          $modell = $row['model'];
          $regNumberr = $row['regNumber'];
          $seatCapacityy = $row['seatCapacity'];
          $rentPerDayy = $row['rentPerDay'];
          $gearTypee = $row['gearType'];
          $mileagee= $row['mileage'];
          $maxSpeedd = $row['maxSpeed'];

        }
      }
    } else {
      echo "No id parameter provided in the URL.";
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){  
        
      $model = $_POST['model'];
      $regNumber = $_POST['regNumber'];
      $seatCapacity = $_POST['seatCapacity'];
      $rentPerDay = $_POST['rentPerDay'];
      $gearType = $_POST['gearType'];
      $maxSpeed = $_POST['maxSpeed'];
      $mileage = $_POST['mileage'];
      $carID = $_POST['car_id'];

      //$sql = "UPDATE car SET model = '$model', regNumber = '$regNumber', seatCapacity = '$seatCapacity', rentPerDay = '$rentPerDay', gearType = '$gearType', maxSpeed = '$maxSpeed', mileage = '$mileage' WHERE id = '$carID'";

      $sql = "UPDATE car SET regNumber = '$regNumber' WHERE id = '$carID'";

      $result = mysqli_query($conn,$sql);

      //UPDATE `car` SET `regNumber` = 'UP54-SP7896', `rentPerDay` = '2000' WHERE `car`.`id` = 7;

      if($result){
        //echo $regNumber;
       header("location:allCar.php");
       //echo "<script type ='text/javascript'> alert(".$regNumber.")</script>";
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
    <link rel="icon" href="../image/logo.svg">
    <title>Rental Car | Add Car</title>

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

    <link rel="stylesheet" href="../css/editCar.css">
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
                      <form class="Login-form" action="editCar.php" method="POST">
                        <div class="input-box" style="display: none;">
                            <input type="text" name="car_id" value="<?php echo $carID; ?>" required>
                            <label>Model</label>
                            <ion-icon name="car-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="text" name="model" value="<?php echo $modell; ?>" required>
                            <label>Model</label>
                            <ion-icon name="car-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="text" name="regNumber" value="<?php echo $regNumberr; ?>" required>
                            <label>Registration Number</label>
                            <ion-icon name="document-text-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="number" name="seatCapacity" value="<?php echo $seatCapacityy; ?>" required min="1">
                            <label>Seat Capacity</label>
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="text" name="rentPerDay" value="<?php echo $rentPerDayy; ?>" required>
                            <label>Rent Per Day</label>
                            <ion-icon name="card-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="text" name="gearType" value="<?php echo $gearTypee; ?>" required>
                            <label>Gear Type</label>
                            <ion-icon name="cog-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="number" name="maxSpeed" value="<?php echo $maxSpeedd; ?>" required min="0">
                            <label>Maximum Speed</label>
                            <ion-icon name="flash-outline"></ion-icon>
                        </div>
                        <div class="input-box">
                            <input type="number" name="mileage" value="<?php echo $mileagee; ?>" required min="0">
                            <label>Mileage</label>
                            <ion-icon name="speedometer-outline"></ion-icon>
                        </div>
                        <button type="submit" class="submit-btn">Update Details</button>
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

  <!-- ionicon link-->
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

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                input.style.display = 'none';
                previewHeading.style.display = 'none';
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
  
</body>

</html>