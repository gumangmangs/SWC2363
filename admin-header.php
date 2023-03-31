<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="style-admin.css">

</head>
<body>
      <header class="header">

   <div class="flex">

      <a href="#" class="logo">KAISON MANAGEMENT SYSTEM</a>

      <nav class="navbar">
      <a href="admin.php">Admin Details </a>
      <a href="product-test.php">Product Details</a>
      <a href="customer.php">Customer Details</a>
      <a href="kaison.php">Logout</a> 
    </nav>

      <?php
      
      @include 'kaison-header.php';
      
      $select_rows = mysqli_query($connect, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>
    </div>

</header>

</body>
</html>