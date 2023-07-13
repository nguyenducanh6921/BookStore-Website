<?php
include 'db.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    # code...
    header('Location:login2.php');
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

        <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />




    
</head>

<body>
<?php include 'header.php'; ?>
<!-- tựa như carousel -->

<section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3>NEW RELEASE</h3>
            <p>Hot this <?= date('Y')?></p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

        <div class="swiper books-slider">
            <div class="swiper-wrapper">

               <?php  
                    $select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id` Desc LIMIT 3") or die('query failed');
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                                <form action="" method="post" class="box">
                                    <img class="image" src="uploaded_img/<?= $fetch_products['image'] ?>" alt="">

                                    <a href="#" class="swiper-slide">
                                        <input type="hidden" name="product_image" value="<?= $fetch_products['image'] ?>">
                                    </a>

                                </form>
                <?php
                        }
                    }else{
                        echo '<p class="empty">no products added yet!</p>';
                    }
                ?>

            </div>
            <img src="img/image/stand.png" class="stand" alt="">
        </div>

    </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id` Desc LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?= $fetch_products['image'] ?>" alt="">
        <div class="name"><?= $fetch_products['name'] ?></div>
        <div class="price"><?= $fetch_products['price'] ?> VND</div>
        <input type="number" min="1" name="product_quantity" value="1" class="qty">
        <input type="hidden" name="product_name" value="<?= $fetch_products['name'] ?>">
        <input type="hidden" name="product_price" value="<?= $fetch_products['price'] ?>">
        <input type="hidden" name="product_image" value="<?= $fetch_products['image'] ?>">
        <!-- check id -->
        <input type="submit" value="add to cart" name="add_to_cart" class="btn" id="add-to-cart" />
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>Hãy nêu trải nghiệm của bạn ở đây và chúng mình sẽ cùng nhau tạo nên một vườn sách tuyệt vời</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>


<?php include 'footer.php'; ?>


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>



</body>

</html>