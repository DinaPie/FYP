<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
?>
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

    <script>
        function login() {
            document.getElementById('login').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function signup() {
            document.getElementById('signup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function forgotPw() {
            document.getElementById('forgotPw').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopupLogin() {
            document.getElementById('login').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function closePopupSignup() {
            document.getElementById('signup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function closePopupForgotPw() {
            document.getElementById('forgotPw').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function submitSignup() {
            // Add your form submission logic here
            closePopup();
        }

        function submitForgotPw() {
            // Add your form submission logic here
            alert('Form submitted!');
            closePopup();
        }
    </script>
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
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Shafi Travel</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="package.php" class="nav-item nav-link">Packages</a>
                    <a href="custom.php" class="nav-item nav-link">Custom Package</a>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                    <a href="#" class="nav-item nav-link" onclick="signup()">Sign Up</a>
                </div>
                <button type="button" class="btn btn-primary rounded-pill py-2 px-4" onclick="login()">Log In</button>
            </div>
        </nav>



            <!--Log In Form-->
            <div class="overlay" id="overlay"></div>    

            <div class="popup" id="login">
            <span class="close-btn" onclick="closePopupLogin()">&times;</span>
            <h2>Log In</h2>

            Don't have an account? <a href="#" onclick="closePopupLogin(); signup();">Sign Up</a><br><br>

            <form action="authenticate.php" method="post">
                <input type="text" name="username" placeholder="Username" required>

                <input type="password" name="password" placeholder="Password" required>

                <label><a href="#" onclick="closePopupLogin(); forgotPw();">Forgot Password or Username?</a></label>
                
                <button type="submit" name="login" class="btn btn-primary rounded-pill py-2 px-4">Login</button>
            </form>
            </div>
            <!--Log In Form End-->

            <!--Forgot Password Form-->
            <div class="overlay" id="overlay"></div>    

            <div class="popup" id="forgotPw">
            <span class="close-btn" onclick="closePopupForgotPw()">&times;</span>
            <h2>Forgot Password or Username</h2>
            <form>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

                <button type="button" class="btn btn-primary rounded-pill py-2 px-4"  onclick="submitFormForgotPw()">Send</button>
            </form>
            </div>
            <!--Forgot Password Form End-->

            <!--Sign Up Form-->
            <div class="overlay" id="overlay"></div>

            <div class="popup" id="signup">
            <span class="close-btn" onclick="closePopupSignup()">&times;</span> 
            <h2>Sign Up</h2>

            Already registered? <a href="#" onclick="closePopupSignup(); login();">Login</a><br><br>
            
            <?php
                // Check if alert session variable is set
                if (isset($_SESSION['alert'])) {
                    echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
                    unset($_SESSION['alert']); // Unset the session variable after displaying the alert
                }
            ?>

                <form action="register.php" method="post">
                    <input type="text" name="username" placeholder="Username" required>

                    <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>

                    <input type="password" name="password" placeholder="Password" required>
                                
                    <button type="submit" name="sign" class="btn btn-primary rounded-pill py-2 px-4">Sign Up</button>
                </form>

            </div>
            <!--Sign Up Form End-->

            <?php
                // Check if signup was successful
                if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
                    echo '<script>login();</script>';
                }    
            ?>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Shafi Muslim Vietnam Tourism Agency</h1>
                        <p class="fs-4 text-white mb-4 animated slideInDown">Enjoy Your Vacation With Us</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/homepage.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary">Shafi Travel</span></h1>
                    <p class="mb-4">Shafi Muslim Vietnam Tourism Agency is a tourism agency in Vietnam. Our Agency are placed at Ho Chi Minh. We target the needs and preferences of Muslim travelers from Malaysia that want to travel to Vietnam.</p>
                    <p class="mb-4">Our business has been running since 2018. Our agency seeks to meet the cultural and religious needs of Muslim visitors by offering services and packages that adhere to Islamic standards.</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Private Tour</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

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