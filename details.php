<!DOCTYPE>
<?php 

include ("includes/con.php");
include ("functions/functions.php"); 


?>
<html>
<head>
<title> OLSHP</title>
<link rel="stylesheet" href="styles/style.css" media="all">

</head>
<body>

<!-- Main content wrapper start here -->


<div calss="main_wrapper">

<!-- header wrapper start here -->
	<div class="header_wrapper"> 
		<img id="logo" src="images/lgo.png">
		<img id="banner" src="images/banner.png">

	</div>

<!-- header wrapper ends here -->
	

<!-- menubar wrapper start here -->

<div class="menubar"> 


<ul id="menu">
	
<li><a href="#"> Home </li>
<li><a href="#"> All Products </li>
<li><a href="#"> My Account </li>
<li><a href="#"> Sign Up </li>
<li><a href="#"> Shopping Cart </li>
<li><a href="#"> Contact Us </li>

</ul>

<div id="form">
	<form method="get" action="results.php" enctype="multipart/form-data">
	<input type="text" name="user_query" placeholder="search product">
	<input type="submit" name="search" value="search">
	</form>

</div>

</div>

<!-- menubar wrapper ends here -->


<!-- content wrapper start here -->
<div class="content_wrapper"> 


<div id="sidebar"> 

<div id="sidebar_title"> Categories</div>
	
		<ul id="cats">

			<?php  getcats(); ?>
			

		</ul>

<div id="sidebar_title"> Brands</div>
	
		<ul id="cats">


			
				<?php getbrands(); ?>

		</ul>

</div>


<div class="content_area"> 

		<div id="shoping_cart">
			
		<span style="float:right; font-size:18px; padding:5px; line-height:40px;">Welcome Guesst! <b style="color:yellow">Shopping  Cart</b> Total Items - Total Price <a href="cart.php" style="color:yellow"> Go to cart </a>



		</span>

		</div>

		<div id="product_box">
		<?php
			if(isset($_GET['pro_id'])){

			$product_id = $_GET['pro_id'];

			$get_pro = "select * from products where product_id='$product_id'";
			$run_pro = mysqli_query($con, $get_pro);

			while($row_pro=mysqli_fetch_array($run_pro)){

				$pro_id = $row_pro['product_id'];
				$pro_title = $row_pro['product_title'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_img1'];
				$pro_desc = $row_pro['product_desc'];

				echo"
				<div id='single_product'>
						<h3>$pro_title</h3>
						<img src='admin_area/product_images/$pro_image' width='400' height='300' />


						<p><b>$ $pro_price<b><p>
						<p><b>$ $pro_desc<b><p>


						<a href='index.php'>Go Back</a>
						<a href='index.php?pro_id=$pro_id'><button style='float:left;'>Add to Cart</button></a>

				</div>";



		}
}
?>

		</div>



</div>


</div>

<!-- content wrapper ends here -->



<div id="footer"> 

<h2 style="text-align:center; padding-top:30px;"> &copy; 2016 by www.OLSHP.com</h2>
</div>


</div>
<!-- Main content wrapper ends here -->




</body>
</html>