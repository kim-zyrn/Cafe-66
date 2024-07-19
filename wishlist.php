<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

  $pid = $_POST['pid'];
  $pid = filter_var($pid, FILTER_SANITIZE_STRING);
  $p_name = $_POST['p_name'];
  $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
  $p_category_id = $_POST['p_category_id'];
  $p_category_id = filter_var($p_category_id, FILTER_SANITIZE_STRING);
  $p_category = $_POST['p_category'];
  $p_category = filter_var($p_category, FILTER_SANITIZE_STRING);
  $p_price1 = $_POST['p_price1'];
  $p_price1 = filter_var($p_price1, FILTER_SANITIZE_STRING);
  $p_price2 = $_POST['p_price2'];
  $p_price2 = filter_var($p_price2, FILTER_SANITIZE_STRING);
  $p_image = $_POST['p_image'];
  $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
  $p_size = $_POST['p_size'];
  $p_size = filter_var($p_size, FILTER_SANITIZE_STRING);
  $p_qty = $_POST['p_qty'];
  $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

  if ($p_size == "16oz") {
    $p_price = $_POST['p_price1'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
  } else if ($p_size == "22oz"){
    $p_price = $_POST['p_price2'];
    $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
  }
 
    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->execute([$p_name, $user_id]);
 
    if($check_cart_numbers->rowCount() > 0){
       $message[] = 'Already added to cart!';
    }else{
 
       $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
       $check_wishlist_numbers->execute([$p_name, $user_id]);
 
       if($check_wishlist_numbers->rowCount() > 0){
          $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
          $delete_wishlist->execute([$p_name, $user_id]);
       }
 
      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, category_id, category, price, price1, price2, size, quantity, image) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_category_id, $p_category, $p_price, $p_price1, $p_price2, $p_size, $p_qty, $p_image]);
      $message[] = 'Successfully added to cart!';
    }
 
 }

 if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
    $delete_wishlist_item->execute([$delete_id]);
    header('location:wishlist.php');
 
 }
 
 if(isset($_GET['delete_all'])){
 
    $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
    $delete_wishlist_item->execute([$user_id]);
    header('location:wishlist.php');
 
 }
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist - Cafe 66</title>
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

<?php include 'header.php'; ?>

<div class="icons-bc" id="icons-bc">
  <ul class="icons-breadcrumb">
    <li><a href="home.php">Home</a></li>
    <li>Your Wishlist</li>
  </ul>
</div>

<!-- wishlist section starts -->

<section class="wishlist" id="wishlist" style="margin-top:20px;">
  <div class="row">

    <?php
      $user_id = $_SESSION['user_id'];
      $grand_total = 0;
      $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $select_wishlist->execute([$user_id]);
      if($select_wishlist->rowCount() > 0){
         while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){ 
    ?>
        
    <form class="col-lg-3 box" action="" method="POST">
      <div class="item">
        <figure class="wishlist-thumb">
          <img src="assets/products/<?= $fetch_wishlist['image']; ?>" alt="">
          <div class="icon-links">
            <a href="view_page.php?pid=<?= $fetch_wishlist['pid']; ?>" class="icon" title="Quickview"><i class="bi bi-eye"></i></a>
            <a href="wishlist.php?delete=<?= $fetch_wishlist['id']; ?>" class="icon" title="Delete" onclick="return confirm('Delete this item from your wishlist?');"><i class="bi bi-x"></i></a>
          </div>        
        </figure>
        <div class="content">
          <h3 class="name"><a href="view_page.php?pid=<?= $fetch_wishlist['pid']; ?>"><?= $fetch_wishlist['name']; ?></a></h3>
          <h6 class="category"><a href="category.php?category=<?= $fetch_wishlist['category']; ?>"><?= $fetch_wishlist['category']; ?></a></h6>
          <?php
            if($fetch_wishlist['size'] == '16oz') {
              echo '<div class="price">₱'.$fetch_wishlist['price1'].'.00</div>';
            } else if($fetch_wishlist['size'] == '22oz') {
              echo '<div class="price">₱'.$fetch_wishlist['price2'].'.00</div>';
            }
          ?>
          <div class="selection">
            <select name="p_size">
              <option value="<?= $fetch_wishlist['size']; ?>"><?= $fetch_wishlist['size']; ?></option>
              <?php 
                if ($fetch_wishlist['size'] == "16oz") {
                  echo '<option value="22oz">22oz</option>';
                } else if ($fetch_wishlist['size'] == "22oz") {
                  echo '<option value="16oz">16oz</option>';
                }
              ?>
            </select>
            <input type="number" min="1" value="<?= $fetch_wishlist['quantity']; ?>" name="p_qty" class="quantity">
            <span class="add-cart icon"><input type="submit" name="add_to_cart" value="Add to Cart" style="background:transparent;color:#fff;">&nbsp;&nbsp;|&nbsp;&nbsp;<i class="bi bi-cart"></i></span>
          </div>
          <input type="hidden" name="pid" value="<?= $fetch_wishlist['id']; ?>">
          <input type="hidden" name="p_name" value="<?= $fetch_wishlist['name']; ?>">
          <input type="hidden" name="p_category_id" value="<?= $fetch_wishlist['category_id']; ?>">
          <input type="hidden" name="p_category" value="<?= $fetch_wishlist['category']; ?>">
          <input type="hidden" name="p_price1" value="<?= $fetch_wishlist['price1']; ?>">
          <input type="hidden" name="p_price2" value="<?= $fetch_wishlist['price2']; ?>">
          <input type="hidden" name="p_qty" value="<?= $fetch_wishlist['quantity']; ?>">
          <input type="hidden" name="p_image" value="<?= $fetch_wishlist['image']; ?>">
        </div>
      </div>
    </form>
    <?php
      if ($fetch_wishlist['size'] == '16oz') {
        $sub_total = ($fetch_wishlist['price1'] * $fetch_wishlist['quantity']);
      } else if($fetch_wishlist['size'] == '22oz') {
        $sub_total = ($fetch_wishlist['price2'] * $fetch_wishlist['quantity']);
      }
      $grand_total += $sub_total;
      }
    }else{
      echo '<h6 class="empty">Your wishlist is empty. <br><br>
      <span class="caption">Adding items to your wishlist is a great way to keep track of what you want and avoid missing out on great deals.</span></h6>';
    }
   ?>     
  </div>
  <div class="wishlist-total">
    <p>Grand Total : <span><b>₱<?= $grand_total; ?>.00</b></span></p>
    <a href="wishlist.php?delete_all" class="delete-button <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Delete all items from your wishlist?');">Delete All</a>
    <a href="_shop.php" class="option-btn">Continue Shopping</a>
  </div>
</section>

<!-- wishlist section ends -->

<?php include 'footer.php'; ?>

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