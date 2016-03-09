<?php

include ("includes/con.php");

//getting the categories

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
	}


function cart(){

	if(isset($_GET['add_cart'])){

		global $con;

		$ip = getIp();

		$pro_id = $_GET['add_cart'];
	
		$check_pro = "select * from cart where ip_add = '$ip' and p_id= '$pro_id' ";

		$run_check = mysqli_query($con, $check_pro);

		if(mysqli_num_rows($run_check)>0) { 

			echo "";
		}else {

				$insert_pro = "INSERT INTO cart (p_id, ip_add) VALUES ('$pro_id','$ip')";

				$run_pro = mysqli_query($con,$insert_pro );

				echo "<script>window.open('index.php','_self')</script>";



		}

	}


}

//need to check with vijay..
function total_itmes(){

	if(isset($_GET['add_cart'])){


		global $con;
		$ip = getIp();
		$get_items = "select * from cart where ip_add='1270'";
		$run_items = mysqli_query($con, $get_items);
		$count_items = mysqli_num_rows($run_items);

	
	}
		else {

		global $con;
		//$ip = getIp();
		$ip = '127.0.0.1';
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items);
		$count_items = mysqli_num_rows($run_items);

		}

		echo $count_items;
}



function total_price(){

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

					
					$values = array_sum($product_price);


					$total +=$values;
			}
	}


	echo $total;
}




function getcats(){

	global $con;

	$get_cats = "select * from categories";

	$run_cats = mysqli_query($con, $get_cats);

	while($row_cats = mysqli_fetch_array($run_cats)){

		$cat_id = $row_cats['cat_id'];

		$cat_title = $row_cats['cat_title'];

		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";

	}



}



function getbrands(){

	global $con;

	$get_brands = "select * from brands";

	$run_brands = mysqli_query($con, $get_brands);

	while($row_brands = mysqli_fetch_array($run_brands)){

		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";

	}

}




function getpro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){

	global $con;

	$get_pro = "select * from products order by rand() limit 6";
	$run_pro = mysqli_query($con, $get_pro);

	while($row_pro=mysqli_fetch_array($run_pro)){

		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['cat_id'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_img1'];

		echo"
		<div id='single_product'>
				<h3>$pro_title</h3>
				<img src='admin_area/product_images/$pro_image' width='180' height='180' />


				<p><b>Price:$ $pro_price<b><p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?add_cart=$pro_id'><button style='float:left;'>Add to Cart</button></a>

		</div>";



		}

	}

}

}



function getcatpro(){

	if(isset($_GET['cat'])){
	
	$cat_id = $_GET['cat'];

	global $con;

	$get_cat_pro = "select * from products where cat_id='$cat_id'";
	$run_cat_pro = mysqli_query($con, $get_cat_pro);


	$count_cat_pro = mysqli_num_rows($run_cat_pro);

	if($count_cat_pro === 0){

		echo "<h2> There is no product </h2>";

	}else {

	while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){

		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['cat_id'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_img1'];



		echo"
		<div id='single_product'>
				<h3>$pro_title</h3>
				<img src='admin_area/product_images/$pro_image' width='180' height='180' />


				<p><b>$ $pro_price<b><p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?pro_id=$pro_id'><button style='float:left;'>Add to Cart</button></a>

		</div>";



		}

	}
}


}




function getbrandpro(){

	if(isset($_GET['brand'])){
	
	$brand_id = $_GET['brand'];

	global $con;

	$get_brand_pro = "select * from products where brand_id='$brand_id'";
	$run_brand_pro = mysqli_query($con, $get_brand_pro);


	$count_brand_pro = mysqli_num_rows($run_brand_pro);

	if($count_brand_pro === 0){

		echo "<h2> There is no product were found for this brand</h2>";

	}else {

	while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){

		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['cat_id'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_img1'];



		echo"
		<div id='single_product'>
				<h3>$pro_title</h3>
				<img src='admin_area/product_images/$pro_image' width='180' height='180' />


				<p><b>$ $pro_price<b><p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?pro_id=$pro_id'><button style='float:left;'>Add to Cart</button></a>

		</div>";



		}

	}
}


}


function getallpro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){

	global $con;

	$get_pro = "select * from products";

	$run_pro = mysqli_query($con, $get_pro);

	while($row_pro=mysqli_fetch_array($run_pro)){

		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['cat_id'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_img1'];

		echo"
		<div id='single_product'>
				<h3>$pro_title</h3>
				<img src='admin_area/product_images/$pro_image' width='120' height='120' />


				<p><b>$ $pro_price<b><p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?pro_id=$pro_id'><button style='float:left;'>Add to Cart</button></a>

		</div>";



		}

	}

}

}