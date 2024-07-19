<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'Payment has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM orders WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <style type="text/css">
    .order-content{
      width: 200px;
      margin-left: 5px;
     
    }
  </style>

</head>
<body>
<!-- header section starts  -->
<?php include 'admin_header.php'; ?>

<!-- admin panel starts  -->

<section class="menu" id="menu">
    <div class="heading1">
          <h1>ORDERS</h1>
    </div>

   <div class="user-container user-container">

    <?php
      $show_products = $conn->prepare("SELECT * FROM orders");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_orders = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>

      <div class="user-box" style="background-image: url(assets/images/user-bg3.png);" >
        
          <div class="order-content" style=" height: 400px;">
            <p><span>NAME:</span> <?= $fetch_orders['name']; ?></p>
             <p><span>EMAIL:</span> <?= $fetch_orders['email']; ?></p>
             <p><span>NUMBER:</span> <?= $fetch_orders['number']; ?></p>
             <p><span>ADDRESS:</span> <?= $fetch_orders['address']; ?></p>
             <p><span>TOTAL PRODUCTS:</span><?= $fetch_orders['total_products']; ?></p>
             <p><span>TOTAL PRICE</span>₱<?= $fetch_orders['total_price']; ?></p>
             <p><span>PAYMENT METHOD:</span><?= $fetch_orders['method']; ?></p>
             <p><span>PLACED ON:</span><?= $fetch_orders['placed_on']; ?></p>
          </div>

             <form action="" method="POST">

               <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                <select name="update_payment" class="order-btn" required="">
               <option value="<?= $fetch_orders['status']; ?>" selected disabled><?= $fetch_orders['status']; ?></option>
               <?php 
                  if ($fetch_orders['status']=="Pending") {
                     echo '<option value="Approved">Approved</option>
                     <option value="Preparing your Order">Preparing your Order</option>
                     <option value="Out for Delivery">Out for Delivery</option>';
                  } else if ($fetch_orders['status']=="Approved") {
                     echo '<option value="Pending">Pending</option>
                     <option value="Preparing your Order">Preparing your Order</option>
                     <option value="Out for Delivery">Out for Delivery</option>';
                  } else if ($fetch_orders['status']=="Preparing your Order") {
                     echo '<option value="Pending">Pending</option>
                     <option value="Approved">Approved</option>
                     <option value="Out for Delivery">Out for Delivery</option>';
                  } else if ($fetch_orders['status']=="Out for Delivery") {
                     echo '<option value="Pending">Pending</option>
                     <option value="Approved">Approved</option>
                     <option value="Preparing your Order">Preparing your Order</option>';
                  } 
                  
               ?>
               
         </select>


         <div class="flex-btn">
            <?php 
               if ($fetch_orders['status']=="Pending" || $fetch_orders['status']=="Approved" || $fetch_orders['status']=="Preparing your Order" || $fetch_orders['status']=="Out for Delivery") {
                  echo '<input type="submit" name="update_order" class="update-products" value="Update">
                  <a href="admin_orders.php?delete='.$fetch_orders['id'].'" class="delete-products" onclick="return confirm(\'delete this order?\');">Delete</a>';
               } else if ($fetch_orders['status']=="Completed") {
                  echo '<a href="admin_orders.php?delete='.$fetch_orders['id'].'" class="delete-products" onclick="return confirm(\'delete this order?\');">Delete</a>';
               }
            ?>
              
            </div>
          </form>
      </div>

      <?php
      }
   }else{
      echo 
      '<div class="popup">
        <div class="popup-content">
          <i class="bi bi-x"></i>
          <h1>No orders found</h1>
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