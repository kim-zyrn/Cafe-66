<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
};

if(isset($_POST['order'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $method = $_POST['method'];
  $method = filter_var($method, FILTER_SANITIZE_STRING);
  $address = ''. $_POST['landmark'] .','. $_POST['street'] .','. $_POST['barangay'] .','. $_POST['city'] .','. $_POST['province'] .','. $_POST['country'];
  $address = filter_var($address, FILTER_SANITIZE_STRING);
  $status = ''. $_POST['status'];
  $status = filter_var($status, FILTER_SANITIZE_STRING);
  $placed_on = date('d-M-Y');
 
  $cart_total = 0;
  $cart_products[] = '';

  $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
  $cart_query->execute([$user_id]);
  if($cart_query->rowCount() > 0){
    while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
      $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
      $sub_total = ($cart_item['price'] * $cart_item['quantity']);
      $cart_total += $sub_total;
    };
  };
 
  $total_products = implode('', $cart_products);
 
  $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
  $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);
 
  if($cart_total == 0){
    header('location:cart.php');
  }elseif($order_query->rowCount() > 0){
    $message[] = 'Order placed already!';
  }else{
    $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, status) VALUES(?,?,?,?,?,?,?,?,?,?)");
    $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on, $status]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$user_id]);
    $message[] = 'Order placed successfully!';
    header('location:cart.php');
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Cafe 66</title>
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

  <style>
    .message {
      gap: 75%;
    }
    @media screen and (max-width: 767px) {
      .message {
        gap: 65%;
      }
    }
  </style>

</head>
<body>

<button onclick="topFunction()" class="myBtn" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>    

<!-- header section starts  -->

<?php include 'header.php'; ?>

<!-- header section ends -->

<div class="icons-bc" id="icons-bc">
  <ul class="icons-breadcrumb">
    <li><a href="cart.php">Cart</a></li>
    <li>Checkout</li>
  </ul>
</div>

<section class="checkout_page">
  <div class="row">

    <div class="col-lg-4 display-orders">
      <div class="cart-side">
        <?php
        $total_num = 0;
        $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $select_cart_items->execute([$user_id]);
        if($select_cart_items->rowCount() > 0){
          while ($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
            $item_num = $fetch_cart_items['quantity'];
            $total_num += $item_num;
          }
        }
        ?>
        <h1 class="">Cart
          <div class="cart-num" style="color:black">
            <i class="bi bi-cart-fill"></i>
            <span class="num"><?= $total_num; ?></span>
          </div>
        </h1>
        
        <?php
          $total_num = 0;
          $cart_grand_total = 0;
          $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
          $select_cart_items->execute([$user_id]);
          if($select_cart_items->rowCount() > 0){
            while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
              $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
              $cart_grand_total += $cart_total_price;
              $item_num = $fetch_cart_items['quantity'];
              $total_num += $item_num;
        ?>
        <div class="items">
          <p class="cart-p"> <?= $fetch_cart_items['name']; ?> <span>( <?= '₱'.$fetch_cart_items['price'].'.00 x '. $fetch_cart_items['quantity']; ?> )</span></p>
        </div>
        <?php
        }
        }else{
          echo '<p class="empty">Your cart is empty!</p>';
        }
        ?>
        <div class="subtotal">Total: <div class="span">₱<?= $cart_grand_total; ?>.00</div></div>
        <?php       
          if ($total_num >= 3 ) {
            echo '<div class="shipping">Shipping Fee: <div class="span">₱20.00</div></div>';
          } else if ($total_num < 3 ) {
            echo '<div class="shipping">Shipping Fee: <div class="span">₱30.00</div></div>';
          } else if ($total_num < 1 ) {
            echo '<div class="shipping">Shipping Fee: <div class="span">₱0.00</div></div>';
          }
        ?>
        <hr>
        <?php       
          if ($total_num >= 3 ) {
            echo '<div class="grand-total">Grand Total: <div class="span">₱'.($cart_grand_total + 20).'.00</div></div>';
          } else if ($total_num < 3 ) {
            echo '<div class="grand-total">Grand Total: <div class="span">₱'.($cart_grand_total + 30).'.00</div></div>';
          }
        ?>
        </div>
      </div>

    <div class="col-lg-8 checkout-orders">
      <form action="" method="POST">
        <h3>Checkout details</h3>

        <div class="flex">

          <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" placeholder="Full name" class="box" required>
          </div>
          <div class="inputBox">
            <span>Number:</span>
            <input type="number" name="number" placeholder="(+63) 9** **** ***" class="box" required>
          </div>
          <div class="inputBox">
            <span>Email:</span>
            <input type="email" name="email" placeholder="example.domain.com" class="box" required>
          </div>
          <div class="inputBox">
            <span>Payment method:</span>
            <input type="text" value="Cash on delivery" class="box" disabled required>
            <input type="hidden" name="method" value="Cash on delivery">
          </div>
          <div class="inputBox">
            <span>Landmark:</span>
            <input type="text" name="landmark" placeholder="ex: Barangay Hall, Store, etc." class="box">
          </div>
          <div class="inputBox">
            <span>Street name / Purok:</span>
            <input type="text" name="street" placeholder="Hernandez St., Purok 4" class="box" required>
          </div>
          <div class="inputBox">
            <span>Barangay:  <span class="note">(Delivery address is limited to few barangays only)</span></span>
            <select name="barangay" id="barangay" class="box">
              <option value="Bororan">Bororan</option>
              <option value="Central">Central</option>
              <option value="Dancalan">Dancalan</option>
              <option value="Ogod">Ogod</option>
              <option value="Poso Poblacion">Poso Poblacion</option>
              <option value="Punta Waling Waling">Punta Waling Waling</option>
              <option value="Rawis">Rawis</option>
              <option value="Tres Marias">Tres Marias</option>
              <option value="Tupas">Tupas</option>
            </select>
          </div>
          <div class="inputBox">
            <span>City:</span>
            <input type="text" value="Donsol" class="box" disabled required>
            <input type="hidden" name="city" value="Donsol">
          </div>
          <div class="inputBox">
            <span>Province:</span>
            <input type="text" value="Sorsogon" class="box" disabled required>
            <input type="hidden" name="province" value="Sorsogon">
          </div>
          <div class="inputBox">
            <span>Country:</span>
            <input type="text" value="Philippines" class="box" disabled required>
            <input type="hidden" name="country" value="Philippines">
          </div>
        </div>
        <div class="btn-order">
          <input type="submit" name="order" class="btn" value="Place Order Now">
        </div>
        <input type="hidden" name="status" class="btn" value="Pending">
      </form>
    </div>
    
  </div>
</section>

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