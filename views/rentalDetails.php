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
  <title>Rental Car | Rental Details</title>

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
  
  <link rel="stylesheet" href="../css/rentalDetails.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">
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
    

        //SELECT columns FROM table1 LEFT JOIN table2 ON table1.column = table2.column;


        //$sql = "SELECT * FROM `rentaldetails` where agency_id = '$userID'";
        //$sql = "SELECT * FROM `rentaldetails` LEFT JOIN `car` ON rentaldetails.car_id = car.id LEFT JOIN `user` ON rentaldetails.user_id = user.id WHERE rentaldetails.agency_id = '$userID'";

        $sql = "SELECT * FROM `rentaldetails`
        LEFT JOIN `car` ON rentaldetails.car_id = car.id
        LEFT JOIN `user` ON rentaldetails.user_id = user.id
        WHERE rentaldetails.agency_id = '$userID'
        ORDER BY rentaldetails.id DESC";

        $result = mysqli_query($conn,$sql);

        /*if ($result) {
            // Check if there are rows returned
            if (mysqli_num_rows($result) > 0) {
                // Fetch and display the data
                while ($row = mysqli_fetch_assoc($result)) {
                    print_r($row);
                    echo "<br>";
                }
            } else {
                echo "No results found.";
            }
        } else {
            // Display an error message if the query fails
            echo "Error: " . mysqli_error($conn);
        }*/
        
    
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

            <li style="margin: 5px;">
              <div class="featured-car-card">

                <div class="card-content">

                  <div class="card-title-wrapper">
                    <h3 class="h3 card-title">
                      <a href="#"><?php echo $row['model']; ?></a>
                    </h3>

                    <data class="year" value="2021"><?php echo $row['regNumber']; ?></data>
                  </div>

                  <ul class="card-list">

                    <li class="card-list-item">
                        <ion-icon name="person-outline"></ion-icon>

                        <span class="card-item-text"><?php echo $row['name']; ?></span>
                    </li>

                    <li class="card-list-item">
                        <ion-icon name="mail-outline"></ion-icon>

                        <span class="card-item-text"><?php echo $row['email']; ?></span>
                    </li>

                    <li class="card-list-item">
                        <ion-icon name="calendar-outline"></ion-icon>

                        <span class="card-item-text"><?php echo $row['numberOfDay']; ?> Days</span>
                    </li>

                    <li class="card-list-item">
                        <ion-icon name="today-outline"></ion-icon>

                        <span class="card-item-text"><?php echo $row['startDate']; ?> (Start Date)</span>
                    </li>

                  </ul>

                  <div class="card-price-wrapper">

                    <p class="card-price">
                      <strong>₹<?php echo ($row['numberOfDay'])*($row['rentPerDay']) ?></strong> (Total Payment)
                    </p>


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