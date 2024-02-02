
<header class="header" data-header>
    
    <?php
    // Get the current URL path without the query string
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    //echo $currentPath;
    ?>

    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="#" class="logo">
        <img src="../image/logo.svg" alt="Ridex logo">
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <!--<li>
              <a href="home.php" class="navbar-link" style="<?php echo (strcasecmp($currentPath, '/Car Rental Agency/views/home.php') === 0) ? 'color: red;' : '' ?>" data-nav-link>Home</a>
          </li>-->

          <li>
              <a href="home.php" class="navbar-link " data-nav-link>Home</a>
          </li>

          <li>
            <a href="exploreCar.php" class="navbar-link" data-nav-link>Explore cars</a>
          </li>

          <li>
            <a href="#" class="navbar-link" data-nav-link>Add cars</a>
          </li>

        </ul>
      </nav>

      <div class="header-actions">

        <div class="header-contact">
          <!--<a href="tel:88002345678" class="contact-link">8 800 234 56 78</a>

          <span class="contact-time">Mon - Sat: 9:00 am - 6:00 pm</span>-->
        </div>

        <a href="exploreCar.php" class="btn" aria-labelledby="aria-label-txt">
          <ion-icon name="car-outline"></ion-icon>

          <span id="aria-label-txt">Explore cars</span>
        </a>

        <a href="#" class="btn user-btn" aria-label="Profile">
          <ion-icon name="person-outline"></ion-icon>
        </a>

        <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
          <span class="one"></span>
          <span class="two"></span>
          <span class="three"></span>
        </button>

      </div>

    </div>
  </header>