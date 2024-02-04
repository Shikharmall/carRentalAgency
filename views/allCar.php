<?php

  if (!isset($_COOKIE["userID"])) {
    header("location:agencyLogin.php");
    exit;
  }

  if ($_COOKIE["isAdmin"] == 0) {
    header("location:home.php");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../image/logo.svg">
  <title>Rental Car | All Cars</title>

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
    <link rel="stylesheet" href="../css/exploreCar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"rel="stylesheet">
</head>

<body>

    <?php
      include '../components/header.php';
    ?>

    <br><br><br>
  
    <?php

      include '../dbConnection/connection.php';

      if (isset($_COOKIE["userID"])) {
        $userID = $_COOKIE["userID"];
      }
    
      $sql = "SELECT * FROM `car` where agency_id = '$userID'";
      $result = mysqli_query($conn,$sql);
    
    ?>

  <main>
    <article>

      <!-- 
        - #FEATURED CAR
      -->

      <section class="section featured-car" id="featured-car">
        <div class="container">

          <!--<div class="title-wrapper">

            <a href="#" class="featured-car-link">
              <span>View more</span>

              <ion-icon name="arrow-forward-outline"></ion-icon>
            </a>
          </div>-->

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
                      <a href="#"><?php echo $row['model']; ?></a>
                    </h3>

                    <data class="year" value="2021"><?php echo $row['regNumber']; ?></data>
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

                  <div class="card-price-wrapper">

                    <p class="card-price">
                      <strong>₹<?php echo $row['rentPerDay']; ?></strong> / day
                    </p>

                    <!--<button class="btn fav-btn" aria-label="Add to favourite list">
                      <ion-icon name="heart-outline"></ion-icon>
                    </button>-->

                    <a href="editCar.php?carID=<?php echo $row['id']; ?>">
                      <button class="btn">
                        Edit
                      </button>
                    </a>

                  </div>

                </div>

              </div>
            </li>

            <?php
                }
                
                } else {
                  
            ?>
                <center>

                  <br><br><br><br><br> <br>

                  <img
                    width= "100"
                    height="100"
                    src="https://img.icons8.com/pastel-glyph/64/no-document--v1.png"
                    alt="no-document--v1"
                  />

                  <h1>No results found.</h1>

                  <br><br><br><br><br> 

                </center>
            <?php
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

  <!-- ionicon link -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
   
  <!-- user details modal -->
  <script src="../js/openModal.js"></script>
  
  <!-- hamburger -->
  <script src="../js/hamburger.js"></script>

</body>

</html>