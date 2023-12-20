<!DOCTYPE html>
<html>
<head>
    <title>Homepage Food Kiosk System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="homepage.css"> <!-- Include your style.css here -->
</head>
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Close Menu</a>
    <a href="#Home" onclick="w3_close()" class="w3-bar-item w3-button">Home</a>
    <a href="#menu" onclick="w3_close()" class="w3-bar-item w3-button">Menu</a>
    <a href="#orders" onclick="w3_close()" class="w3-bar-item w3-button">Orders</a>
    <a href="#dashboard" onclick="w3_close()" class="w3-bar-item w3-button">Dashboard</a>
    <br><br><br><br><br>
    <a href="webpage.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
    <div class="w3-white w3-xlarge" style="max: width 1000px;px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
        <div class="w3-right w3-padding-16">username</div>
        <div class="w3-center w3-padding-16">FK Food Kiosk</div>
    </div>
</div>
  
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <!-- Rest of your content remains unchanged -->
    <!-- ... -->
</div>

<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
</script>

</body>
</html>
