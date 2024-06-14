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
    <title>Shafi Travel</title>
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
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Shafi Travel</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="homepage.php" class="nav-item nav-link">Home</a>
                    <a href="my_booking.php" class="nav-item nav-link">My Booking</a>
                    <a href="past_booking.php" class="nav-item nav-link active">Past Booking</a>
                    <a href="wishlist.php" class="nav-item nav-link">Wishlists</a>
                </div>
                <a href="profile.php" class="btn btn-primary py-2 px-4">Profile</a>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Past Booking</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Past Booking Start-->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Past Booking</h6><br>
                <h1 class="mb-5"></h1>
                <p>- - None - -</p>
            </div>
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
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" <?php echo '<img src="data:pic/jpg;base64,'.base64_encode($row['pic']).'"/';?>>
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i><?php echo $row["duration"]; ?> Days</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i><?php echo $row["quantity"]; ?> People</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0"><?php echo $row["name"]; ?></h3>
                            <p><?php echo $row["startDate"]; ?> - <?php echo $row["endDate"]; ?></p>
                            <p>Total paid: <?php echo $row["totPrice"]; ?></p>
                            
                            <div class="d-flex justify-content-center mb-2">
                                <a href="#" class="btn btn-sm btn-primary px-3 border-end" >Leave a review</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <!-- Past Booking  End-->

    


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Shafi Travel</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


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