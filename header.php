	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="assets/img/logo.svg" alt="Logo" width="150px" height="80px">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								
								<li><a href="index.php"> Home</a></li>
								<li><a href="shop.php"> Shop </a></li>
								<li><a href="about.php"> About </a></li>
								<li><a href="contact.php"> Contact </a></li>
								
								<?php
									if(@isset($_SESSION['admin'])){
										echo "<li><a href='admin.php'> Admin </a></li>";
									}
								?>			
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
										<button id="clearStorage" type="button" class="btn"><a  href="./auth//logout.php"><i class="fas fa-logout"></i>Logout</a></button>
									</div>
								</li>
							</ul>
						</nav>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$("#clearStorage").click(function() {
				localStorage.removeItem("order");
				});
			});
	</script>


	<!-- end header -->