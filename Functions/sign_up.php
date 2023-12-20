<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

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
   background-image: url('umplawo_0.jpg'); /* Replace 'path_to_your_image.jpg' with your image path */
   background-size: cover;
   background-position: center;
   /* Other styles for your form container */
}
   </style>

<div class="form-container">

   <form action="" method="post">
      <h3>SIGN UP</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">Student</option>
         <option value="user">Staff</option>
         <option value="admin">Admin</option>
         <option value="foodVendor">Food Vendor</option>

      </select>
      
      <input type="submit" name="submit" value="register now" class="form-btn" href="webpage.php" class="btn"></a>
      <p>already have an account? <a href="webpage.php">login now</a></p>
   </form>

</div>

</body>
</html>

<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(id,name, email, password, user_type) VALUES('','$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:webpage_form.php');
      }
   }

};


?>