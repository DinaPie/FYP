<?php
    include 'db.php';

    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['alert'] = "Please login first";
        header("Location: index.php");
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

    /* Style The Dropdown Button */
    .dropbtn {
      background-color: #4CAF50;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
      color: black;
      padding: 8px 16px;
      font-size: 12px;
      text-decoration: none;
      display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #f1f1f1}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
      display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
      background-color: #3e8e41;
    }

    .hidden { display: none; }
        .dropbtn { cursor: pointer; }
        .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; }
        .dropdown-content a { color: black; padding: 12px 16px; text-decoration: none; display: block; }
        .dropdown-content a:hover { background-color: #f1f1f1; }
        .dropdown:hover .dropdown-content { display: block; }
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
   <!-- Step 2: Enter Information -->
    <div class="form-container">
        <form action="booking3.php" method="post">
            <h2 class="fs-2 text-black mb-4 animated slideInDown">Step 2: Enter Information</h2>
            <h3 class="fs-3 text-black mb-4 animated slideInDown">Participants Details</h3>
            <div class="dropdown">
                <button class="dropbtn">Participants</button>
                <div class="dropdown-content">
                <?php
                    // Check if $quantity is defined before the loop
                    if (isset($quantity)) {
                        for ($i = 1; $i <= $quantity; $i++) {
                          echo '<a href="#" onclick="handleParticipantSwitch(' . ($i - 1) . ')">Participant ' . $i . '</a>';
                        }
                    }
                  ?>
                </div>
            </div>
          <br><br>
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
          <button id="back" class="btn btn-secondary py-2 px-3 mt-2">Previous</button>
          <button type="submit" class="btn btn-primary py-2 px-4 mt-2">Next</button>
        </div>
      </div>
      </form>

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
                window.location.href = 'booking1.php';
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
