<!DOCTYPE>
<?php 

session_start();

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
	<a href="index.php">	<img id="logo" src="images/lgo.png"></a>
	<a href="index.php">	<img id="banner" src="images/banner.png"> </a>

	</div>

<!-- header wrapper ends here -->
	

<!-- menubar wrapper start here -->

<div class="menubar"> 


<ul id="menu">
	
<li><a href="index.php"> Home </li>
<li><a href="all_products.php"> All Products </li>
<li><a href="customer/my_account.php"> My Account </li>
<li><a href="#"> Sign Up </li>
<li><a href="cart.php"> Shopping Cart </li>
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

		<?php cart(); ?>

		<div id="shoping_cart">
			
		<span style="float:right; font-size:18px; padding:5px; line-height:40px;">Welcome Guesst! <b style="color:yellow">Shopping  Cart</b> Total Items <?php echo total_itmes(); ?> - Total Price <?php total_price(); ?> <a href="cart.php" style="color:yellow"> Go to cart </a>



		</span>

		</div>



		<div id="product_box">

		<form action=""method="POST"enctype="multipart/form-data">

		<table align="center" width="600" bgcolor="skyblue">

		<tr align="center">
		<td colspan="4"> <h2>Update your cart or checkout </h2></td>

		</tr>


		<tr align="center">
		<th>Remove </th>
		<th>Product</th>
		<th>Quantity </th>
		<th>Total Price </th>
		</tr>
		
		<?php

		

	$total = 0;

	global $con;

	$ip = getIp();

	$sel_price = "select * from cart where ip_add='1270'";

	$run_price = mysqli_query($con, $sel_price);

	while($p_price = mysqli_fetch_array($run_price)){

			$pro_id = $p_price['p_id'];

			$pro_price = "select * from products where product_id= '$pro_id'";
	

			$run_pro_price = mysqli_query($con,$pro_price);

			while($pp_price =mysqli_fetch_array($run_pro_price)){


					$product_price = array($pp_price['product_price']);


					$product_title = $pp_price['product_title'];
					$product_image = $pp_price['product_img1'];
					$single_price = $pp_price['product_price'];


					$values = array_sum($product_price);


					$total +=$values;
			

		?>


		<tr align="center">

		<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
		<td><?php echo $product_title; ?> <br>
		<img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60"/>
		</td>
		
		<td> <input type="text" size="4" name="qty" value="<?php $_SESSION['qty']; ?>"/></td>

		<?php 

		if(isset($_POST['update_cart'])){

			$qty = $_POST['qty'];

			$update_qty = "update cart set qty='$qty'";

			$run_qty = mysqli_query($con,$update_qty);

			$_SESSION['qty'] = $qty;

			$total = $total*$qty;


	}


		?>

		<td> <?php echo "$". $single_price; ?></td>
		</tr>


		

	<?php }  } ?>

		<tr align="right"> 
		<td colspan="4"><b>Sub Total</b></td>
		<td colspan="4"><?php echo "$". $total ;?></td>
		</tr>


		<tr>
		<td align="center"><input type="submit" name="update_cart" value="update_cart"/></td>
		<td align="center"><input type="submit" name="continue" value="continue shopping"/></td>
		<td align="center"> <button><a href="checkout.php" style="text-decoration=none; color:black;"> checkout</a></button></td>
		</tr>


		</table>
		</form>


<?php 

	function updatecart(){
	
	global $con;

	$ip = getIp();

	if(isset($_POST['update_cart'])){

		foreach ($_POST['remove'] as $remove_id){

			$delete_product = "delete from cart where p_id= '$remove_id' and ip_add='1270'";

			$run_delete = mysqli_query($con,$delete_product);

			if($run_delete ){

				echo "<script>window.open('cart.php', '_self')</script>";

			}

		}

	}



	if(isset($_POST['continue'])){

		echo "<script>window.open('index.php', '_self')</script>";
	}


	


}

echo @$up_cart = updatecart();

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