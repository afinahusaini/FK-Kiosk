<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
      elseif($row['user_type'] == 'foodVendor'){

      $_SESSION['user_name'] = $row['name'];
      header('location:foodVendor_page.php');
      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
  
   <!-- custom css file link  -->
   <link rel="stylesheet" href="login.css">

</head>
<body>
<style>
   body {
   margin: 0;
   padding: 0;
   /* Optionally set styles for the body */
}
   .form-container {
   background-image: url('umplawo_0.jpg'); /* Replace 'umplawo_0.jpg' with your image path */
   background-size: cover;
   background-position: center;
}
   </style>


<div class="form-container">

   <form action="" method="post">
      <h3>FACULTY OF COMPUTING FOOD KIOSK SYSTEM</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <select name="user_type">
         <option value="user">Student</option>
         <option value="user">Staff</option>
         <option value="admin">Admin</option>
         <option value="foodVendor">Food Vendor</option>

      </select>
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="sign_up.php">sign up</a></p>
   </form>

</div>

</body>
</html>