!--> takda apa pun file ni kosong je actually 

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "config.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    //$sql = "SELECT * FROM administrator WHERE email = ?";
    //$stmt = $conn->prepare($sql);
   // $stmt->execute([$email]);
    
    if ($sql = "SELECT * FROM administrator WHERE email = ?"){
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
    }elseif($sql = "SELECT * FROM user WHERE email = ?"){
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
    }else{
        $sql = "SELECT * FROM foodvendor WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
    }

    //$sql = "SELECT * FROM $user_type WHERE email = ?";
    //$stmt = $conn->prepare($sql);
    //$stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];

        if ($user_type === "student" || $user_type === "staff") {
            header("Location: index_user.php");
            exit();
        } elseif ($user_type === "foodVendor" && $user['approval'] === "approved") {
            header("Location: index_vendor.php");
            exit();
        } elseif ($user_type === "admin") {
            header("Location: index_admin.php");
            exit();
        }
    } else {
        echo "Invalid credentials. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log In</title>
  
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

   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
         <option value="student">Student</option>
         <option value="staff">Staff</option>
         <option value="admin">Admin</option>
         <option value="foodVendor">Food Vendor</option>
      </select>
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="sign.php">sign up</a></p>
   </form>

</div>

</body>
</html>
