<div>
<?php 
include ("includes/con.php");
include ("functions/functions.php"); 

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

          $product_name = $p_price['product_title'];
          
          $values = array_sum($product_price);


          $total +=$values;
      }
  }




?>




<h2 align="center">Pay now with paypal:</h2>

<form align="center" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="bussinessstest@shop.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="Hot Sauce-12oz Bottle">
  <input type="hidden" name="amount" value="5.95">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  alt="PayPal - The safer, easier way to pay online">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

</div>






