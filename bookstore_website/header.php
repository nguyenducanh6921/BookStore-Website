<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- material CND -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://www.facebook.com/duyanh0103/" class="fab fa-facebook-f"></a>
            <a href="https://www.instagram.com/duyanh.01.3.01/" class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/in/duy-anh-675615208/" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login2.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <div id="menu-select"></div>
         <a href="home.php" class="logo">DaNi<span>Book</span></a>

         <nav class="navbar">

            <a href="home.php">
               <span class="material-icons-sharp">home</span>
               <h2>Home</h2>
            </a>

            <a href="shop.php">
               <span class="material-icons-sharp">shopping_cart</span>
               <h2>Shop</h2>
            </a>

            <a href="contact.php">
               <span class="material-icons-sharp">contact_page</span>
               <h2>Contact</h2>
            </a>
            <a href="orders.php">
               <span class="material-icons-sharp">receipt_long</span>
               <h2>Orders</h2>
            </a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               // count dòng để tính tổng
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> 
               <span class="message-count"><?= $cart_rows_number ?></span> 
            </a>
         </div>

         <div class="user-box">
            <p>Username : <span><?= $_SESSION['user_name'] ?></span></p>
            <p>Email : <span><?= $_SESSION['user_email'] ?></span></p>
            <a href="logout.php" class="delete-btn">Logout</a>
         </div>
      </div>
   </div>

</header>