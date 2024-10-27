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
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Cart</title>

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
						<p>Your Cart</p>
						<h1>Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->




	<script>
					
		let order = localStorage.getItem("order");
		$(document).ready(function() {
			$("#checkout").on("click", ()=>{
				$.ajax({
					url: 'API/Checkout.php',
	                method: 'GET',
	                data: {
	                	"order": order
	                },
	                success: function (response) {
						localStorage.setItem("order", "[]");
						alert("Your order has been placed!");
						location.reload();
	                },
	                dataType: 'json',
	                contentType: "application/json; charset=utf-8", 
				})
			})

		$.ajax({
			url: 'API/Product.php?getProducts=1',
            method: 'GET',
            data: {
     	       	"order": order
            },
            success: function (response) {
                $("#cart-table-body").html(JSON.stringify(response.out.replace(/\"/g, '')));
            const subtotal = parseInt(JSON.stringify(response.subtotal).slice(1));
                    
              $("#subtotal").html("$" + subtotal);

                if(subtotal > 350){
                	$("#shipping").html("FREE");
                	$("#total").html("$" + subtotal);
                }
                else{
                    $("#shipping").html("$45");
                	$("#total").html("$" + (subtotal + 45));
                }
            },
            dataType: 'json',
            contentType: "application/json; charset=utf-8", 
			})
		})

		const removeFromCart = (id) => {
			let order = JSON.parse(localStorage.getItem("order"));
			for (let i = 0; i < order.length; i++) {
       			 if (order[i].id === id) {
	        	    // Subtract quantity by 1
    		        order[i].quantity = Math.max(0, order[i].quantity - 1);

		            // If quantity becomes zero, remove the item
        		    if (order[i].quantity === 0) {
		                order.splice(i, 1);
            		}
        	    	break; // No need to continue loop after finding the item
		        }
    		}
			localStorage.setItem("order", JSON.stringify(order));
			location.reload();
		}
	</script>


	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Unit Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total Price</th>
								</tr>
							</thead>
							<tbody id="cart-table-body">

							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong > Subtotal: </strong></td>
									<td id="subtotal"></td>
								</tr>
								<tr class="total-data">
									<td><strong >Shipping: </strong></td>
									<td id="shipping"></td>
								</tr>
								<tr class="total-data">
									<td><strong >Total: </strong></td>
									<td id="total"></td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							<a id="checkout" class="boxed-btn black">Check Out</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- end cart -->

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