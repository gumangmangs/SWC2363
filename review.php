<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a review</title>

    
 <!-- font awesome cdn link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet" href="style-2.css">

</head>
<body>

<?php 
@include 'user-header.php'; 
?>

	<?php
	//call file to connect server eLeave
	include ("kaison-header.php");
	?>
	
	<?php
	//this query inserts a record in the eleave table
	//has form been submitted
	if($_SERVER['REQUEST_METHOD']== 'POST')
	{
		$error = array ();//initialize an error array
	
	//check for name
	if (empty($_POST ['name']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string($connect, trim($_POST ['name']));
	}

    //check for review
	if (empty($_POST ['yreview']))
	{
		$error [] = 'You forgot to enter your review.';
	}
	else
	{
		$r = mysqli_real_escape_string($connect, trim($_POST ['yreview']));
	}

    //check for review
	if (empty($_FILES ['image']))
	{
		$error [] = 'You forgot to enter your image.';
	}
	else
	{
		$i = mysqli_real_escape_string($connect, trim($_FILES ['image']));
	}
	
	//register the admin in the database
	//make the query:
	$q = "INSERT INTO review (ID, name, yreview, image)
		VALUES('', '$n', '$r', '$i')";
	$result = mysqli_query($connect, $q); //run the query
	if($result) //if it runs
	{
		header('location:kaison.php');
		exit();
	}
	else
	{
		//if tak run
		//message
		echo '<h1>System error<h1>';
		
		//debugging message
		echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
	} //end of it (result)
	mysqli_close($connect); //close the database connection_aborted
	exit();
	} // end of the main submit conditional
	?>


<div class="container">

<section class="checkout-form">
    <h1 class="heading"> Write your review now!</h1>
    <form action = "review.php" method = "POST">
    
    <div class="flex">
        <div class="inputBox">
            <span>Your Name:</span>
            <input type = "text" id = "name" name ="name" size = "15" maxlength = "60" 
            value = "<?php if (isset($_POST['name'])) echo $_POST['name'];?>"required>
        </div>

        <div class="inputBox">
            <span>Your review:</span>
            <input type = "text" id = "yreview" name ="yreview" size = "60" maxlength = "255" 
            value = "<?php if (isset($_POST['yreview'])) echo $_POST['yreview'];?>"required>
         </div>

         <div class="inputBox">
            <span>Your photo:</span>
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box"required>
         </div>
    </div>
    <input type="submit" value="Submit" class="btn"> 
    <input type="reset" value="Reset" class="btn">

<div>
    <label>Go back?
    <a href = "kaison.php">Back</a>
    </label>
</div>
</form>
</body>
</html>