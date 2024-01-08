<?php
session_start();

$invalidCredentials = false; // Initialize variable to track invalid credentials
$pendingApproval = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "config.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Modify this query to match your 'User' table
    $sql = "SELECT * FROM User WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['registration_status'] === 'approved') {
            $_SESSION['id'] = $user['id'];

            switch ($user['user_type']) {
                case 'student':
                    header("Location: index_student.php");
                    exit();
                case 'staff':
                    header("Location: index_staff.php");
                    exit();
                case 'foodVendor':
                    header("Location: index_foodvendor.php");
                    exit();
                case 'administrator':
                    header("Location: index_admin.php");
                    exit();
                default:
                    // Redirect to a default page for unknown user types
                    header("Location: index.php");
                    exit();
            }
        } else {
            $pendingApproval = true;
        }
    } else {
        $invalidCredentials = true;
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
      <input type="text" name="username" required placeholder="enter your username"> <!-- Changed to 'text' type -->
    <input type="password" name="password" required placeholder="enter your password">
    <select name="user_type">
        <option value="student">Student</option>
        <option value="staff">Staff</option>
        <option value="admin">Admin</option>
        <option value="foodVendor">Food Vendor</option>
    </select>
    <input type="submit" name="submit" value="login now" class="form-btn">
    <p>Don't have an account? <a href="sign.php">sign up</a></p>
</form>

</div>
<<script>
    // JavaScript to display alerts based on conditions
    <?php if ($invalidCredentials): ?>
        alert("Invalid credentials. Please try again.");
    <?php elseif ($pendingApproval): ?>
        alert("Your registration is pending approval.");
    <?php endif; ?>
</script>

</body>
</html>
