<?php include ("../includes/con.php"); ?>
<?php $con = mysqli_connect("localhost","root","wss","myshop"); ?>


<!DOCTYPE>
<html>

<head>
<title> INST-PD</title>
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script>tinymce.init({ selector:'textarea' });</script>
</head>

<body bgcolor="#A9A9A9">
<a href="../">Home</a>

<form action="insert_product.php" method="POST" enctype="multipart/form-data">

	<table align="center" width="600" border="2">
	
	<tr align="center">
	<td colspan="7"> <h2> Inser New Post Here</h2> </td>

	</tr>

	<tr>
			<td align="right"><b>Product Title:</b></td>
			<td><input type="text" name="product_title"  size="60" required/> </td>
		

	</tr>
	
	<tr>
			<td align="right"><b>Product Category:</b></td>
			<td>
			<select name="product_cat">
					<option> select a category</option>

					<?php 	

						global $con;

						$get_cats = "select * from categories";

						$run_cats = mysqli_query($con, $get_cats);

						while($row_cats = mysqli_fetch_array($run_cats)){

							$cat_id = $row_cats['cat_id'];

							$cat_title = $row_cats['cat_title'];

							echo "<option>$cat_title</option>";

							}


					?>


			</select>
			
			</td>

	</tr>
	
	<tr>
			<td align="right"><b>Product Brand:</b></td>
			<td>
					<select name="product_brand">
					<option> select a Brand</option>

				
					<?php 	

						global $con;

						$get_brands = "select * from brands";

						$run_brands = mysqli_query($con, $get_brands);

						while($row_brands = mysqli_fetch_array($run_brands)){

							$brand_id = $row_brands['brand_id'];
							$brand_title = $row_brands['brand_title'];

							echo "<option value='$brand_id'>$brand_title</option>";

						}

					?>
			</select>
			 </td>
			

	</tr>
	
	<tr>
			<td align="right"><b>Product Image:</b></td>
			<td><input type="file" name="product_image" /> </td>
			

	</tr>
	
	<tr>
			<td align="right"><b>Product Price:</b></td>
			<td><input type="text" name="product_price" /> </td>
			

	</tr>
	
	<tr>
			<td align="right"><b>Product Desc:</b></td>
			<td><textarea name="product_desc" cols="50" rows="10"></textarea> </td>
			

	</tr>

	<tr>
			<td align="right"><b>Product Keyword:</b></td>
			<td><input type="text" name="product_keyword" size="50" /> </td>
			

	</tr>

	<tr align="center">
			
			<td colspan="8"><input type="submit" name="insert_post" value="Insert Now"/> </td>
			
	</tr>






	</table>

</form>
</body>
</html>

<?php

if(isset($_POST['insert_post'])){

	//getting the text data from the fields
	$product_title = $_POST['product_title'];
	$product_cat = $_POST['product_cat'];
	$product_brand = $_POST['product_brand'];
	$product_price = $_POST['product_price'];
	$product_desc = $_POST['product_desc'];
	$product_keywords = $_POST['product_keyword'];


	//getting the image from fields

	$product_image = $_FILES['product_image']['name'];
	$product_image_tmp = $_FILES['product_image']['tmp_name'];

	$product_images = move_uploaded_file($product_image_tmp,"product_images/$product_image");

// ProductsTable: product_id/cat_id/brand_id/date/product_title/product_img1/product_img2/product_img3/product_price/product_desc/product_keyword/status
//'cat_id','brand_id',


echo $insert_product = "INSERT INTO products(product_title,product_price,product_img1,product_keyword) VALUES('$product_title','$product_price','$product_image','$product_keywords')";


// echo $insert_product = "INSERT INTO products('product_id','cat_id','brand_id','product_title','product_price','product_desc','product_img1','product_keyword') VALUES('0','$product_cat','$product_brand', '$product_title','$product_price','$product_desc','$product_image','$product_keywords')";


$insert_pro = mysqli_query($con, $insert_product);

if(!$insert_pro){ echo("Error description: " . mysqli_error($con)); }

	if($insert_pro){

		echo " <script>alert('Product has been inserted!')</script>";
		echo " <script>window.open('insert_products.php')</script>";

	} else {echo "" ;}

		
	


}






?>