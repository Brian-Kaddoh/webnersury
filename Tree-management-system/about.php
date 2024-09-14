<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="Tree Nursery Management System">
    <meta name="author" content="Your Name">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
    
    <title>About Us - Tree Nursery Web Management System</title>
</head>
<body>
                <!-- Header start -->
                <?php include("includes/header.php");?>
            <!-- Header end -->
    <div id="page-wrapper">
        <div class="row">

            
            <!-- About Our Company -->
            <div class="full-row">
                <div class="container">
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM about");
                    $row = mysqli_fetch_array($query);
                    if($row) {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="about-heading text-center mb-5"><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        </div>
                    </div>
                    <div class="row about-content" style="margin-left:20px;">
                        <div class="col-md-6">
                            <div class="about-text">
                                <?php echo nl2br(htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about-image">
                                <img src="<?php echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="About Us" class="img-fluid rounded shadow">
                            </div>
                        </div>
                    </div>
                    <?php
                    } else {
                        echo "<p>No information available at the moment. Please check back later.</p>";
                    }
                    ?>
                </div>
            </div>
           

            
        </div>
    </div>
    <!-- Footer start -->
    <?php include("includes/footer.php");?>
            <!-- Footer end -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>