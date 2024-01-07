<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Home</title>
  <link rel="stylesheet" href="checkout.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>


</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="umpsa-logo-new.jpeg" alt="">
          <span class="nav-item">FK KIOSK </span>
        </a></li>

        <li><a href="#">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>

        <li><a href="profile_page.php">
          <i class="fas fa-user"></i>
          <span class="nav-item">Profile</span>
        </a></li>

        <li><a href="">
          <i class="fas fa-wallet"></i>
          <span class="nav-item">Menu</span>
        </a></li>

        <li><a href="order.php">
          <i class="fas fa-chart-bar"></i>
          <span class="nav-item">Orders</span>
        </a></li>

        <li><a href="dashboard.php">
          <i class="fas fa-tasks"></i>
          <span class="nav-item">Dashboard</span>
        </a></li>

        <li><a href="webpage.php" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <div class="listCard">
        <!-- Displaying items in the cart -->
        <!-- Dummy data from app.js -->
        <div>
          <img src="image/1.PNG" alt="Product 1">
          <div>Product 1</div>
          <div>RM12</div>
          <!-- Quantity controls -->
          <div>
              <button onclick="changeQuantity(1, -1)">-</button>
              <div class="count">1</div>
              <button onclick="changeQuantity(1, 1)">+</button>
          </div>
        </div>
        <div>
          <img src="image/2.png" alt="Product 2">
          <div>Product 2</div>
          <div>RM20</div>
          <!-- Quantity controls -->
          <div class="quantity-control">
    <button onclick="changeQuantity(2, -1)">-</button>
    <div class="count">1</div>
    <button onclick="changeQuantity(2, 1)">+</button>
</div>

        </div>
        <!-- Repeat for other items -->
      </div>

      <div class="checkout-container">
  <div class="checkout-details">
    <!-- Total price and other details -->
    <div>Total Price: RM32</div>
    <div>User Points: 100</div>
    <button onclick="redeemPoints()">Redeem Points</button>
    <div>Final Price after Redeeming: RM 68</div>
    <button onclick="proceedToPayment()">Proceed to Payment</button>
  </div>
</div>
    </section>
  </div>


  <!-- Your script file -->
  <script src="app.js"></script>
</body>
</html></span>