<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style-2.css">
    
    <title>Admin Register</title>
</head>
<body>
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
	
	//check for a adminPassword
	if (empty ($_POST['adminPassword']))
	{
		$error [] = 'You forgot to the password.';
	}
	else
	{
		$p = mysqli_real_escape_string ($connect, trim($_POST['adminPassword']));
	}
	
	//check for adminName
	if (empty($_POST ['adminName']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string($connect, trim($_POST ['adminName']));
	}
	
	//check for a adminPhoneNo
	if (empty($_POST ['adminPhoneNo']))
	{
		$error [] = 'You forgot to enter your phone number.';
	}
	else
	{
		$ph = mysqli_real_escape_string($connect, trim($_POST ['adminPhoneNo']));
	}
	
	//check for adminEmail
	if (empty($_POST ['adminEmail']))
	{
		$error [] = 'You forgot to enter your email.';
	}
	else
	{
		$e = mysqli_real_escape_string($connect, trim($_POST ['adminEmail']));
	}
	
	//register the admin in the database
	//make the query:
	$q = "INSERT INTO admin (adminID, adminPassword, adminName, adminPhoneNo, adminEmail)
		VALUES('', '$p', '$n', '$ph', '$e')";
	$result = mysqli_query($connect, $q); //run the query
	if($result) //if it runs
	{
		header('location:kaisonLogin.php');
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
	<h1 class="heading">Register Admin</h1>
	<h4>*required field</h4>
	<form action = "adminRegister.php" method = "POST">
	<div class="flex">
		<div class="inputBox">
			<span>Password:</span> 
			<input type="password" id="adminPassword" name="adminPassword" size="15" maxlength="60" 
			pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required 
			value="<?php if (isset($_POST['adminPassword'])) echo $_POST ['adminPassword'];?>"> 
		</div>  
	
		<div class="inputBox">
			<span>Admin Name*:</span>
			<input type = "text" id = "adminName" name = "adminName" size = "30" maxlength = "50" required
			value = "<?php if (isset($_POST['adminName'])) echo $_POST ['adminName'];?>">
		</div>
	
		<div class="inputBox">
			<span>Phone No.*:</span>
			<input type = "tel" pattern = "[0-9]{3}-[0-9]{7}" id = "adminPhoneNo" name = "adminPhoneNo" 
			size = "15" maxlength = "20" required
			value =  "<?php if (isset($_POST['adminPhoneNo'])) echo $_POST ['adminPhoneNo'];?>">
		</div>
	
		<div class="inputBox">
			<span>Admin Email*:</span>
			<input type = "text" pattern = "[a-z0-9._%+-]+@[a-z-9.-]+\.[a-z]{2,}$"
			id = "adminEmail" name = "adminEmail" size = "30" maxlength = "50" required
			value = "<?php if (isset($_POST['adminEmail'])) echo $_POST ['adminEmail'];?>">
		</div>
	</div> 
	<input type="submit" value="Register" class="btn"> 
	<input type="reset" value="Reset" class="btn">
	</form>
</section>
	
</body>
</html>