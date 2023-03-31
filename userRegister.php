<html>
<head>
	<title>User Register Page</title>

     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
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
	
	//check for a userPasswordPassword
	if (empty ($_POST['userPassword']))
	{
		$error [] = 'You forgot to the password.';
	}
	else
	{
		$p = mysqli_real_escape_string ($connect, trim($_POST['userPassword']));
	}
	
	//check for userName
	if (empty($_POST ['userName']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string($connect, trim($_POST ['userName']));
	}
	
	//check for userEmail
	if (empty($_POST ['userEmail']))
	{
		$error [] = 'You forgot to enter your email.';
	}
	else
	{
		$e = mysqli_real_escape_string($connect, trim($_POST ['userEmail']));
	}
	
	//register the admin in the database
	//make the query:
	$q = "INSERT INTO user (userID, userPassword, userName, userEmail)
		VALUES('', '$p', '$n', '$e')";
	$result = mysqli_query($connect, $q); //run the query
	if($result) //if it runs
	{
		header('location:userLogin.php');
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
	<h1 class="heading">Register User</h1>
	<h4>*required field</h4>
	<form action = "userRegister.php" method = "POST">

	<div class="flex">
		<div class="inputBox">
			<span>Password:</span> 
			<input type="password" id="userPassword" name="userPassword" size="15" maxlength="60" 
			pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required 
			value="<?php if (isset($_POST['userPassword'])) echo $_POST ['userPassword'];?>"> 
		</div>  
	
		<div class="inputBox">
			<span>Name*:</span>
			<input type = "text" id = "userName" name = "userName" size = "30" maxlength = "50" required
			value = "<?php if (isset($_POST['userName'])) echo $_POST ['userName'];?>">
		</div>
	
		<div class="inputBox">
			<span>Email*:</span>
			<input type = "text" pattern = "[a-z0-9._%+-]+@[a-z-9.-]+\.[a-z]{2,}$"
			id = "userEmail" name = "userEmail" size = "30" maxlength = "50" required
			value = "<?php if (isset($_POST['userEmail'])) echo $_POST ['userEmail'];?>">
		</div>
	
	</div>
	<input type="submit" value="Register" class="btn"> 
	<input type="reset" value="Reset" class="btn">
	</form>
</section>

</body>
</html>
	
		
		
	
	
		
		
	