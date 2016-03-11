<?php 
session_start();
include ("includes/con.php");
include ("functions/functions.php");



$total = 0;

	global $con;
	$ip = getIp();
	$sel_price = "select * from cart where ip_add='$ip'";
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


	//getting qty of product
	$get_qty = "select * from cart where p_id = '$pro_id'";
	$run_qty = mysqli_query($con,$get_qty );
	$row_qty = mysqli_fetch_array($run_qty);

	$qty = $row_qty['qty'];

	if($qty ==0){

		$qty = 1;

	}else {

		$qty = $qty;

	}

	//this is about the customer
	$user_c = $_SESSION['customer_email'];
	$get_c = "select * from customer where customer_email = '$user_c'";
	$run_c = mysqli_query($con, $get_c);
	$row_c = mysqli_fetch_array($run_c);
	$c_id = $row['customer_id'];


	//payment details from paypal
	$amount = $_GET['amt'];
	$currency = $_GET['cc'];
	$trx_id = $_GET['tx'];


	//inserting the payment
	$insert_payments = "insert into payaments(amount, customer_id, product_id,trx_id, currency, payment_date) values('$c_id','$pro_id','$trx_id','$currency, NOW())";
	$run_payment = mysqli_query($con,$insert_payments);


	//inserting the order
	$intsert_order = "insert into orders (p_id, c_id, qty, order_date) values('$pro_id', '$c_id', now())";
	$run_order = mysqli_query($con, $intsert_order);


	//empty the cart
	$empty_cart = "delete * from cart";
	$run_cart = mysqli_query($con, $empty_cart);



	if($amount===$total){

		echo "<h2>Welcome:".$_SESSION['customer_email']."<br>"."Your payment was successful!</h>";
		echo "<a href = 'http://localhost/projects/ecom/customer/my_account.php'>Go back to your account </a></h>";

	}else {

		echo "<h2>Welcome Guest, Payment was failed </h2>";
		echo "<a href = 'http://localhost/projects/ecom/'>Go back to shop</a></h>";

	}


?>


<html>
<head>
<title>Payment Successful!</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['customer_email']; ?></h2>
<h3> Your payment was successful. Plesae go to your account</h3>
<h3><a href="http://localhost/projects/ecom/customer/my_account.php"> Go to your account </a></h3>


</body>
</html>