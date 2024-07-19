<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price1 = $_POST['price1'];
   $price1 = filter_var($price1, FILTER_SANITIZE_STRING);
   $price2 = $_POST['price2'];
   $price2 = filter_var($price2, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'assets/products/'.$image;
   $old_image = $_POST['old_image'];

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, details = ?, price1 =?, price2 = ? WHERE id = ?");
   $update_product->execute([$name, $category, $details, $price1, $price2, $pid]);

   $message[] = 'product updated successfully!';

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{

         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('assets/products/'.$old_image);
            $message[] = 'image updated successfully!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Products - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <style type="text/css">

    .old_product_image{
      width: 80%;
      border-radius: 40px;
      top: -500px;
      border:10px solid #ad6d2f;  
      margin-bottom: 30px;
    }

  </style>

  


</head>
<body>
<!-- header section starts  -->
<?php include 'admin_header.php'; ?>

<!-- admin panel starts  -->


<div class="add-product" >
   

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="cover-photo">
      </div>
      <div class="flex">
         <div class="inputBox" style="right: 500px; " >

      <input type="hidden" name="old_image"  value="<?= $fetch_products['image']; ?>" class="old_product_image" >
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">

      <img src="assets/products/<?= $fetch_products['image']; ?>" alt="Product Image" class="old_product_image">>

      <span >Product Name:</span>
      <input type="text" name="name" placeholder="enter product name" required class="box1" value="<?= $fetch_products['name']; ?>" >

       
      <span >Product Price (16oz):</span>
      <input type="number" name="price1" min="0" placeholder="Enter product price" required class="box1" value="<?= $fetch_products['price1']; ?>">
             
      <span >Product Price (22oz):</span>
      <input type="number" name="price2" min="0" placeholder="Enter product price" required class="box1" value="<?= $fetch_products['price2']; ?>">

      <span>Product Category:</span>
      <select name="category" class="box1" required>
         <option selected><?= $fetch_products['category']; ?></option>
               <option value="Hot Latte">Hot Latte</option>
               <option value="Cold Drinks">Non-Coffee</option>
               <option value="Rice Meal">Italian Soda</option>
               <optgroup label="Iced Coffee">
               <option value="Snacks">Special Flavored Iced Coffee</option>
                <option value="Snacks">Alcohol x Coffee</option>
               </optgroup>
               <optgroup label="MilkTea Series">
               <option value="Snacks">Classic Series</option>
               <option value="Snacks">Premium Series</option>
               <option value="Snacks">Cheesecake Series</option>
               <option value="Snacks">Liquor Series</option>
               </optgroup>
      </select>
      <span>Product Description:</span>
      <textarea name="details" required placeholder="enter product details" class="box1" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>

      <span>Select New Picture:</span>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box1">

   </div>
</div>
        
      <div class="flex-btn">
         <input type="submit" class="update-admin" value="Update Product" style="font-size: 20px;  letter-spacing: 3px;" name="update_product">
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products found!</p>';
      }
   ?>

</div>

</section>


<!-- custom js file link  -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/admin_script.js"></script>

</body>
</html>