<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Custom Package</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <style>
        .custom table{ 
            border: 1px solid #43910f40;
        }
        td {
            border-bottom: 1px solid #43910f40;
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
                    <a href="homepage.php" class="nav-item nav-link active">Home</a>
                    <a href="package.php" class="nav-item nav-link">Packages</a>
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
                        <h1 class="display-3 text-white animated slideInDown">Custom Your Own Package</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item text-white active" aria-current="page">Custom Package</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Custom Package Start -->
    <div class="container-xxl py-13">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Custom Package</h6>
                <h1 class="mb-5">3 Easy Steps</h1>
            </div>
            <div class="row gy-5 gx-4 justify-content-center">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-user-friends fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Pick Your Crew</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Assemble your crew! Slide the bar to choose the size of your traveling crew. Remember, venturing solo is an epic adventure too!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-umbrella-beach fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Choose Your Vacation Style</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Shopping sprees, exploring local culture, soaking up scenic beauty, or diving into fun activities. You can pick just one type or combine them.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fas fa-map fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Select Your Ideal Location</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Each interest area provides various locations. Only choose locations within the chosen interest area. You can pick one or more locations.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <form action="insertCustom.php" method="POST">
        <!-- Patricipant -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="custom p-5">
                    <div class="row g-5 align-items-center">
                        <h1 class="text-black mb-4">Pick Your Crew</h1>
                                <div class="slidecontainer">
                                    <input type="range" min="1" max="45" value="1" class="slider" id="myRange">
                                    <div class="slider-value" id="sliderValue">1</div>
                                </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vacation Purpose -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="custom p-5">
                    <div class="row g-5 align-items-center">
                        <label for="purpose"></label>
                        <h1 class="text-black mb-4">Choose Your Vacation Style</h1>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="local" name="purpose[]" value="local">
                                            <label for="local">
                                                <i class="fas fa-landmark fa-2x text-black"></i> Local Insights
                                            </label> 
                                        </td>
                                        <td>
                                            <input type="checkbox" id="shopping" name="purpose[]" value="shopping">
                                            <label for="shopping">
                                                <i class="fa fa-shopping-bag fa-2x text-black"></i> Shopping
                                            </label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="scenary" name="purpose[]" value="scenary">
                                            <label for="scenary">
                                                <i class="fa fa-tree fa-2x text-black"></i> Scenary
                                            </label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="fun" name="purpose[]" value="fun">
                                            <label for="fun">
                                                <i class="fa fa-running fa-2x text-black"></i> Fun Activities
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="custom p-5">
                    <div class="row g-5 align-items-center">
                        <label for="location"></label>
                        <h1 class="text-black mb-4">Select Your Ideal Location</h1>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="AH" name="location[]" value="AH">
                                            <label for="AH">Ho Chi Minh</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="AD" name="location[]" value="AD">
                                            <label for="AD">Dalat</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="AN" name="location[]" value="AN">
                                            <label for="AN">Nha Trang</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="AM" name="location[]" value="AM">
                                            <label for="AM">Mui Ne</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="B" name="location[]" value="B">
                                            <label for="B">Danang</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="CH" name="location[]" value="CH">
                                            <label for="CH">Hanoi</label>          
                                        </td>
                                        <td>
                                            <input type="checkbox" id="CS" name="location[]" value="CS">
                                            <label for="CS">Sapa</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="CN" name="location[]" value="CN">
                                            <label for="CN">Ninh Binh</label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                    <div class="row g-5 align-items-center">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary rounded-pill py-2 px-4"></input>
                            </div>
                    </div>
            </div>
        </div> 
    </form>
    <!-- Custom Package End -->

        

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
    <script src="js/custom.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>