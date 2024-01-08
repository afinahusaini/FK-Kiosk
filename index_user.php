<?php
    try {
        session_start();
        require "config.php";
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: log_in.php");
            exit();
        }
        if (!isset($_SESSION['name'])) {
            header("Location: log_in.php");
            exit();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <form>
        <button type="submit" formaction="<?php echo $_SERVER['PHP_SELF'] ?>" formmethod="post" name="logout" class="btn btn-primary">Log Out</button>
    </form>
</body>
</html>
