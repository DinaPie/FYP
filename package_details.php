<?php
    include 'db.php';
    $currentFile = 'package_details.php';

    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['alert'] = "Please login first";
        header("Location: index.php");
        exit();
    }
    
    // Check if alert session variable is set
    if (isset($_SESSION['alert'])) {
        echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
        unset($_SESSION['alert']); // Unset the session variable after displaying the alert
    }
    
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tourist - Travel Agency HTML Template</title>
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
        .wishlist-button {
            color: gray;
            cursor: pointer;
            transition: color 0.3s;
            background: none;
            border: none;
            font-size: 25px;
        }

        .wishlist-button.active {
            color: red;
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

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="homepage.php" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Shafi Travel</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="homepage.php" class="nav-item nav-link">Home</a>
                    <a href="package.php" class="nav-item nav-link active">Packages</a>
                    <a href="custom.php" class="nav-item nav-link">Custom Package</a>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                </div>
                <a href="profile.php" class="btn btn-primary py-2 px-4">Profile</a>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Package</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Packages</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page"><?php echo ($row['name']) ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Destination Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Package</h6>
                <h1 class="mb-5"><?php echo ($row['name']) ?></h1>
            </div>
            
            <!-- Wishlist Start -->
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.2s">
                <form id="wishlist-form" method="POST" action="insertWishlist.php">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                    <input type="hidden" name="packageID" value="<?php echo $row["packageID"]; ?>">
                    <input type="hidden" name="action" id="wishlist-action" value="add">
                    <button type="button" class="wishlist-button" id="wishlist-button"><i class="fa fa-heart"></i> Add to Wishlist</button>
                </form>
            </div><br>
            <script>
                // Check if the button was previously clicked and update its state accordingly
                window.addEventListener('DOMContentLoaded', function() {
                    var wishlistButton = document.getElementById('wishlist-button');
                    var wishlistAction = localStorage.getItem('wishlistAction');

                    if (wishlistAction === 'add') {
                        wishlistButton.classList.add('active');
                    }
                });

                document.querySelector('#wishlist-button').addEventListener('click', function() {
                    this.classList.toggle('active');

                    // Update the action based on the button state
                    var action = this.classList.contains('active') ? 'add' : 'remove';
                    document.getElementById('wishlist-action').value = action;
                            
                    // Save the action to localStorage
                    localStorage.setItem('wishlistAction', action);

                    // Submit the form
                    document.getElementById('wishlist-form').submit();
                });
            </script>
            <!-- Wishlist End -->

            <!-- Package Pictures -->
            <div class="lazy-load">
                <div class="row g-3">
                    <div class="col-lg-7 col-md-6">
                        <div class="row g-3">
                            <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                <a class="position-relative d-block overflow-hidden" href="">
                                    <img class="img-fluid" src="img/DaNang1.jpg" alt="">
                                    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Dragon Bridge</div>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                                <a class="position-relative d-block overflow-hidden" href="">
                                    <img class="img-fluid" src="img/DaNang.jpg" alt="">
                                    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Ba Na Hills</div>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                                <a class="position-relative d-block overflow-hidden" href="">
                                    <img class="img-fluid" src="img/DaNang3.jpg" alt="">
                                    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">APEC Park</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                        <a class="position-relative d-block h-100 overflow-hidden" href="">
                            <img class="img-fluid position-absolute w-100 h-100" src="img/DaNang2.jpg" alt="" style="object-fit: cover;">
                            <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">Chua Linh Ung</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Destination Start -->
    <!-- Placeholder for deferred JavaScript -->
    <script defer src="deferred.js"></script>

     <!-- Package Details Section Begin -->
     <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">Welcome to <span class="text-primary"><?php echo ($row['name']) ?></span></h1>
                    <h4 class="mb-4">RM<?php echo ($row['price']) ?><span>/person</span></h4>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i><?php echo ($row['duration']) ?> Days</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Private Tour</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Hotel</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Locations</p>  
                        </div>
                    </div>
                    
                    <p class="mb-4">Da Nang, Vietnam, is a captivating blend of natural beauty and cultural richness. From the pristine beaches of My Khe to the mystical Marble Mountains, the city offers a diverse range of experiences. The Dragon Bridge, modern infrastructure, and delicious local cuisine add to its allure. </p>
                    <p class="mb-4">A short drive takes you to the UNESCO-listed Hoi An Ancient Town. With friendly locals, captivating festivals, and historic landmarks, Da Nang provides a perfect balance of tradition and modernity, making it an inviting destination for all.</p>
                    <h4>Locations:</h4>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Ba Na Hills</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Hoi An</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Dragon Bridge</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Linh Ung Pagoda</p>  
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Chua Cau (Bridge Pagoda)</p>  
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>APEC Park</p>  
                        </div>
                    </div>
                    
                    <a class="btn btn-primary py-3 px-5 mt-2" href="booking1.php?packageID=<?php echo $row["packageID"]; ?>&from=<?php echo urlencode($currentFile); ?>">Book Now</a><br><br>

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
                </div>
            </div>
        </div>
    </div>
    <!-- Package Details Section End -->
        

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