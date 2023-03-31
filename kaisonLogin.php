<html> 
<head> 
<title>Kaison Login Page</title> 

 <!-- font awesome cdn link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet" href="style-2.css">

</head> 
<body> 
<html>
<head>
	<title>Admin Login Page</title>
</head>
<body>

	<?php
	// call file to connect server eleave
	include ("kaison-header.php");
	?>
	
	<?php
	//this section processes submission from the login form
	//check if the form has been submitted
	if ($_SERVER['REQUEST_METHOD']== 'POST')
	{
	
	//validate the adminID
	if (!empty($_POST['adminName']))
	{
		$n = mysqli_real_escape_string($connect, $_POST['adminName']);
	}
	else
	{
		$n = FALSE;
		echo '<p class = "error"> You forgot to enter your Name.</p>';
	}
	
	
		//valide the adminPassword
		if (!empty($_POST['adminPassword']))
		{
			$p = mysqli_real_escape_string($connect, $_POST['adminPassword']);
		}
		else
		{
			$p = FALSE;
			echo '<p class = "error"> You forgor to enter your password.</p>';
		}
		
			//if no problems
			if ($n && $p)
			{
				//retrieve the adminID, adminPassword, adminName, adminPhoneNo, adminEmail
				$q = "SELECT adminID, adminPassword, adminName, adminPhoneNo, adminEmail FROM admin WHERE (adminName = '$n' AND adminPassword = '$p')";
				
				//run the query and assign it to the variable $result
				$result = mysqli_query ($connect, $q);
				
				//count the number of rows that match the adminID/adminPassword combination
				//if one database row (record) matches the input;
				if (mysqli_num_rows ($result) == 1 )
				{
					//start the session, fetch the record and insert the three values in an array
					session_start();
					$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
					header('location:admin.php');
					
					//cancel the rest of the script
					exit();
					mysqli_free_result($result);
					mysqli_close ($connect);
					// no match was made
					
				}
				else
				{
					echo '<p class ="error"> The adminName and adminPassword entered do not match our records
					<br> perhaps you need to register, just click the Register button</p>';
					
				}
			//if there was a problems
			}
			else
			{
				echo '<p class = "error"> Please try again. </p>';
			}
			
			mysqli_close($connect);
			}//end of subit conditional
			
			?>

		<div class="container">

		<section class="checkout-form">
			<h1 class="heading"> ADMIN LOGIN</h1>
			<form action = "kaisonLogin.php" method = "post">
			
			<div class="flex">
				<div class="inputBox">
					<span>Admin Name:</span>
					<input type = "text" id = "adminName" name ="adminName" size = "15" maxlength = "60" 
					value = "<?php if (isset($_POST['adminName'])) echo $_POST['adminName'];?>">
				</div>
		
				<div class="inputBox">
					<span>Password:</span>
					<input type = "password" id = "adminPassword" name = "adminPassword" size = "15" maxlength = "60"
					pattern = "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title = "Must contain at least one number and one 
					uppercase and lowercase letter, and at least 8 or more characters" required 
					value ="<?php if (isset($_POST['adminPassword'])) echo $_POST['adminPassword'];?>">
				</div>
			</div>
			<input type="submit" value="Login" class="btn"> 
			<input type="reset" value="Reset" class="btn">
		
		<div>
			<label>Dont have an account?
			<a href = "adminRegister.php">Sign Up</a><br>
			Confused? <a href="USER MANUAL (admin).pdf">Click Here</a> <br>
			</label>
		</div>
		</form>
</body> 
</html>