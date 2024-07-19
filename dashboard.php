<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

</head>
<body>
<!-- header section starts  -->
<?php include 'admin_header.php'; ?>
<!-- admin panel starts  -->

<section class="menu" id="menu">
    <div class="heading1">
          <h1>ADMIN PANEL</h1>
    </div>

   <div class="container box-container">

     <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE status IN ('Pending','Approved', 'Out for Delivery', 'Preparing your Order') ");
         $select_pendings->execute();
         $total_pendings = $select_pendings->rowCount()
      ?>
      <h1><?= $total_pendings; ?></h1>
      <h3>Total Orders</h3>
      <a href="admin_orders.php" class="link-btn">View Orders</a>
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE status = ?");
         $select_completed->execute(['Completed']);
         $total_completed = $select_completed->rowCount();

      ?>
      <h1><?= $total_completed; ?></h1>
      <h3>Total Completed</h3>
      <a href="c_orders.php" class="link-btn">View Orders</a>
      </div>

      


      <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
      ?>
      <h1><?= $number_of_products; ?></h1>
      <h3>Products Added</h3>
      <a href="products.php" class="link-btn">View Products</a>
      </div>


         <div class="box">
         <?php
         $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_users->execute(['user']);
         $number_of_users = $select_users->rowCount();
      ?>
         <h1><?= $number_of_users; ?></h1>
         <h3>Total Users</h3>
         <a href="users.php" class="link-btn"> Users</a>
      </div>


       <div class="box">
         <?php
         $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_users->execute(['admin']);
         $number_of_users = $select_users->rowCount();
      ?>
         <h1><?= $number_of_users; ?></h1>
         <h3>Total Admin</h3>
         <a href="admin.php" class="link-btn">View Admin</a>
      </div>

        
       <div class="box">
        <?php
         $select_messages = $conn->prepare("SELECT * FROM `message`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
      ?>
         <h1><?= $number_of_messages; ?></h1>
         <h3>Total Messages</h3>
         <a href="admin_contacts.php" class="link-btn">View Messages</a>
      </div>

      </div>

</section>

<!-- admin panel section ends -->


<!-- custom js file link  -->
<!-- custom js file link  -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/admin_script.js"></script>

</body>
</html>