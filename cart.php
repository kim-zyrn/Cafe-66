<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
  $delete_cart_item->execute([$delete_id]);
  header('location:cart.php');
}

if(isset($_GET['delete_all'])){
  $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
  $delete_cart_item->execute([$user_id]);
  header('location:cart.php');
}

if (isset($_POST['update_cart'])) {
  $cart_id = $_POST['cart_id'];
  $p_qty = $_POST['p_qty'];
  $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
  $p_size = $_POST['p_size'];
  $p_size = filter_var($p_size, FILTER_SANITIZE_STRING);

  if ($p_size == "16oz") {
    $p_price = $_POST['p_price1'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
  } else if ($p_size == "22oz"){
    $p_price = $_POST['p_price2'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
  }

  $update_cart = $conn->prepare("UPDATE `cart` SET  price = ?, size = ?, quantity = ?  WHERE id = ?");
  $update_cart->execute([$p_price, $p_size, $p_qty, $cart_id]);
  $message[] = 'Cart updated successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart - Cafe 66</title>
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
    <li>Your Shopping Cart</li>
  </ul>
</div>

<!-- cart section starts -->
<section class="cart" id="cart">
  <div class="container">

    <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
    ?>

    <form action="" method="POST" class="row">
      <div class="col">
        <a href="view_page.php?pid=<?= $fetch_cart['pid']; ?>" class="image">
          <img src="assets/products/<?= $fetch_cart['image']; ?>" alt="" width="100%">
        </a>
      </div>
      <div class="col center">
        <div class="name"><?= $fetch_cart['name']; ?></div>
        <?php
          if($fetch_cart['size'] == '16oz') {
            echo '<input class="price" value="₱'.$fetch_cart['price1'].'.00" style="border: none;margin:auto;">
            <input type="hidden" name="p_price1" value="'.$fetch_cart['price1'].'">';
          } else if($fetch_cart['size'] == '22oz') {
          echo '<input class="price" value="₱'. $fetch_cart['price2'].'.00" style="border: none;margin:auto;">
          <input type="hidden" name="p_price2" value="'.$fetch_cart['price2'].'">';
          }
        ?>
        <input type="hidden" name="p_price1" value="<?= $fetch_cart['price1']; ?>">
        <input type="hidden" name="p_price2" value="<?= $fetch_cart['price2']; ?>">
      </div>
      <div class="col center" style="display: inline-block;">
        <span><b>Size:</b>&nbsp;&nbsp;</span>
        <div class="selection" style="display: inline-block;">
          <select name="p_size">
            <option value="<?= $fetch_cart['size']; ?>"><?= $fetch_cart['size']; ?></option>
            <?php 
              if ($fetch_cart['size'] == "16oz") {
                echo '<option value="22oz">22oz</option>';
              } else if ($fetch_cart['size'] == "22oz") {
                echo '<option value="16oz">16oz</option>';
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col center center2">   
        <span class="qty"><b>Quantity:</b>&nbsp;&nbsp;</span>
        <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" name="p_qty" class="quantity">
      </div>
      <div class="col center center3">
        <div class="total">
          <?php 
            if ($fetch_cart['size'] == '16oz') {
              echo '<b>Total:</b>&nbsp;&nbsp;₱'.$sub_total = ($fetch_cart['price1'] * $fetch_cart['quantity']).'.00';
            } else if($fetch_cart['size'] == '22oz') {
              echo '<b>Total:</b>&nbsp;&nbsp;₱'.$sub_total = ($fetch_cart['price2'] * $fetch_cart['quantity']).'.00';
            }
          ?>
        </div>
      </div>
      <div class="col btn">
        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
        <input type="submit" value="Update" name="update_cart" class="update-button">
        <a href="cart.php?delete=<?= $fetch_cart['id']; ?>" class="delete" onclick="return confirm('Delete this item from your cart?');">Delete</a>
      </div>
      
    </form>
    <?php
      $grand_total += $sub_total;
      }
    }else{
      echo '<h6 class="empty">Your cart is empty.<br><br><span class="caption">Adding items to your cart is a great way to enhance your shopping experience. 
      Simply select the items you want and click the "Add to Cart" button. 
      That way, when you\'re ready to purchase them, you can easily find it. So why not add those items to your cart today?</span></h6>';
    }
    ?>
  
    <div class="extra-btn">
      <a href="cart.php?delete_all" class="delete-all <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Delete all items from your cart?');">Delete All</a>
      <a href="_shop.php" class="continue-shopping">Continue Shopping</a>
    </div>
    <div class="cart-totals">
      <h3>Cart Totals</h3>
      <hr>
      <div class="total">
        <h2><b>₱<?= $grand_total; ?>.00</b></h2>
        <?php 
          if ($grand_total == 0) {
            echo '<a href="cart.php" class="continue-shopping">Proceed to Checkout</a>';
          } else {
            echo '<a href="checkout.php" class="continue-shopping">Proceed to Checkout</a>';
          }
        ?>
      </div>
    </div>
  </div>
</section>


<!-- cart section ends -->

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
<script src="assets/js/script.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

</body>
</html>