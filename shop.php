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
	<title>Shop</title>

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
	<!-- JQUERY -->
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

	<script type="text/javascript">
		let cat = new URLSearchParams(window.location.search).get('cat') || 'all';
        $(document).ready(function() {
                 $.ajax(
                    {
                        url: 'API/Category.php?getCategories=1',
                        method: 'GET',
                        success: function (response) {
                            $("#category_list").html(response);							
                        },
                        dataType: 'text', 
                    }
                );

                $.ajax(
                    {
                        url: 'API/Product.php?getAllProducts=1&cat='+cat,
                        method: 'GET',
                        success: function (response) {
                            $("#products-container").html(response);	
							addEventListenersToBtns();
                        },
                        dataType: 'text', 
                    }
                );				
               }
            );

		function addEventListenersToBtns(){
			[...document.querySelectorAll("#deleteProduct")].forEach(btn=>{
				btn.addEventListener('click', function(){
					confirmDelete(btn.dataset.id);
				});
			});

			function confirmDelete(id){
				const modal = document.createElement('div');
				modal.classList.add('confirmModal');
				const msg = "Are you sure you want to delete this item?";

				const buttonsContainer = document.createElement('div');
				
				const confirmBtn = document.createElement('a');
				confirmBtn.innerText = 'Yes';
				confirmBtn.href = './API/Admin.php?delete='+id;

				const cancel = document.createElement('a');
				cancel.innerText = 'Cancel';

				cancel.addEventListener('click',function(){
					document.querySelector('.confirmModal').remove();
				})

				modal.append(msg);
				buttonsContainer.append(confirmBtn);
				buttonsContainer.append(cancel);
				modal.append(buttonsContainer);
				document.body.append(modal);
			}
		}

		let products = [] ;
		function getFromServer(){
			$.ajax({
        		url: 'API/data.php?getData1=1',
        		type: 'GET',
        		dataType: 'json',
        		success: function(response) {
	            	// Optionally, store the data in a global variable if needed
	    	        products = response;
    	    	    console.log(products);
        		}
    		});
		}

		getFromServer();

		
		function addToCart(id) {
			let order = JSON.parse(localStorage.getItem('order')) || [];
    		let added = false;
			let exist = false;

			

    		// Check if the item already exists in the order
			outerLoop: 
			for(let item of order){
    			if (item.id == id) {
					exist = true;
					for(let prod of products){	
						if(parseInt(prod.pid) == id){
							if(item.quantity < parseInt(prod.quantity)){
								added = true
								item.quantity += 1;
								console.log(item.quantity);
								alert('Product added to cart');
								order.sort((a, b) => a.id - b.id);
					  			localStorage.setItem('order', JSON.stringify(order));
								break outerLoop;
							}else{
								alert("You've reached the maximum quantity in the stock");
								break outerLoop;
							}
						}
        			}
    			}
    		};

 			// If the item is not in the order, add it with quantity 1
			if(!exist) {
				added = true;
     			order.push({ id, quantity: 1 });
				console.log("added for the first time");
				alert('Product added to cart');
				
 		   		// Sort the order array based on id in ascending order
 		   		order.sort((a, b) => a.id - b.id);
				
				// Update the local storage with the sorted order
				localStorage.setItem('order', JSON.stringify(order));
			}

		
			if(added){
				$.ajax({
   		    	 url: 'API/Admin.php?trackClick=' + id,
   		    	 method: 'GET',
    			    success: function (response) {
   		    	     console.log('Barakat Tracking Activated - Recorded product added to cart');
   		    	},
    			    dataType: 'text',
    			});
			}	
		}		
		
    </script>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Stop waiting <br> It's time to Buy</p>
						<h1>Shop</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul id="category_list">

                        </ul>
                    	<h4 style="width:fit-content; margin-inline:auto; margin-top: '.7rem';"><?php echo @$_GET['cat'] ?></h4>
                    </div>
                </div>
            </div>


			<div id="products-container" class="row product-lists">
				
			</div>

		
		</div>
	</div>
	<!-- end products -->

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