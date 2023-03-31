<html>
<head>
	<title>Kaison Management System</title>

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="style-2.css">

</head>
<body>
    <?php
	//call file to connect sheader
	include ("admin-header.php");
	?>

	<?php
	//call file to connect server kaison
	include ("kaison-header.php");
    ?>

<section class="display-product-table">

<table>

   <thead>
      <th>Admin ID</th>
      <th>Admin name</th>
      <th>product Phone No</th>
      <th>Admin Email</th>
   </thead>

   <tbody>
   <?php
	$in= $_POST['adminName'];
	$in= mysqli_real_escape_string($connect, $in);
	
	//make the query
	$q= "SELECT adminID, adminPassword, adminName, adminPhoneNo, adminEmail FROM admin WHERE
		adminName='$in' ORDER BY adminID";
		
	//run the query and assign it to the variable $result
	$result= @mysqli_query($connect, $q);
    if ($result)
	{
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
    ?>

      <tr>
        <td><?php echo $row['adminID']; ?></td>
         <td><?php echo $row['adminName']; ?></td>
         <td><?php echo $row['adminPhoneNo']; ?></td>
         <td><?php echo $row['adminEmail']; ?></td>
         <td>
         <a href="admin.php?back=<?php echo $row['adminID']; ?>" class="option-btn"> Back </a>
      </tr>

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
      ?>
   </tbody>
</table>

</section>

</body>
</html>