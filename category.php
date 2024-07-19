<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

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

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'Already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, category_id, category, price, price1, price2, size, quantity, image) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_category_id, $p_category, $p_price, $p_price1, $p_price2, $p_size, $p_qty, $p_image]);
      $message[] = 'Successfully added to wishlist!';
   }

}

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

?>


<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $category_name = $_GET['category']; ?> | Category - Cafe 66</title>
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
  .empty {
      color: #000;
      font-size: 20px;
  }
  .caption {
      color: #361c01;
      font-size: 15px;
      text-align: justify;
  }
  </style>

</head>
<body>
    
<button onclick="topFunction()" class="myBtn" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>

<?php include 'header.php'; ?>

<!-- breadcrumbs section starts  -->

<div class="page-bc" id="page-bc">
  <h1><?= $category_name = $_GET['category']; ?></h1>
    <ul class="breadcrumb">
      <li><a href="home.php">Home</a></li>
      <li><a href="_shop.php">Shop</a></li>
      <li><?= $category_name = $_GET['category']; ?></li>
    </ul>
</div>

<!-- breadcrumbs section ends -->

<!-- products section starts  -->

<div class="main-container" style="margin-top: 50px;">
  <div class="filter-container">
        
    <section class="products">
      <div class="row">
        <?php
            $category_name = $_GET['category'];
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
            $select_products->execute([$category_name]);
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <form class="col-lg-3 col-sm-6" action="" method="POST">
          <div class="box">
            <div class="item">
              <figure class="products-thumb">
                <img src="assets/products/<?= $fetch_products['image']; ?>" alt="">
                <div class="icon-links">
                  <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="icon" title="Quickview"><i class="bi bi-eye"></i></a>
                  <span class="icon span"><i class="bi bi-heart"></i><input type="submit" name="add_to_wishlist" title="Add to Wishlist" value=" " style="background:transparent;"></span>
                  <span class="icon span"><i class="bi bi-cart"></i><input type="submit" name="add_to_cart" title="Add to Cart" value=" " style="background:transparent;"></span>
                </div>        
              </figure>
              <div class="content">
                <h3 class="name"><a href="view_page.php?pid=<?= $fetch_products['id']; ?>"><?= $fetch_products['name']; ?></a></h3>
                <h6 class="category"><a href="category.php?category=<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></a></h6>
                <div class="price">₱<?= $fetch_products['price1']; ?>.00 <span>(16oz)</span> &nbsp;<span class="line-divider">|</span> &nbsp;₱<?= $fetch_products['price2']; ?>.00 <span>(22oz)</span></div>
                <div class="selection">
                      <select name="p_size">
                        <option value="16oz">Select size &nbsp;&nbsp;</option>
                        <option value="16oz">16oz</option>
                        <option value="22oz">22oz</option>
                      </select>
                      <input type="number" min="1" value="1" name="p_qty" class="quantity">
                    </div>
              </div>
              <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
              <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
              <input type="hidden" name="p_category_id" value="<?= $fetch_products['category_id']; ?>">
              <input type="hidden" name="p_category" value="<?= $fetch_products['category']; ?>">
              <input type="hidden" name="p_price1" value="<?= $fetch_products['price1']; ?>">
              <input type="hidden" name="p_price2" value="<?= $fetch_products['price2']; ?>">
              <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
            </div>
          </div>
        </form>
        <?php
        }
        }
        ?>
      </div>
    </section>

  </div>
</div>

<!-- products section ends  -->

<!-- featured section starts -->

<div class="hr-lines">YOU MAY ALSO LIKE</div>

<section class="products">
  <div class="row">
    <?php
        $category = $_GET['category'];
        $select_products = $conn->prepare("SELECT * FROM `products` where category != '$category' ORDER BY RAND() LIMIT 12");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
    ?>
    <form class="col-lg-3 col-sm-6" action="" method="POST">
      <div class="box">
        <div class="item">
          <figure class="products-thumb">
            <img src="assets/products/<?= $fetch_products['image']; ?>" alt="">
            <div class="icon-links">
              <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="icon" title="Quickview"><i class="bi bi-eye"></i></a>
              <span class="icon span"><i class="bi bi-heart"></i><input type="submit" name="add_to_wishlist" title="Add to Wishlist" value=" " style="background:transparent;"></span>
              <span class="icon span"><i class="bi bi-cart"></i><input type="submit" name="add_to_cart" title="Add to Cart" value=" " style="background:transparent;"></span>
            </div>        
          </figure>
          <div class="content">
            <h3 class="name"><a href="view_page.php?pid=<?= $fetch_products['id']; ?>"><?= $fetch_products['name']; ?></a></h3>
            <h6 class="category"><a href="category.php?category=<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></a></h6>
            <div class="price">
              <?php
                if($fetch_products['category_id'] == 'hot-latte' || $fetch_products['category_id'] == 'classic' || $fetch_products['category_id'] == 'premium' || $fetch_products['category_id'] == 'cheesecake' || $fetch_products['category_id'] == 'iced') {
                  echo '₱' . $fetch_products['price'] . '.00';
                } else {
                  echo '₱' . $fetch_products['price'] . '.00';}
              ?>
            </div>
            <div class="selection">
                  <select name="p_size">
                    <option value="16oz">Select size &nbsp;&nbsp;</option>
                    <option value="16oz">16oz</option>
                    <option value="22oz">22oz</option>
                  </select>
                  <input type="number" min="1" value="1" name="p_qty" class="quantity">
                </div>
          </div>
          <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
          <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
          <input type="hidden" name="p_category_id" value="<?= $fetch_products['category_id']; ?>">
          <input type="hidden" name="p_price1" value="<?= $fetch_products['price1']; ?>">
          <input type="hidden" name="p_price2" value="<?= $fetch_products['price2']; ?>">
          <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
        </div>
      </div>
    </form>
    <?php
    }
    }
    ?>
  </div>
</section>

<!-- featured section ends -->

<!-- footer section starts  -->

<?php include 'footer.php'; ?>

<!-- footer section ends -->

<!-- custom js file link  -->

<script src="assets/js/script.js"></script>

<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

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

</body>
</html>