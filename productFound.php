<html>
<head>
	<title>Kaison</title>

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="style-2.css">

</head>
<body>
    <?php
	//call file to connect sheader
	include ("user-header.php");
	?>

	<?php
	//call file to connect server kaison
	include ("kaison-header.php");

if(isset($_POST['add_to_cart'])){

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$product_quantity = 1;

$select_cart = mysqli_query($connect, "SELECT * FROM `cart` WHERE name = '$product_name'");

if(mysqli_num_rows($select_cart) > 0){
   $message[] = 'product already added to cart';
}else{
   $insert_product = mysqli_query($connect, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
   $message[] = 'product added to cart succesfully';
}

}
?>

<section class="products">

<h1 class="heading">The product you searched for</h1>

<div class="box-container">

   <?php

if(isset($_POST['productName']))
{
    $productName= $_POST['productName'];
$in= mysqli_real_escape_string($connect, $productName);
$q= "SELECT productID, productName, productPrice, productImage FROM product WHERE
    productName='$productName' ORDER BY productID";

	//run the query and assign it to the variable $result
	$result= @mysqli_query($connect, $q);
    if ($result)
	{
        while($fetch_product=mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
    ?>
    <form action="" method="post">
         <div class="box">
            <img src="images/<?php echo $fetch_product['productImage']; ?>" alt="">
            <h3><?php echo $fetch_product['productName']; ?></h3>
            <div class="productPrice">RM <?php echo $fetch_product['productPrice']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['productName']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['productPrice']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['productImage']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
            <a href="product.php?back=<?php?>" class="option-btn"> Go Back </a> </div>
      </form>

      <?php
         };    
    }

    else
         {
         //error message
		echo '<p class ="error"> If no record is shown, this is because you had an incorrect or missing entry in search form.<br>Click the back button on the browser and try again.</p>';
		
		//debugging message
		echo '<p>'.mysqli_error($connect).'<br><br/>Query:'.$q.'</p>';
	}
	//close the database connection 
	mysqli_close($connect);
}
    
      ?>
    </div>

</section>

</body>
</html>