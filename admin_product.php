<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <style type="text/css">
    
  </style>

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

      <div class="user-box" style="background-image: url(assets/images/user-bg3.png);">
        <img src="assets/images/19.png" class="product-img" alt="" style="width: 370px; height: 350px; top: -22px;" >
         <h2>₱125.00</h2>
         <h2>Ice red velvet latte </h2>
         <h4>Special Flavored Iced Coffee</h4>
         <h6>Ice red velvet latte is a delicious and creamy treat that is perfect for any time of day. Made with espresso, steamed milk, and a hint of cocoa and red velvet cake flavoring, this drink is sure to satisfy your sweet tooth. It's a perfect balance of decadence and comfort, perfect for a cozy winter day or special occasion. Enjoy this delightful beverage with friends, family, or simply by yourself!</h6>
         <div class="flex-btn">
               <input type="submit" name="update_order" class="update-products" value="Update">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-products" onclick="return confirm('delete this order?');">Delete</a>
            </div>
      </div>

       <div class="user-box" style="background-image: url(assets/images/user-bg3.png);">
        <img src="assets/images/20.png" class="product-img" alt="" style="width: 370px; height: 350px; top: -22px;" >
         <h2>₱125.00</h2>
         <h2>Ice matcha latte</h2>
         <h4>Special Flavored Iced Coffee</h4>
         <h6>Ice matcha latte is an iconic beverage that is made with matcha green tea powder, steamed milk, and a sweetener such as honey or sugar. It is a creamy, sweet, and earthy drink that is very popular.The combination of the earthy matcha flavor and the creamy milk creates a unique taste that is sure to satisfy any palate.</h6>
         <div class="flex-btn">
               <input type="submit" name="update_order" class="update-products" value="Update">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-products" onclick="return confirm('delete this order?');">Delete</a>
            </div>
      </div>

       <div class="user-box" style="background-image: url(assets/images/user-bg3.png);">
        <img src="assets/images/21.png" class="product-img" alt="" style="width: 370px; height: 350px; top: -22px;" >
         <h2>₱125.00</h2>
         <h2>Ice Strawberry Latte</h2>
         <h4>Special Flavored Iced Coffee</h4>
         <h6>Ice Strawberry Latte is a refreshing and delicious twist on the classic latte. This beverage is made with cold milk, espresso, and strawberry syrup that is mixed together and poured over ice. The syrup gives the latte a sweet and fruity flavor, while the espresso adds a bold and robust taste. The ice adds a refreshing and cooling sensation, making this latte the perfect drink on a hot  summer day.</h6>
         <div class="flex-btn">
               <input type="submit" name="update_order" class="update-products" value="Update">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-products" onclick="return confirm('delete this order?');">Delete</a>
            </div>
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