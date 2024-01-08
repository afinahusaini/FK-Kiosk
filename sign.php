<?php
session_start();
require_once 'config.php'; // Database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $userType = $_POST['user_type'];

    if ($password === $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $registrationStatus = ($userType === "food_vendor") ? "pending" : "approved";
    
        $sql = "INSERT INTO User (username, email, password, user_type, registration_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $email, $hashedPassword, $userType, $registrationStatus]);
    
        $userId = $conn->lastInsertId(); // Get the user ID
    
        if ($userType === 'food_vendor' && $registrationStatus === 'approved') {
            $qrFilePath = generateQRCode($userId, $userType); // Generate QR code for the food vendor
            // Update the user record with the QR code file path
            $updateSql = "UPDATE User SET qr_code_path = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->execute([$qrFilePath, $userId]);
        }
    
        $_SESSION['id'] = $username;
        header("Location: login.php");
        exit();
    }
}
    
function generateQRCode($userId, $userType) {
    $qrText = "User ID: " . $userId . ", Type: " . $userType;
    $qrFilePath = 'qr_codes/user_' . $userId . '.png';
    QRcode::png($qrText, $qrFilePath);
    return $qrFilePath;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign Up</title>

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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <h3>SIGN UP</h3>
        <input type="text" name="username" required placeholder="Enter your username">
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="password" name="confirm_password" required placeholder="Confirm your password">
        <select name="user_type">
            <option value="student">Student</option>
            <option value="staff">Staff</option>
            <option value="food_vendor">Food Vendor</option>
        </select>
        <input type="submit" name="submit" value="Register now" class="form-btn">
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </form>
</div>

</body>
</html>
