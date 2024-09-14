<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

include_once('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


    <link rel="stylesheet" href="styles.css">
    <script>
        function searchTrees() {
            const treeType = document.getElementById('treeType').value;
            fetch(`search.php?type=${treeType}`)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '';

                    data.forEach(tree => {
                        const treeDiv = document.createElement('div');
                        treeDiv.innerHTML = `
                            <h3>${tree.name}</h3>
                            <p><strong>Scientific Name:</strong> ${tree.scientific_name}</p>
                            <p><strong>Description:</strong> ${tree.description}</p>
                            <p><strong>Price:</strong> $${tree.price}</p>
                            <p><strong>Category:</strong> ${tree.category}</p>
                            <img src="${tree.image_url}" alt="${tree.name}" style="width:200px;">
                        `;
                        resultsDiv.appendChild(treeDiv);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</head>
<body>
<?php include("includes/header.php");?>
<!--	Banner Start   -->
<div class="overlay-black w-100 slider-banner1 position-relative" style="background-image: url('images/tree1.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <div class="text-white">
                    <h1 class="mb-4"><span class="text-success">Find the Perfect</span><br>
                    Tree for Your Nursery, Home and Garden</h1>
                    <form onsubmit="event.preventDefault(); searchTrees();">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <select class="form-control" name="tree_type">
                                        <option value="">Select Tree Type</option>
                                        <option value="fruit">Fruit Tree</option>
                                        <option value="shade">Shade Tree</option>
                                        <option value="flowering">Flowering Tree</option>
                                        <option value="ornamental">Ornamental Tree</option>
                                        <option value="timber">Timber Tree</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="tree_name" placeholder="Enter Tree Name" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-group">
                                    <button type="submit" name="search" class="btn btn-success w-100">Search Tree</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--	Banner End  -->
<!-- Service Section Starts here-->
<div class="full-row bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"style="text-align:center;">
                <h2 class="text-secondary double-down-line text-center mb-5" >Our Services</h2>
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
                        <i class="fas fa-box-open text-success flat-medium" aria-hidden="true"></i>
                        <h5 class="text-secondary hover-text-success py-3 m-0">
                            <a href="#">Home Decor Items</a>
                        </h5>
                        <p>Durable and eco-friendly tree planting bags to ensure optimal growth of young trees.</p>
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
<!-- Gallery section-->
<div id="gallery-section" class="container py-5">
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <h2 class="text-secondary double-down-line">Tree Gallery</h2>
        </div>
    </div>
    <div class="row">
        <div id="gallery-container" class="col-12 d-flex flex-wrap justify-content-center">
            <!-- Dynamic gallery items will be injected here -->
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 text-center">
            <button id="prev-btn" class="btn btn-success mx-2">&laquo; </button>
            <button id="next-btn" class="btn btn-success mx-2"> &raquo;</button>
        </div>
    </div>
</div>
<!--End Gallery-->

<!-- Why Choose Us Section -->
<div class="full-row bg-one overlay-secondary-half" style="background-image: url('images/tree8.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6"style="background:grey;">
                <div class="why-choose-us pr-4">
                    <h3 class="pb-4 mb-3 text-white">Why Choose Us</h3>
                    <ul>
                        <li class="mb-4 text-white d-flex"> 
                            <i class="fas fa-leaf flat-medium float-left d-table mr-4 text-success" aria-hidden="true"></i>
                            <div class="pl-2">
                                <h5 class="mb-3">High-Quality Trees</h5>
                                <p>We provide a wide range of high-quality trees that are well-suited for various environments and purposes.</p>
                            </div>
                        </li>
                        <li class="mb-4 text-white d-flex"> 
                            <i class="fas fa-seedling flat-medium float-left d-table mr-4 text-success" aria-hidden="true"></i>
                            <div class="pl-2">
                                <h5 class="mb-3">Expert Tree Care</h5>
                                <p>Our team of experts ensures that every tree is well-maintained and cared for, from nursery to planting.</p>
                            </div>
                        </li>
                        <li class="mb-4 text-white d-flex"> 
                            <i class="fas fa-hand-holding-water flat-medium float-left d-table mr-4 text-success" aria-hidden="true"></i>
                            <div class="pl-2">
                                <h5 class="mb-3">Sustainable Practices</h5>
                                <p>We are committed to using sustainable practices in our nursery, promoting environmental conservation.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Why Choose Us Section -->
 
  <!-- Testimonial Section -->
  <div class="full-row">
            <div class="container">
                <div class="row">
					<div class="col-lg-12">
						<div class="content-sidebar p-4">
							<div class="mb-3 col-lg-12">
								<h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Testimonial</h4>
									<div class="recent-review owl-carousel owl-dots-gray owl-dots-hover-success">
									
                                    <?php
// Fetch testimonials from the database
$query = mysqli_query($con, "SELECT feedback.fdescription, users.username, users.role FROM feedback JOIN users ON feedback.uid = users.user_id WHERE feedback.status = '1'");
while($row = mysqli_fetch_array($query)) {
?>
<div class="item">
    <div class="p-4 bg-success down-angle-white position-relative">
        <p class="text-white"><i class="fas fa-quote-left mr-2 text-white"></i><?php echo $row['fdescription']; ?> <i class="fas fa-quote-right mr-2 text-white"></i></p>
    </div>
    <div class="p-2 mt-4">
        <span class="text-success d-table text-capitalize"><?php echo $row['username']; ?></span> 
        <span class="text-capitalize"><?php echo $row['role']; ?></span>
    </div>
</div>
<?php } ?>
									</div>
							</div>
						 </div>
					</div>
				</div>
			</div>
		</div>
                    
<!-- End of Testimonial Section -->
 <!--footer section-->
 <?php include("includes/footer.php");?>
 
<script>
    $(document).ready(function() {
    var topBarHeight = $('.top-bar').outerHeight();
    var navbar = $('.navbar');

    $(window).scroll(function() {
        if ($(this).scrollTop() > topBarHeight) {
            $('.top-bar').fadeOut();
            navbar.css('top', '0');
        } else {
            $('.top-bar').fadeIn();
            navbar.css('top', topBarHeight + 'px');
        }
    });
});
</script>
<!--Smooth scrolling feature for search-->
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();
    // Fetching logic goes here...
    document.querySelector('.search-results').scrollIntoView({ behavior: 'smooth' });
});
</script>
<script>
    const galleryItems = [
    // Array of image paths or data fetched from the database
    'images/tree1.jpg',
    'images/tree2.jpg',
    'images/tree3.jpg',
    'images/tree4.jpg',
    'images/tree10.jpg',
    'images/tree6.jpg',
    'images/tree7.jpg',
    'images/tree8.jpg',
    'images/tree9.jpg',
    
    // Add more image paths as needed
];

let currentIndex = 0;
const itemsPerPage = 9;

function displayGalleryItems() {
    const galleryContainer = document.getElementById('gallery-container');
    galleryContainer.innerHTML = '';

    const start = currentIndex * itemsPerPage;
    const end = Math.min(start + itemsPerPage, galleryItems.length);

    for (let i = start; i < end; i++) {
        const item = document.createElement('div');
        item.className = 'gallery-item';
        item.innerHTML = `
            <img src="${galleryItems[i]}" alt="Tree Image">
            <div class="overlay-text">Your favourite Tree Destination</div>
        `;
        galleryContainer.appendChild(item);
    }
}

document.getElementById('prev-btn').addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        displayGalleryItems();
    }
});

document.getElementById('next-btn').addEventListener('click', () => {
    if ((currentIndex + 1) * itemsPerPage < galleryItems.length) {
        currentIndex++;
        displayGalleryItems();
    }
});

// Initial display
displayGalleryItems();
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="script.js"></script>
</body>
</html>