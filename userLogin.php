<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="style-2.css">

</head>
<body> 

<?php 
//call file to connect server eleave 
 
include ("kaison-header.php"); 
?> 
 
<?php 
//This section processes submission from the login form 
//Check if the form has been submitted 
if($_SERVER['REQUEST_METHOD']=='POST') 
{ 
 //validate the userID 
 if (!empty($_POST['userName'])) 
  { 
  $n = mysqli_real_escape_string($connect, $_POST['userName']); 
 } 
 else 
 { 
  $n = FALSE; 
  echo '<p class = "error"> You forgot to enter your Name. </p>'; 
 } 
  
 //validate the adminPassword 
 if (!empty($_POST['userPassword'])) 
  { 
  $p = mysqli_real_escape_string($connect, $_POST['userPassword']); 
 } 
 else 
 { 
  $p = FALSE; 
  echo '<p class = "error"> You forgot to enter your password. </p>'; 
 } 
  
 //if no problems 
 if($n && $p) 
 { 
  //Retrieve the userID, userPassword, userName, userPhoneNo, userEmail,  
  //userAddress, userPosition, userTotalLeave, leaveID 
   
 $q = "SELECT userID, userPassword, userName, userEmail 
 FROM user WHERE (userName ='$n' AND userPassword ='$p')"; 
  
 //run the query and assign it to the variable $result 
 $result = mysqli_query ($connect, $q); 
  
 //count the number of rows that match the adminID/adminPassword combination 
 //if one database row (recod0 matches the input: 
 if (@mysqli_num_rows ($result) ==1) 
 { 
  //start the session, fetch the record and insert the three values in an array 
  session_start(); 
  $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC); 
  header('location:kaison.php');
   
  //Cancel the rest of the script 
  exit(); 
   
  mysqli_free_result($result); 
  mysqli_close($connect); 
  //no match was made 
 } 
 else 
 { 
  echo '<p class="error"> The userName and userPassword entered do not match our records 
  <br> perhaps you need to register, just click the Register button</p>'; 
 } 
  
 //if there was a problems 
 } 
 else 
 { 
  echo '<p class ="error"> Please try again.</p>'; 
 } 
  
 mysqli_close($connect); 
} 
//end of submit conditional 
?> 
 
 <div class="container">

    <section class="checkout-form">

<h1 class="heading"> User Login</h1> 
<form action="userLogin.php" method="post"> 

<div class="flex"> 
    <div class="inputBox">
        <span>User Name:</span>
        <input type="text" id="userName" name="userName" size="15" maxlength="60" required 
        value="<?php if (isset($_POST['userName'])) echo $_POST ['userName'];?>"> 
    </div> 

    <div class="inputBox">
        <span>Password:</span>
        <input type="password" id="userPassword" name="userPassword" size="15" maxlength="60" 
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required 
        value="<?php if (isset($_POST['userPassword'])) echo $_POST ['userPassword'];?>"> 
    </div> 

</div>
<input type="submit" value="Login" class="btn"> 
<input type="reset" value="Reset" class="btn">
 
<div> 
<label>Don't have an account? 
<a href="userRegister.php">Sign up</a> <br>
Confused? <a href="USER MANUAL.pdf">Click Here</a> <br>
If you're an admin <a href="kaisonLogin.php">Here</a>
</label> 
</div> 
</form> 

</body>
</html>