<?php
    include 'db.php';

    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['alert'] = "Please login first";
        header("Location: index.php");
        exit();
    }

    if (!isset($_SESSION['bookingID'])) {
      // Redirect to an error page or handle the situation appropriately
      header("location: error.php");
      exit();
    }
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
  <?php
      $bookingID = $_SESSION['bookingID'];

      $sql = "SELECT * FROM booking INNER JOIN packages ON booking.package = packages.packageID WHERE booking.bookingID = ?";

      if($stmt = mysqli_prepare($conn, $sql)) {
          // Set parameters
          $param_bookingID = $bookingID;

          // Bind variables to the prepared statement
          mysqli_stmt_bind_param($stmt, "i", $param_bookingID);

          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)) {
              $result = mysqli_stmt_get_result($stmt);

              if(mysqli_num_rows($result) == 1) {
                  /* Fetch result row as an associative array. */
                  if($row = mysqli_fetch_assoc($result)) {
                      // Retrieve individual field value
                      $name = $row["name"];
                      $duration = $row["duration"];
                      $quantity = $row["quantity"];
                      $startDate = $row["startDate"];
                      $endDate = $row["endDate"];
                      $totPrice = $row["totPrice"];
  ?>
  <div class="form-container">
      <!-- Step 3: Payment -->  
        <h2 class="fs-2 text-black mb-4 animated slideInDown">Step 3: Payment</h2><br>

        <h3 class="fs-3 text-black mb-4 animated slideInDown">Booking Information</h3>
        <table>
            <tr>
              <td class="fs-6 text-black mb-4">Name</td>
              <td class="fs-6 text-black mb-4"><span><?php echo $row["name"]; ?></span> Package</td>
            </tr>
            <tr>
              <td class="fs-6 text-black mb-4">Quantity</td>
              <td class="fs-6 text-black mb-4"><span><?php echo $row["quantity"]; ?></span> People</td>
            </tr>
            <tr>
              <td class="fs-6 text-black mb-4">Duration</td>
              <td class="fs-6 text-black mb-4"><span><?php echo $row["duration"]; ?></span> Days</td>
            </tr>
            <tr>
              <td class="fs-6 text-black mb-4">Date</td>
              <td class="fs-6 text-black mb-4"><span><?php echo $row["startDate"]; ?></span> - <span><?php echo $row["endDate"]; ?></span></td>
            </tr>
            <tr>
              <td class="fs-6 text-black mb-4">Total Price:</td>
              <td class="fs-6 text-black mb-4">RM <span><?php echo $row["totPrice"]; ?></span></td>
            </tr>
        </table><br>

        <h4 class="fs-4 text-black mb-4">Billing Details</h4>
    <form action="generatePayment.php" method="post">

      <label for="fullName">Full Name:</label><br>
      <input type="text" id="fullName" name="fullName" required><br><br>

      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email" required><br><br>
      
      <label for="phone">Phone:</label><br>
      <input type="tel" id="phone" name="phone" required><br><br>

      <input type="hidden" id="totPrice" name="totPrice" value="<?php echo $row["totPrice"]; ?>">
      
      <div class="button-container">
        <button class="btn btn-secondary py-2 px-3 mt-2" id="back">Previous</button>
        <button type="submit" class="btn btn-primary py-2 px-4 mt-2">Proceed to Payment</button>
      </div>
    </form>
  </div>
  <?php
                    }
                  } else {
                      header("location: error.php");
                      exit();
                  }
        
              } else {
                  echo "Oops! Something went wrong. Please try again later.";
              }
          }
          // Close statement
          mysqli_stmt_close($stmt);
        // Close connection
        mysqli_close($conn);
  ?>
<script>
  //confirmation exit booking
  const backButton = document.getElementById('back');

        // Add a click event listener to the button
        backButton.addEventListener('click', function(event) {
            // Show a confirmation dialog
            const userConfirmed = confirm('Are you sure you want to go back?\nYour data will not be saved.');

            // If the user clicks "Cancel", prevent the deletion
            if (!userConfirmed) {
                event.preventDefault();
            } else {
                window.location.href = 'booking2.php';
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
