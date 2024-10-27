<?php
	session_start();
	if(! isset($_SESSION["loggedIN"])){
		header('Location: ./loginPage.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title>Contact</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/logo.svg">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<?php
		include('header.php');
	?>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Get 24/7 Support</p>
						<h1>Contact us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>Don't hesitate!</h2>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form>
							<p>
								<input required type="text" placeholder="Username" name="username" id="username">
								<input type="text" placeholder="Subject" name="subject" id="subject">
							</p>
							<p><textarea required name="message" id="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
							<input type="hidden" name="contact" value="1" />
							<p><button type="button" id="submit">Submit</button></p>
						</form>
					</div>
				</div>


				<script>
					$(document).ready(function(){
						$("#submit").on("click", function(){
							var username = $("#username").val();
			                var subject = $("#subject").val();
			                var message = $("#message").val();

			                $.ajax(
		                    {
		                        url: 'API/Admin.php?contact=1',
		                        method: 'POST',
		                        data: {
		                        	contact: 1,
		                            username : username,
		                            subject : subject,
		                            message: message,
		                        },
		                        success: function (response) {
		                            if(response.indexOf('success') >= 0){
										alert("Thank you! Your message has been submitted");
		                            }
		                        },
		                        dataType: 'text', 
		                    }
		                );   

						})

					});


				</script>


				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> Shop Address</h4>
							<p>Al-Hadath <br> Beirut <br> Lebanon</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> Shop Hours</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Contact</h4>
							<p>Phone: +00961 81 031 526 <br> Email: support@barakat.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->

	<?php 
		include('footer.php');
	 ?>
	
	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	
</body>
</html>