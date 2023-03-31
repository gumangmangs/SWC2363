<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>

	<!-- font awesome cdn link  -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<!-- custom css file link  -->
	<link rel="stylesheet" href="style-2.css">

</head>
<body>

<?php
    @include 'admin-header.php'; 
?>

<?php

@include 'kaison-header.php';

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($connect, "DELETE FROM `admin` WHERE adminID = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'admin has been deleted';
   }else{
      header('location:kaison-test.php');
      $message[] = 'admin could not be deleted';
   };
};

if(isset($_POST['update_admin'])){
   $update_ad_id = $_POST['update_ad_id'];
   $update_ad_name = $_POST['update_ad_name'];
   $update_ad_ph = $_POST['update_ad_ph'];
   $update_ad_email = $_POST['update_ad_email'];

   $update_query = ("UPDATE admin SET adminName = '$update_ad_name', adminPhoneNo = '$update_ad_ph', adminEmail = '$update_ad_email' WHERE adminID= '$update_ad_id'");
   $run = mysqli_query($connect,$update_query);
if($run==true){
       $message[] = 'admin updated succesfully';
       header('location:admin.php');
    }else{
       $message[] = 'admin could not be updated';
       header('location:admin.php');
    }
 
 }

 ?>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};


?>

<?php include 'kaison-header.php'; ?>

<div class="container">

<form action="adminFound.php" method="post">
	
	<h1>Search admin record</h1>
	<p><label class="label" for="adminName">Admin Name:</label>
	<input id="adminName" type="text" name="adminName" size="30"
	maxlength="50" value="<?php if (isset($_POST['adminName']))
		echo $_POST ['adminName']; ?>"/></p>
	
	<input id="submit" type="submit" name="submit" value="search"/></p>
	</form>

<section class="display-product-table">

   <table>

      <thead>
         <th>Admin ID</th>
         <th>Admin name </th>
         <th>Admin Phone No </th>
         <th>Admin Email</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_admin = mysqli_query($connect, "SELECT * FROM admin");
            if(mysqli_num_rows($select_admin) > 0){
               while($row = mysqli_fetch_assoc($select_admin)){
         ?>

         <tr>
            <td><?php echo $row['adminID']; ?></td>
            <td><?php echo $row['adminName']; ?></td>
            <td><?php echo $row['adminPhoneNo']; ?></td>
            <td><?php echo $row['adminEmail']; ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['adminID']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['adminID']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($connect, "SELECT * FROM admin WHERE adminID = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="admin.php" method="post" enctype="multipart/form-data">
      <input type="hidden" class="box" name="update_ad_id" value="<?php echo $fetch_edit['adminID']; ?>">
      <input type="text" class="box" required name="update_ad_name" value="<?php echo $fetch_edit['adminName']; ?>">
      <input type="text" class="box" required name="update_ad_ph" value="<?php echo $fetch_edit['adminPhoneNo']; ?>">
      <input type="text" class="box" required name="update_ad_email" value="<?php echo $fetch_edit['adminEmail']; ?>">
      <input type="submit" value="update the admin" name="update_admin" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>

<!--footer section-->
<div class="footer">
    
<p>© COPYRIGHT 2023 KAISON ALL RIGHT RESERVED</p>
         
</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>