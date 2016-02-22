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


<div class="content_area"> This is content area</div>

</div>

<!-- content wrapper ends here -->



<div id="footer"> 

<h2 style="text-align:center; padding-top:30px;"> &copy; 2016 by www.OLSHP.com</h2>
</div>


</div>
<!-- Main content wrapper ends here -->




</body>
</html>