<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>
   <link rel="stylesheet" href="login.css">
</head>
<body>
   <div class="form-container">
      <form action="register.php" method="post">
         <h3>SIGN UP</h3>
         <input type="text" name="username" required placeholder="Enter your username">
         <input type="text" name="name" required placeholder="Enter your name">
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="password" name="cpassword" required placeholder="Confirm your password">
         <input type="tel" name="phone" required placeholder="Enter your phone number">
         <select name="user_type">
            <option value="Student">Student</option>
            <option value="Staff">Staff</option>
            <option value="Food Vendor">Food Vendor</option>
         </select>
         <input type="submit" name="submit" value="Register now" class="form-btn">
         <p>Already have an account? <a href="webpage.php">Login now</a></p>
      </form>

      <?php
// Include database configuration and necessary libraries
@include 'config.php';
require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = $_POST['user_type'];
    $phone = $_POST['phone'];

    // Generate a unique card membership ID using UUID
    $membership_id = Uuid::uuid4()->toString(); // Generate a unique ID

    // Set the initial point balance to 0
    $points = 0;

    // Check if the user already exists
    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user data into the database
        $insert = "INSERT INTO user_form (username, name, email, password, user_type, phone, membership_id, points) 
                   VALUES ('$username', '$name', '$email', '$hashed_password', '$user_type', '$phone', '$membership_id', '$points')";
        mysqli_query($conn, $insert);

        // Registration successful
        echo '<script>
                alert("Registration successful! Your membership ID is: ' . $membership_id . '");
                window.location.href = "login.php"; // Redirect to login page
              </script>';
    }
}
?>


   </div>
</body>
</html>
