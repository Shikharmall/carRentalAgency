<?php
  // Get the current URL path without the query string
  //$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  //echo $currentPath;

  include '../dbConnection/connection.php';

  $sql = "SELECT * FROM `user`";
  $result = mysqli_query($conn,$sql);

?>

<header class="header" data-header>
    

    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="home.php" class="logo" style="font-size: 20px; color: rgb(31, 31, 31);">
        Rental Car
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li>
              <a href="home.php" class="navbar-link " data-nav-link>Home</a>
          </li>

          <li>
            <a href="exploreCar.php" class="navbar-link" data-nav-link>Explore cars</a>
          </li>

          <?php
    
            if (isset($_COOKIE["LoggedIn"]) && isset($_COOKIE["isAdmin"])) {

              $isLoggedIn = $_COOKIE["LoggedIn"];
              $isAdmin = $_COOKIE["isAdmin"];
              
              if($isLoggedIn){
                if($isAdmin){

          ?>
                  <li>
                    <a href="addCar.php" class="navbar-link" data-nav-link>Add cars</a>
                  </li>

                  <li>
                    <a href="allCar.php" class="navbar-link" data-nav-link>All cars</a>
                  </li>

                  <li>
                    <a href="rentalDetails.php" class="navbar-link" data-nav-link>View booked cars</a>
                  </li>
            
          <?php
                }else{
          ?>
                  <li>
                    <a href="rentedCars.php" class="navbar-link" data-nav-link>Rended cars</a>
                  </li>
       
          <?php
              }
            }

            } 
          ?>


        </ul>
      </nav>

      <div class="header-actions">

        <div class="header-contact">
        </div>

        <a href="exploreCar.php" class="btn" aria-labelledby="aria-label-txt">
          <ion-icon name="car-outline"></ion-icon>

          <span id="aria-label-txt">Explore cars</span>
        </a>

        <a onclick="openProfileModal()" class="btn user-btn" aria-label="Profile" style="position: relative;">
          <ion-icon name="person-outline"></ion-icon>
        </a>
        <div id="profileModal" class="modal">

            <div class="modal-content">
              <h2>User Profile</h2>
              <!-- Add your user profile content here -->
              <?php

                if (!isset($_COOKIE["userID"])) {
              ?>

                <a href="login.php">User Login</a>
                <a href="agencyLogin.php">Agency Login</a>

              <?php
                }else{
              ?>

                <button onclick="deleteAllCookies()">Logout</button>
                
              <?php
                }

              ?>


            </div>

        </div>

        <!--<div class="dropdown-container" id="profileModal">
					<details class="dropdown left">
						<summary>
							<span class="with-down-arrow">Jane Doe</span>
						</summary>
						<ul>
							<li>
								<p>
									<span class="block bold">Jane Doe</span>
									<span class="block italic">jane@example.com</span>
								</p>
							</li>
							<li>
								<a href="#">
									<span class="material-symbols-outlined">account_circle</span> Account
								</a>
							</li>
							<li>
								<a href="#">
									<span class="material-symbols-outlined">settings</span> Settings
								</a>
							</li>
							<li>
								<a href="#">
									<span class="material-symbols-outlined">help</span> Help
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">
									<span class="material-symbols-outlined">logout</span> Logout
								</a>
							</li>
						</ul>
					</details>
				</div>-->



        <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

      </div>

    </div>
  </header>

    <script>
      function deleteAllCookies() {
          // Get all cookies
          var cookies = document.cookie.split(";");

          // Loop through each cookie and delete it
          for (var i = 0; i < cookies.length; i++) {
              var cookie = cookies[i];
              var eqPos = cookie.indexOf("=");
              var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
              document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
          }

          location.reload();
          header("location:home.php");
      }
    </script>