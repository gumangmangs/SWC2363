<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="style-2.css">

</head>
<body>
      <header class="header">

   <div class="flex">

      <a href="kaison.php" class="logo"><img src="kaison-logo3.png" alt=""></a>

      <nav class="navbar">
      <a href="kaison.php"> HOME</a>
            <a href="about.php">ABOUT</a>
            <a href="product.php">PRODUCT</a>
            <a href="news.php">NEWS</a>
            <a href="contact.php">CONTACT US</a>  
      </nav>

      <?php
      
      @include 'kaison-header.php';
      
      $select_rows = mysqli_query($connect, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

        <div class="icons">
            <div class="login-icon" id="login-icon">
                <a href="userLogin.php"><img src="login-icon.png" width="20" height="20"></a>
            </div>
            <div class="cart-icon" id="cart-icon">
                <a href="cart.php"><img src="shopping-cart3.png" width="20" height="20"><span><?php echo $row_count; ?></span></a>
            </div>
        </div>
    </div>

</header>

</body>
</html>