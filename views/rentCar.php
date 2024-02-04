<?php

    include '../dbConnection/connection.php';

    if (!isset($_COOKIE["userID"])) {
      header("location:login.php");
      exit;
    }

    if ($_COOKIE["isAdmin"] == 1) {
      header("location:home.php");
      exit;
    }

    
    if($_SERVER["REQUEST_METHOD"]=="POST"){  
        
        $numberOfDay = $_POST['numberOfDay'];
        $startdate = $_POST['startdate'];
        $agency_id = $_POST['agency_id'];
        $carID = $_POST['car_id'];
        $userID = $_COOKIE["userID"];
        
  
        $sql = "INSERT INTO rentaldetails(user_id,agency_id,numberOfDay,startDate,car_id) VALUES('$userID','$agency_id','$numberOfDay','$startdate','$carID')";
  
        $result = mysqli_query($conn,$sql);
  
        if($result){
          header("location:rentedCars.php");
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
  <title>Rental Car | Rent Car</title>

    <style>
        /* Style for the modal container */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        /* Style for the modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
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

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../css/rentCar.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
    rel="stylesheet">
</head>

<body>

    <?php
      include '../components/header.php';
    ?>

    <br><br><br>
  
    <?php

      include '../dbConnection/connection.php';

      if(isset($_GET['carID'])) {
        $carID = $_GET['carID'];
        $sql = "SELECT * FROM `car` LEFT JOIN `agency` ON car.agency_id = agency.id WHERE car.id = '$carID'";
        $result = mysqli_query($conn,$sql);
      } else {
        echo "No id parameter provided in the URL.";
      }
    
    ?>

  <main>
    <article>

      <!-- 
        - #FEATURED CAR
      -->

      <section class="section featured-car" id="featured-car">
        <div class="container">

          <ul class="featured-car-list">

            <?php

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    
            ?>

            <li>
              <div class="featured-car-card">

                <figure class="card-banner">
                  <img src="../uploadCarImages/<?php echo $row['image']; ?>" alt="Toyota RAV4 2021" loading="lazy" width="440" height="300"
                    class="w-100">
                </figure>

                <div class="card-content">

                  <div class="card-title-wrapper">
                    <h3 class="h3 card-title">
                      <a><?php echo $row['model']; ?> (<?php echo $row['name']; ?>)</a>
                    </h3>

                    <data class="year" ><?php echo $row['regNumber']; ?></data>
                  </div>

                  <ul class="card-list">

                    <li class="card-list-item">
                      <ion-icon name="people-outline"></ion-icon>

                      <span class="card-item-text"><?php echo $row['seatCapacity']; ?> People</span>
                    </li>

                    <li class="card-list-item">
                      <ion-icon name="flash-outline"></ion-icon>

                      <span class="card-item-text"><?php echo $row['maxSpeed']; ?>km / hr</span>
                    </li>

                    <li class="card-list-item">
                      <ion-icon name="speedometer-outline"></ion-icon>

                      <span class="card-item-text"><?php echo $row['mileage']; ?>km / 1-litre</span>
                    </li>

                    <li class="card-list-item">
                      <ion-icon name="hardware-chip-outline"></ion-icon>

                      <span class="card-item-text"><?php echo $row['gearType']; ?></span>
                    </li>

                  </ul>

                  <form action="rentCar.php" method="POST">

                  <div class="card-price-wrapper">

                    <p class="card-price" style="display:flex; align-items: center;">
                      <strong style="display:flex;"> ₹<span id='calculateRent'><?php echo $row['rentPerDay']; ?></span> </strong> (<span id='totaldays'>1</span>days)
                    </p>

                    <p class="card-price" style="display:none;">
                      <input type="text" id="agency_id" name="agency_id" value="<?php echo $row['agency_id']; ?>">
                      <input type="text" id="car_id" name="car_id" value="<?php echo $_GET['carID']; ?>">
                    </p>

                    <p class="card-price">
                      <input type="date" id="startdate" name="startdate">
                    </p>

                    <p class="card-price">

                      <select name="numberOfDay" id="numberOfDay" onchange="getTotalRent(<?php echo $row['rentPerDay']; ?>)">
                        <option disabled>Number of Days</option>
                        <?php
                          // Define the maximum number of days you want to display
                          $maxDays = 30;
                  
                          // Generate options dynamically
                          for ($i = 1; $i <= $maxDays; $i++) {
                              echo "<option value='$i'>$i</option>";
                          }
                        ?>
                      </select>
                    </p>

                    <button  type="submit" class="btn">Rent</button>

                  </div>

                  </form>

                </div>

              </div>
            </li>

            <?php
                }
                
                } else {
                    echo "No results found.";
                }
            ?>

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
    function getTotalRent(rentPerDay) {
      
      var numberOfDaysSelect = document.getElementById("numberOfDay");
      var calculateRent = document.getElementById("calculateRent");
      var totaldays = document.getElementById("totaldays");
      var selectedNumberOfDays = parseInt(numberOfDaysSelect.value);
      var totalRent = rentPerDay * selectedNumberOfDays;
      calculateRent.innerHTML = totalRent;
      totaldays.innerHTML = selectedNumberOfDays;
      
    }
  </script>

</body>

</html>