<?php

include 'db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login2.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];                                        
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         
         <p> User ID : <span><?= $fetch_orders['user_id'] ?></span> </p>
         <p> Placed On : <span><?= $fetch_orders['placed_on'] ?></span> </p>
         <p> Name : <span><?=$fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?= $fetch_orders['number'] ?></span> </p>
         <p> Email : <span><?= $fetch_orders['email'] ?></span> </p>
         <p> Address : <span><?= $fetch_orders['address'] ?></span> </p>
         <p> Total Products : <span><?= $fetch_orders['total_products'] ?></span> </p>
         <p> Total Price : <span><?= $fetch_orders['total_price'] ?> VND</span> </p>
         <p> Payment Method : <span><?= $fetch_orders['method'] ?></span> </p>

         <!-- Update -->
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id'] ?>">
            <select name="update_payment">
               <!-- chọn cái default và disabled cho đến khi chọn cái khác nó -->
               <option value="" selected disabled><?= $fetch_orders['payment_status'] ?></option>
               <option value="pending">Pending</option>
               <option value="completed">Completed</option>
            </select>
            <input type="submit" value="update" name="update_order" class="option-btn">
            <!-- method del above : khi bấm xuất hiện alert confirm-->
            <a href="admin_orders.php?delete=<?= $fetch_orders['id'] ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
         </form>
      </div>
      <?php
      }
      
   }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>