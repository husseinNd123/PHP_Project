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
	<!-- title -->
	<title>Single Product</title>
	
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

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div id="single-product-container" class="row">
			</div>
		</div>
	</div>
	<!-- end single product -->


	<script type="text/javascript">

		let id = new URLSearchParams(window.location.search).get('id');
        $(document).ready(function() {
                 $.ajax(
                    {
                        url: 'API/Product.php?getProductById=1&id='+id,
                        method: 'GET',
                        success: function (response) {
                            console.log(response);
                            $("#single-product-container").html(response);
                        },
                        dataType: 'text', 
                    }
                );    
               }
            );
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
