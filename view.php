<?php

@include 'config.php';

session_start();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quickview - Cafe 66</title>
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

<?php include 'header1.php'; ?>

<!-- single product section starts -->

<section class="view-product" id="view-product">
  <div class="container">
    <?php
      $pid = $_GET['pid'];     
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
    ?>
    <form class="row" action="" method="POST">
      <div class="col-lg-6">
        <div class="large">
          <img src="assets/products/<?= $fetch_products['image']; ?>" alt="" width="100%" id="mainImg">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="content">
          <div class="category"><?= $fetch_products['category']; ?></div>
          <div class="name"><?= $fetch_products['name']; ?></div>
          <div class="price1">₱<?= $fetch_products['price1']; ?>.00<span class="p"> (16oz)</span><span class="price2">₱<?= $fetch_products['price2']; ?>.00<span class="p"> (22oz)</span></span></div>
          <select name="p_size" style="border: 2px solid rgb(193, 193, 193);">
            <option value="16oz">Select size &nbsp;&nbsp;</option>
            <option value="16oz">16oz</option>
            <option value="22oz">22oz</option>
          </select>
          <input type="number" min="1" value="1" name="p_qty" class="quantity">
          <div class="buttons">
            <span class="button cart" onclick="return confirm('You need to login first!');"><input type="submit" name="add_to_cart" value="Add to Cart" style="background:transparent;color:#fff;"><i class="bi bi-cart"></i></span>
            <span class="button wishlist" onclick="return confirm('You need to login first!');"><input type="submit" name="add_to_wishlist" value="Add to Wishlist" style="background:transparent;color:#fff;"><i class="bi bi-heart"></i></span>
          </div>
          <div class="line" style="margin-top: 1%;"></div>
          <div class="details-head">Product Details</div>
          <div class="details"><?= $fetch_products['details']; ?></div>  
        </div>
      </div>
    </form>
    <?php
    }
    }
    ?>
  </div>
</section>

<!-- single product section ends -->

<!-- related product section starts -->

<div class="hr-lines">YOU MAY ALSO LIKE</div>

<section class="products">
  <div class="row">
    <?php
        $category = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` where id != '$category' ORDER BY RAND() LIMIT 8");
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
              <a href="view.php?pid=<?= $fetch_products['id']; ?>" class="icon" title="Quickview"><i class="bi bi-eye"></i></a>
              <span class="icon" onclick="return confirm('You need to login first!');"><i class="bi bi-heart"></i></span>
              <span class="icon" onclick="return confirm('You need to login first!');"><i class="bi bi-cart"></i></span>
            </div>        
          </figure>
          <div class="content">
            <h3 class="name"><a href="view.php?pid=<?= $fetch_products['id']; ?>"><?= $fetch_products['name']; ?></a></h3>
            <h6 class="category"><a href="categoryy.php?category=<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></a></h6>
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
          <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
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


<?php include 'footer1.php'; ?>

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