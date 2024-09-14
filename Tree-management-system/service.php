<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Tree Nursery Management System">
    <meta name="keywords" content="">
    <meta name="author" content="Your Name">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
    <title>Our Services - Tree Nursery Management System</title>
</head>
<body>
    <div id="page-wrapper" style="padding-left:10px;">
        <div class="row">
            <!-- Header start -->
            <?php include("includes/header.php");?>
            <!-- Header end -->
            
            <!-- Service Section Starts here-->
            <div class="full-row bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12"style="text-align:center;">
                            <h2 class="text-secondary double-down-line text-center mb-5">Our Services</h2>
                        </div>
                    </div>
                    <div class="text-box-one">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-seedling text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Tree Sales</a>
                                    </h5>
                                    <p>We provide a variety of healthy, ready-to-plant trees to enhance your landscape or garden.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-seedling text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Tree Seed Sales</a>
                                    </h5>
                                    <p>High-quality seeds for various tree species, perfect for those who want to grow from scratch.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-hand-sparkles text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Planting Services</a>
                                    </h5>
                                    <p>Expert planting services to ensure your trees are planted correctly and thrive in their new environment.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-box-open text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Tree Planting Bags</a>
                                    </h5>
                                    <p>Durable and eco-friendly tree planting bags to ensure optimal growth of young trees.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-leaf text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Home Decor Items</a>
                                    </h5>
                                    <p>Nature-inspired home decor items to bring the beauty of trees into your living space.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-clipboard-list text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Tree Care Consultation</a>
                                    </h5>
                                    <p>Expert advice on tree care, disease prevention, and maintenance for optimal tree health.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-truck text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Delivery Services</a>
                                    </h5>
                                    <p>Safe and timely delivery of trees, seeds, and planting supplies to your doorstep.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                                    <i class="fas fa-chalkboard-teacher text-success flat-medium" aria-hidden="true"></i>
                                    <h5 class="text-secondary hover-text-success py-3 m-0">
                                        <a href="#">Workshops & Training</a>
                                    </h5>
                                    <p>Educational workshops and training sessions on tree planting, care, and environmental conservation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Service section ends here-->

           
        </div>
    </div>
     <!-- Footer start -->
     <?php include("includes/footer.php");?>
            <!-- Footer end -->

    <!-- Js Link -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>