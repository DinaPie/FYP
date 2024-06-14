<?php
    include 'db.php';

    $previousFile =  $_GET['from'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Booking</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      text-align: center;
    }

    .form-container {
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: left;
    }

    .form-step {
      display: none;
    }

    .form-step.active {
      display: block;
    }

    input {
      height:20px;
    }

    #fullName {
      width:50%;
    }

    #address {
      width:50%;
      height:auto;
    }

    .button-container {
      margin-top: 20px;
    }

    .button.next {
      background-color: #4caf50;
      color: white;
    }

    .button.next:hover {
      background-color: #45a049;
    }

    header {
      background-color: #333;
      color: white;
      padding: 15px 20px;
      text-align: center;
    }

    nav a {
      float: left;
      display: block;
      
      background-color: #555;
      color: black;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    nav a:hover {
      background-color: #4caf50;
    }

    nav a.active {
      background-color: #4caf50;
      color: white;
    }

    table{ 
      border-collapse: collapse;
      width: 50%;
    }

    td{
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->

  <!-- Booking Start -->
  <?php
    // Check if 'packageID' is set in URL
    if(isset($_GET['packageID'])) {
      $packageID = $_GET['packageID'];

      // Prepare a select statement
      $sql = "SELECT * FROM packages WHERE packageID = ?";

      if($stmt = mysqli_prepare($conn, $sql)) {
          // Set parameters
          $param_packageID = $packageID;

          // Bind variables to the prepared statement
          mysqli_stmt_bind_param($stmt, "s", $param_packageID);

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)) {
              $result = mysqli_stmt_get_result($stmt);

              if(mysqli_num_rows($result) == 1) {
                  /* Fetch result row as an associative array. */
                  if($row = mysqli_fetch_assoc($result)) {
                      // Retrieve individual field value
                      $name = $row["name"];
                      $price = $row["price"];
                      $duration = $row["duration"];
  ?>

  <div class="form-container">
    <form action="booking_details.php" method="post">
      <!-- Select Option -->
      <div class="form-step active" id="step1">
        <h2>Step 1: Select Option</h2><br>

        <table>
          <h3>Package Information</h3>
            <tr>
              <td>Name</td>
              <td><span><?php echo $row["name"]; ?></span> Package</td>
            </tr>
            <tr>
              <td>Price</td>
              <td>RM<span><?php echo $row["price"]; ?></span></td>
            </tr>
            <tr>
              <td>Duration</td>
              <td><span><?php echo $row["duration"]; ?></span> Days</td>
            </tr>
        </table><br>
        
        <?php
                    }
                  } else {
                      // URL doesn't contain valid matric. Redirect or error message
                      header("location: error.php");
                      exit();
                  }
        
              } else {
                  echo "Oops! Something went wrong. Please try again later.";
              }
          }
        
          // Close statement
          mysqli_stmt_close($stmt);
        } else {
          // URL doesn't contain matric. Redirect or error message
          header("location: error.php");
          exit();
        }
        // Close connection
        mysqli_close($conn);
      ?>

        <h4>Package Options</h4>

          <label for="quantity">Quantity:</label><br><br>
          <label for="adult">Adult:</label>
          <input type="number" id="adult" name="adult" min="1" max="45" value="0" required>&nbsp&nbsp&nbsp&nbsp

          <label for="child">Child (1-12 y/o):</label>
          <input type="number" id="child" name="child" min="0" max="43" value="0">&nbsp&nbsp&nbsp&nbsp

          <label for="infant">Infant:</label>
          <input type="number" id="infant" name="infant" min="0" max="30" value="0">

          <div class="button-container">
            <button id="back" class="btn btn-secondary py-2 px-4 mt-2">Go Back</button>
            <button class="btn btn-primary py-2 px-4 mt-2" onclick="nextStep()">Next</button>
          </div>
      </div>

      <!-- Step 2: Enter Information -->
      <div class="form-step" id="step2">
        <h2>Step 2: Enter Information</h2>
        <h4>Participants Details</h4>

        <nav>
          <a href="#" class="active">1</a>
        </nav><br><br><br><br>
        
        <script>
          function setActive(element) {
            // Remove 'active' class from all links
            const links = document.querySelectorAll('nav a');
            links.forEach(link => link.classList.remove('active'));
        
            // Add 'active' class to the clicked link
            element.classList.add('active');
          }
        </script>
          <label for="fullName">Full Name:</label><br>
          <input type="text" id="fullName" name="fullName" required><br><br>
      
          <label for="gender">Gender:</label>
          <br>&nbsp&nbsp&nbsp&nbsp
            <input type="radio" id="gender" name="gender" value="male">
            <label for="male">Male</label><br>
            
            <br>&nbsp&nbsp&nbsp&nbsp
            <input type="radio" id="gender" name="gender" value="female">
            <label for="female">Female</label><br><br>
      
          <label for="ic">IC Number (w/o -):</label><br>
          <input type="text" id="ic" name="ic" required><br><br>
      
          <label for="passport">Passport Number:</label><br>
          <input type="text" id="passport" name="passport" required><br><br>
      
          <label for="address">Address:</label><br>
          <textarea id="address" name="address" required></textarea><br><br>
      
          <label for="email">Email:</label><br>
          <input type="email" id="email" name="email" required><br><br>
      
          <label for="phone">Phone:</label><br>
          <input type="tel" id="phone" name="phone" required><br><br>

        <div class="button-container">

          <button class="btn btn-secondary py-2 px-3 mt-2" onclick="prevStep()">Previous</button>
          <button class="btn btn-primary py-2 px-4 mt-2" onclick="nextStep()">Next</button>
        </div>
      </div>

      <!-- Step 3: Payment -->  
      <div class="form-step" id="step3">
        <h2>Step 3: Payment</h2>
        <label for="payment">Payment Method:</label>

        <br>&nbsp&nbsp&nbsp&nbsp
          <input type="radio" id="transfer" name="transfer" value="transfer">
          <label for="transfer">Online Transfer</label>
        
        <br>&nbsp&nbsp
          <input type="radio" id="qr" name="qr" value="qr">
          <label for="qr">QR Payment</label><br>

        <div class="button-container">
          <button class="btn btn-secondary py-2 px-3 mt-2" onclick="prevStep()">Previous</button>
          <button type="submit" class="btn btn-primary py-2 px-4 mt-2">Submit</button>
        </div>
      </div>
    </form>
  </div>
  <!-- Booking Start -->

<script>
  let currentStep = 1;
  const formSteps = document.querySelectorAll('.form-step');

  function updateForm() {
    formSteps.forEach((step, index) => {
      if (index + 1 === currentStep) {
        step.classList.add('active');
      } else {
        step.classList.remove('active');
      }
    });
  }

  function nextStep() {
    if (currentStep < formSteps.length) {
      currentStep++;
      updateForm();
    }
  }

  function prevStep() {
    if (currentStep > 1) {
      currentStep--;
      updateForm();
    }
  }

  const backButton = document.getElementById('back');

        // Add a click event listener to the button
        backButton.addEventListener('click', function(event) {
            // Show a confirmation dialog
            const userConfirmed = confirm('Are you sure you want to go back?\nYour data will not be saved.');

            // If the user clicks "Cancel", prevent the deletion
            if (!userConfirmed) {
                event.preventDefault();
            } else {
                var previousFile = "<?php echo htmlspecialchars($previousFile); ?>";
                window.location.href = previousFile;
            }
        });
</script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

</body>
</html>
