<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


if(isset($_POST['update_order'])){

$order_id = $_POST['order_id'];
$received = $_POST['received'];
$received = filter_var($received, FILTER_SANITIZE_STRING);
$update_order = $conn->prepare("UPDATE `orders` SET status = ? WHERE id = ?");
$update_order->execute([$received, $order_id]);
$message[] = 'Order has been received!';

};

if(isset($_GET['delete'])){

  $delete_id = $_GET['delete'];
  $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
  $delete_orders->execute([$delete_id]);
  header('location:orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Placed Orders - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

</head>
<body>

<button onclick="topFunction()" class="myBtn" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>    

<!-- header section starts  -->

<?php include 'header.php'; ?>

<!-- header section ends -->

<div class="icons-bc" id="icons-bc">
    <ul class="icons-breadcrumb">
      <li><a href="home.php">Home</a></li>
      <li>Placed Orders</li>
    </ul>
</div>

<!-- orders section starts  -->

<section class="placed-orders"> 
  
  <div class="row">
    <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY id DESC");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
        while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
    ?>
    <form class="col-lg-6 box" action="" method="POST">
      <div class="container">
        
        <div class="head os">Orders:
          <span class="info o"><?= $fetch_orders['total_products']; ?></span>
        </div>

        <hr style="margin: 0 2%;">

        <div class="head">Placed on:
          <span class="info po"><?= $fetch_orders['placed_on']; ?></span>
        </div>
        
        <div class="head address">Address:
          <span class="info add"><?= $fetch_orders['address']; ?></span>
        </div>

        <div class="head">Payment method:
          <span class="info pm"><?= $fetch_orders['method']; ?></span>
        </div>

        <div class="head">Total payment:
          <span class="info tp">₱<?= $fetch_orders['total_price']; ?>.00</span>
        </div>

        <div class="head os-head" style="color:#fff;">
          <span class="info os" style="color:<?php if($fetch_orders['status'] == 'Pending'){ 
            echo '#e3b04b';
          } else if ($fetch_orders['status'] == 'Approved') {
            echo '#e3b04b';
          } else if ($fetch_orders['status'] == 'Preparing your Order') {
            echo '#e3b04b';
          } else if ($fetch_orders['status'] == 'Out for Delivery') {
            echo '#e3b04b'; 
          } else if ($fetch_orders['status'] == 'Completed') {
            echo '#e3b04b'; 
          }; 
          ?>"><?= $fetch_orders['status']; ?></span>
        </div>

        <div class="flex-btn">
          <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
          <input type="hidden" name="received" value="Completed">

          <?php if ($fetch_orders['status'] == 'Out for Delivery') {
            echo '<input type="submit" value="Order Received" class="btn" name="update_order">';  
          } else if ($fetch_orders['status'] == 'Completed') {
            echo '<a href="orders.php?delete='.$fetch_orders['id'].'" onclick=return confirm(\'Delete this order?\');" class="btn">Delete</a>';
          } else if ($fetch_orders['status'] == 'Approved') {
            echo '<div class=text>Your order has been approved.</div>';
          } else if ($fetch_orders['status'] == 'Pending') {
            echo '<a href="orders.php?delete='.$fetch_orders['id'].'" onclick=return confirm(\'Are you sure you want to cancel your order?\');" class="btn">Cancel Order</a>';
          } else if ($fetch_orders['status'] == 'Preparing your Order') {
            echo '<div class="text">Please wait until your order is ready.</div>';
          }
          ?>         
        </div>

      </div>
    </form>
    <?php
      }
    }else{
      echo '<h6 class="empty">No orders placed yet!<br><br><span class="caption">Our products are top of the line and sure to exceed your expectations.
      Order now and get your products delivered straight to your door.</span></h6></p>
      ';
    }
    ?>
  </div>

</section>

<!-- orders section ends -->

<!-- footer section starts  -->

<?php include 'footer.php'; ?>

<!-- footer section ends -->

<script>
  const mybutton = document.querySelector(".myBtn");

  window.onscroll = function() {scrollFunction()};
  
  function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	  mybutton.style.display = "block";
	} else {
	  mybutton.style.display = "none";
	}
  }
  
  function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
  }
</script>

<!-- custom js file link  -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

</body>
</html>