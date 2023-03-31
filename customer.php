<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>

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
   $delete_query = mysqli_query($connect, "DELETE FROM `user` WHERE userID = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:customer.php');
      $message[] = 'user has been deleted';
   }else{
      header('location:customer.php');
      $message[] = 'user could not be deleted';
   };
};

if(isset($_POST['update_user'])){
    $update_c_id = $_POST['update_c_id'];
    $update_c_name = $_POST['update_c_name'];
    $update_c_email = $_POST['update_c_email'];
   
    $update_query = mysqli_query($connect, "UPDATE `user` SET userName = '$update_c_name', userEmail = '$update_c_email' WHERE userID= '$update_c_id'");
 
    if($update_query){
       $message[] = 'user updated succesfully';
       header('location:customer.php');
    }else{
       $message[] = 'user could not be updated';
       header('location:customer.php');
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

<form action="userFound.php" method="post">
	
	<h1>Search customer record</h1>
	<p><label class="label" for="userName">Customer Name:</label>
	<input id="userName" type="text" name="userName" size="30"
	maxlength="50" value="<?php if (isset($_POST['userName']))
		echo $_POST ['userName']; ?>"/></p>
	
	<input id="submit" type="submit" name="submit" value="search"/></p>
	</form>

<section class="display-product-table">

   <table>

      <thead>
         <th>User ID</th>
         <th>User name </th>
         <th> User Email</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $select_user = mysqli_query($connect, "SELECT * FROM `user`");
            if(mysqli_num_rows($select_user) > 0){
               while($row = mysqli_fetch_assoc($select_user)){
         ?>

         <tr>
            <td><?php echo $row['userID']; ?></td>
            <td><?php echo $row['userName']; ?></td>
            <td><?php echo $row['userEmail']; ?></td>
            <td>
               <a href="customer.php?delete=<?php echo $row['userID']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="customer.php?edit=<?php echo $row['userID']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no user added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($connect, "SELECT * FROM `user` WHERE userID = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" class="box" name="update_c_id" value="<?php echo $fetch_edit['userID']; ?>">
      <input type="text" class="box" required name="update_c_name" value="<?php echo $fetch_edit['userName']; ?>">
      <input type="text" class="box" required name="update_c_email" value="<?php echo $fetch_edit['userEmail']; ?>">
      <input type="submit" value="update the user" name="update_user" class="btn">
      <a href="customer.php"><input type="reset" value="cancel" id="close-edit" class="option-btn"></a>
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