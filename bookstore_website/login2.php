<?php
   include('db.php');
    session_start();
   if (isset($_POST['submit'])) {
      # code...

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, md5($_POST['password']));  
      $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'  AND password = '$pass'") or die('Query failed');
      //check num row
      if (mysqli_num_rows($select_user) > 0) {
         # tồn tại
         $row = mysqli_fetch_assoc($select_user);
         if ($row['user_type'] == 'admin') {
             # code...
             $_SESSION['admin_name'] = $row['name'];
             $_SESSION['admin_email'] = $row['email'];
             $_SESSION['admin_id'] = $row['id'];
             //chuyển qua admin page
            header('Location: admin_page.php');
         }elseif ($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name']; 
            $_SESSION['user_email'] = $row['email']; 
            $_SESSION['user_id'] = $row['id']; 
            //chuyển qua user page
            header('Location: home.php');
         }
      }   
      else {
        $message[] = 'invalid email or password';
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/styleLogin.css">

    
</head>
<body>

<!-- Display message! -->

<?php
   if (isset($message)) {
      foreach ($message as $message) {
         
      ?>
         <div class="message">
            <span><?=$message?></span>
                                                   <!-- dấu x -->
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i> 
         </div>
      <?php        
      }
   }
?>

    <section class="Form my-4 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <img src="img/image/JujutsukaisenVol0.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <div>
                        <h1 class="font-weight-bold py-3">Log<span class="danger" >in </span></h1>
                    </div>

                    <!-- Form login -->
                    <form method="post" id="myform" action="">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input id="email" type="email" placeholder="Email-address" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7">
                                <input id="pwd" type="password" placeholder="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-row mt-3 mb-5">
                            <div class="col-lg-7">
                                <input type="submit" name="submit" value="Login" class="btn1">
                            </div>
                        </div>
                        <a href="#">Forgot password</a>

                        <p>Don't have any account? <a href="register.php">Register here</a></p>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>

    <script>

    </script>
</body>
</html>