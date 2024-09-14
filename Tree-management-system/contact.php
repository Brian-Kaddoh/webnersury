<?php 
include("includes/config.php");
$error="";
$msg="";
if(isset($_POST['send']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	
	if(!empty($name) && !empty($email) && !empty($phone) && !empty($subject) && !empty($message))
	{
		
		$sql="INSERT INTO contact (name,email,phone,subject,message) VALUES ('$name','$email','$phone','$subject','$message')";
		   $result=mysqli_query($con, $sql);
		   if($result){
			   $msg = "<p class='alert alert-success'>Message Send Successfully</p> ";
		   }
		   else{
			   $error = "<p class='alert alert-warning'>Message Not Send Successfully</p> ";
		   }
	}else{
		$error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Tree Nursery Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


    <link rel="stylesheet" href="styles.css">
</head>
<body>


<div id="page-wrapper">
    <div class="row"> 
        <!--	Header start  -->
		<?php include("includes/header.php");?>
        <!--	Header end  -->
        
        
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-5 bg-secondary" style="height:200px;width:auto;">
					<div class="footer-widget">
                                        <h4 class="widget-title text-white double-down-line-left position-relative">Contact Us</h4>
                                        <ul class="text-white">
                                            <li class="hover-text-primary"><i class="fas fa-map-marker-alt text-white mr-2 font-13 mt-1"></i>Kondele, Kisumu</li>
                                            <li class="hover-text-primary"><i class="fas fa-phone-alt text-white mr-2 font-13 mt-1"></i>+254 757459280</li>
                                            <li class="hover-text-primary"><i class="fas fa-phone-alt text-white mr-2 font-13 mt-1"></i>+254 111383736</li>
                                            <li class="hover-text-primary"><i class="fas fa-envelope text-white mr-2 font-13 mt-1"></i>support@treenursery.com</li>
                                        </ul>
                                    </div>
                    </div>
					<div class="col-lg-1"></div>
                    <div class="col-md-12 col-lg-7">
						<div class="container">
                        <div class="row">
							<div class="col-lg-12">
								<h2 class="text-secondary double-down-line text-center mb-5">Get In Touch</h2>
								<?php echo $msg; ?><?php echo $error; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<form class="w-100" action="#" method="post">
									<div class="row">
										<div class="row mb-4">
											<div class="form-group col-lg-6">
												<input type="text"  name="name" class="form-control" placeholder="Your Name*">
											</div>
											<div class="form-group col-lg-6">
												<input type="text"  name="email" class="form-control" placeholder="Email Address*">
											</div>
											<div class="form-group col-lg-6">
												<input type="text"  name="phone" class="form-control" placeholder="Phone" maxlength="10">
											</div>
											<div class="form-group col-lg-6">
												<input type="text" name="subject"  class="form-control" placeholder="Subject">
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<textarea name="message" class="form-control" rows="5" placeholder="Type Comments..."></textarea>
												</div>
											</div>
										</div>
										<button type="submit" value="send message" name="send" class="btn btn-success">Send Message</button>
									</div>
								</form>
							</div>
						</div>
						</div>
					</div>
                </div>
            </div>
        </div>
        
        
        
        
        
    </div>
</div>
<!--	Footer   start-->
<?php include("includes/footer.php");?>
		<!--	Footer   start-->


<!--	Js Link--> 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>