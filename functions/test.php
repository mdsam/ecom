<?php

include ("../includes/con.php");
//include ("functions.php");

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
	}

//http://localhost/PROJECTS/ecom/index.php?add_cart=12

function total_itmes(){

	if(isset($_GET['add_cart'])){


		global $con;
		$ip = getIp();
		$ip = '1270';
		$get_items = "select * from cart where ip_add='$ip'";
		echo $run_items = mysqli_query($con,$get_items);
		
		$count_items = mysqli_num_rows($run_items);
		
		
	}
		else {

		// global $con;
		// $ip = getIp();
		// $get_items = "select * from cart where ip_add='$ip'";
		// echo $run_items = mysqli_query($con, $get_items);
		// $count_items = mysqli_num_rows($run_items);

	}

		//echo $count_items;
}


total_itmes();