<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../image/logo.svg">

  <title>Rental Car | Home</title>

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

  <link rel="stylesheet" href="../css/home.css">

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body>

  <?php
    include '../components/header.php';
  ?>

  <main>
    <article>
      <section class="section hero" id="home">
        <div class="container">

          <div class="hero-content">
            <h2 class="h1 hero-title">The easy way to book a rental car</h2>

            <p class="hero-text">
              Live in New Delhi,Mumbai or Anywhere in India!
            </p>
          </div>

          <div class="hero-banner"></div>

          <div class="hero-form">

            <div class="input-wrapper">
              <label for="input-1" class="input-label">Car, model, or brand</label>

              <input type="text" name="car-model" id="input-1" class="input-field"
                placeholder="Latest Modal Available !" disabled>
            </div>

            <div class="input-wrapper">
              <label for="input-2" class="input-label">Charges</label>

              <input type="text" name="monthly-pay" id="input-2" class="input-field" placeholder="Affordable Amount !" disabled>
            </div>

            <div class="input-wrapper">
              <label for="input-3" class="input-label">Services</label>

              <input type="text" name="year" id="input-3" class="input-field" placeholder="Fast Services" disabled>
            </div>

            <a href="exploreCar.php">
              <button class="btn">Explore Cars</button>
            </a>

    </div>

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