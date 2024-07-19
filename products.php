<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('assets/uploaded_img/'.$fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');


};

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe 66 - Products</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">

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
          <h1>PRODUCTS</h1>
    </div>

   <div class="user-container user-container">

    <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>

      <div class="user-box" style="background-image: url(assets/images/user-bg3.png);">
      
         <img  src="assets/products/<?= $fetch_products['image']; ?>"  class="product-img" alt="Product Image" style=" height: 320px;">
         <h2>₱<?= $fetch_products['price1']; ?> <span style="font-size: 13px;">(16oz)</span></h2> 
         <h2>₱<?= $fetch_products['price2']; ?> <span style="font-size: 13px;">(22oz)</span></h2>
         <h2><?= $fetch_products['name']; ?></h2>
         <h4 style="margin-bottom: 50px;"><?= $fetch_products['category']; ?></h4>
         <h6 style="color: #fff; font-size: 15px; text-align: justify; height: 230px;" class="details"><?= $fetch_products['details']; ?></h6>
         <div class="flex-btn">
               <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>" class="update-products">Update</a>
               <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-products" onclick="return confirm('delete this product?');">Delete</a>
            </div>
      </div>

      <?php
      }
   }else{
      echo 
      '<div class="popup">
        <div class="popup-content">
          <i class="bi bi-x"></i>
          <h1>No products found</h1>
        </div>
    </div>';
   }
   ?>
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