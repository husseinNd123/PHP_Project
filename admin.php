<?php
	session_start();
	require('Database/DBController.php');
	$result = $db->conn->query("SELECT name , clicks from product");
	$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$data = array(array('Product Name', 'Number Of Clicks'));

	for ($i = 0 ; $i < count($result) ; $i++){
		$newArr = array( $result[$i]['name'], (int)$result[$i]['clicks']);
		array_push( $data, $newArr );
	}
	$data = json_encode($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Admin</title>

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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $data; ?>);

        var options = {
            title: 'Number of clicks on each product added to cart',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    </script>

</head>

<body>

    <?php
		include('header.php');
	?>
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Welcome To Admin Panel</p>
                        <h1><?php echo $_SESSION['username'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <div class="mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <?php
							$categories = $db->conn->query("SELECT category_name FROM `category`");
							$categories = mysqli_fetch_all($categories, MYSQLI_ASSOC);
							
							if(isset($_GET['update'])){
								$id = $_GET['update'];
								$result = $db->conn->query("SELECT * FROM `product` WHERE pid='$id'");
								$result = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
								

								
								$form = "<div class='form-title'>
						<h2>Update Product</h2>
					</div>
					<div class='update-form'>
						<form method='POST' id='add-product' action='./API/Admin.php'>
							<p>
								<div class='form-group'>
									<label for='name'>Product Name</label>
									<input required type='text' name='name' id='name' value='".$result['name']."'>
								</div>
								<div class='form-group'>
									<label for='name'>Price ($)</label>
									<input required type='number' name='price' id='price' value='".$result['price']."'>
								</div>
							</p>
							<p>
								<div class='form-group'>
									<label for='name'>Category</label>";

									$form .= " <select name='category'> ";
									foreach($categories as $cat){
										$selected = "";
										if($result['category'] == $cat['category_name']) $selected = "selected";
										$form .= " <option $selected value='".$cat['category_name']."'> ".$cat['category_name']." </option> ";
									}
									$form .= " </select> ";

								$form .= "</div>
								<div class='form-group'>
									<label for='name'>Quantity</label>
									<input required type='number' name='quantity' id='quantity' value='".$result['quantity']."'>
								</div>
                               
							</p>
							<p>
								<textarea required name='description' id='description' cols='30' rows='10'  placeholder='Enter a brief description of what the product is'>".$result['description']."</textarea></p>
							<p>
								<div class='form-group'>
									<label for='name'>Image</label>
									<input required type='text' placeholder='Enter Image URL' name='image' value='".$result['image']."'>
								</div>
                                
                            </p>
                            <input type='hidden' name='update-product' value='1'>
                            <input type='hidden' name='pid' value='".$result['pid']."'>
							<p><input type='submit'></p>
						</form>
					</div>";
					echo $form;
							}
							else{
								$form = "<div class='form-title'>
						<h2>Add Product</h2>
					</div>
					<div class='update-form'>
						<form method='POST' id='add-product' action='./API/Admin.php'>
							<p>
								<div class='form-group'>
									<label for='name'>Product Name</label>
									<input required type='text' name='name' id='name'>
								</div>
								<div class='form-group'>
									<label for='name'>Price ($)</label>
									<input required type='number' name='price' id='price'>
								</div>
							</p>
							<p>
								<div class='form-group'>
									<label for='name'>Category</label>";

									$form .= " <select name='category'> ";
									foreach($categories as $cat){
										$form .= " <option value='".$cat['category_name']."'> ".$cat['category_name']." </option> ";
									}
									$form .= " </select> ";
								

								$form .= "</div>
								<div class='form-group'>
									<label for='name'>Quantity</label>
									<input required type='number' name='quantity' id='quantity'>
								</div>
                               
							</p>
							<p>
								<textarea required name='description' id='description' cols='30' rows='10'  placeholder='Enter a brief description of what the product is'></textarea></p>
							<p>
								<div class='form-group'>
									<label for='name'>Image</label>
									<input required type='text' placeholder='Enter Image URL' name='image'>
								</div>
                                
                            </p>
                            <input type='hidden' name='add-product' value='1'>
							<p><input type='submit'></p>
						</form>
					</div>";
					echo $form;
							}

						?>

                </div>
            </div>

            <br>
            <br>
            <br>
            <!-- add category -->
            <div class='form-title'>
                <h2>Add Category</h2>
            </div>
            <div class='add-category-form'>
                <form method='POST' id='add-product' action='./API/Admin.php'>
                    <p>
                    <div class='form-group'>
                        <label for='name'>Category Name</label>
                        <input required type='text' name='name' id='name'>
                    </div>
                    </p>
                    <input type='hidden' name='add-category' value='1'>
                    <p><input type='submit'></p>
                </form>
            </div>
        </div>
    </div>





    <div id="piechart" style="width: 700px; height: 700px; margin-inline: auto"></div>

    <?php
        include('footer.php')
    ?>

    <!-- jquery -->
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
    <!-- mean menu -->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!-- main js -->
    <script src="assets/js/main.js"></script>

</body>

</html>