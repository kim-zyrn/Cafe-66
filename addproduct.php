<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){
  $category_id;

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price1'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $price1 = $_POST['price1'];
   $price1 = filter_var($price1, FILTER_SANITIZE_STRING);

   $price2 = $_POST['price2'];
   $price2 = filter_var($price2, FILTER_SANITIZE_STRING);
   

   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
#category _id
  if ($category=="Hot Latte") {
      $category_id = $_POST['category_id1'];
        $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
}
elseif ($category=="Non-Coffee") {
    $category_id = $_POST['category_id10'];
        $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
   }
   elseif ($category=="Italian Soda") {
    $category_id = $_POST['category_id4'];
        $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
   }
    elseif ($category=="Special Flavored Iced Coffee") {
        $category_id = $_POST['category_id8'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
       elseif ($category=="Alcohol x Coffee") {
        $category_id = $_POST['category_id9'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
        elseif ($category=="Classic Series") {
        $category_id = $_POST['category_id3'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
       elseif ($category=="Premium Series") {
        $category_id = $_POST['category_id5'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
       elseif ($category=="Cheesecake Series") {
        $category_id = $_POST['category_id2'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
       elseif ($category=="Liquor Series") {
        $category_id = $_POST['category_id6'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
        elseif ($category=="Iced Coffee") {
        $category_id = $_POST['category_id7'];
            $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);
       }
   

   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

    if ($category_id=="soda") {
    $general_category = $_POST['gen_cat5'];
            $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
   }
   
    elseif ($category_id=="hot-latte") {
       $general_category = $_POST['gen_cat1'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
   }
   elseif ($category_id=="non-coffee") {
       $general_category = $_POST['gen_cat4'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
   }
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'assets/products/'.$image;

    if (!isset($general_category)) {
        if ($category_id=="iced") {
          $general_category = $_POST['gen_cat3'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        }
        elseif ($category_id=="special-flavored") {
            $general_category = $_POST['gen_cat3'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        
        }
         elseif ($category_id=="alchol-coffee") {
            $general_category = $_POST['gen_cat3'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        
        }
         elseif ($category_id=="cheesecake") {
            $general_category = $_POST['gen_cat2'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        
        }
         elseif ($category_id=="classic") {
            $general_category = $_POST['gen_cat2'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        
        }
         elseif ($category_id=="premium") {
            $general_category = $_POST['gen_cat2'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        
        }
         elseif ($category_id=="liqour") {
            $general_category = $_POST['gen_cat2'];
           $general_category= filter_var($general_category, FILTER_SANITIZE_STRING);
        
        }
    }


 
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(name, category, category_id, general_category, details, price, price1, price2, image) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $category, $category_id, $general_category, $details, $price, $price1, $price2, $image]);
 
      if($insert_products){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new product added!';
         }

      }

   }

};

?>



<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Prodcuct - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


</head>
<body>
<!-- header section starts  -->
<?php include 'admin_header.php'; ?>
<!-- admin panel starts  -->

  <div class="profile" style="right: 100px; text-transform: uppercase;">

      
      
      <div class="cover-photo">
      <img src="assets/uploaded_img/<?= $fetch_profile['image']; ?>"  class="profile-img" alt="">
      </div>
      <div class="profile-name"> <?= $fetch_profile['name']; ?></div>
      <button  class="update-btn">Update Profile</button>
      <button class="logout-btn"><a href="logout.php" style="text-decoration: none; color: #000;">Logout</a></button>
     
    </div>

  

</header>

<!---==================ADD PRODUCT FORM===========--->


 <div class="add-product" >
      <form action="" method="POST" enctype="multipart/form-data">
     
      <div class="cover-photo">
      </div>

          <div class="flex">
         <div class="inputBox" >
          <!---category id-->
              <input type="hidden" name="category_id1" class="input" value="hot-latte">
              <input type="hidden" name="category_id2" class="input" value="cheesecake">
              <input type="hidden" name="category_id3" class="input" value="classic">
              <input type="hidden" name="category_id4" class="input" value="soda">
              <input type="hidden" name="category_id5" class="input" value="premium">
              <input type="hidden" name="category_id6" class="input" value="liqour">
              <input type="hidden" name="category_id7" class="input" value="iced">
              <input type="hidden" name="category_id8" class="input" value="special-flavored">
              <input type="hidden" name="category_id9" class="input" value="alchol-coffee">
              <input type="hidden" name="category_id10" class="input" value="non-coffee">

          <!---general category -->
              <input type="hidden" name="gen_cat1" class="input" value="Hot Latte">
              <input type="hidden" name="gen_cat2" class="input" value="MilkTea">
              <input type="hidden" name="gen_cat3" class="input" value="Iced Coffee">
              <input type="hidden" name="gen_cat4" class="input" value="Non-Coffee">
              <input type="hidden" name="gen_cat5" class="input" value="Italian Soda">

          

           


              <span >Product Name:</span>
              <input type="text" name="name" placeholder="Enter product name" required class="box1">
              <span>Product Category:</span>
              <select name="category" class="box1" required>
            <option value="" selected disabled>Select Category</option>
               <option value="Hot Latte">Hot Latte</option>
               <option value="Non-Coffee">Non-Coffee</option>
               <option value="Italian Soda">Italian Soda</option>
               <optgroup label="Iced Coffee">
                <option value="Iced Coffee"> Iced Coffee</option>
               <option value="Special Flavored Iced Coffee">Special Flavored Iced Coffee</option>
                <option value="Alcohol x Coffee">Alcohol x Coffee</option>
               </optgroup>
               <optgroup label="MilkTea Series">
               <option value="Classic Series">Classic Series</option>
               <option value="Premium Series">Premium Series</option>
               <option value="Cheesecake Series">Cheesecake Series</option>
               <option value="Liquor Series">Liquor Series</option>
               </optgroup>

              <input type="hidden" name="old_pass" >
              <span >Product Price (16oz):</span>
              <input type="number" name="price1" placeholder="Enter price" class="box1">
             
              <span >Product Price (22oz):</span>
              <input type="number" name="price2" placeholder="Enter price" class="box1">

              <span>Select Picture:</span>
              <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box1">
              <span>Product Description:</span>
              <textarea name="details" id="" placeholder="Enter Description" cols="30" rows="7" required="" class="box1"></textarea>
        
         </div>
         
      </div>
    
      <input type="submit" class="update-admin" value="Add Product" style="font-size: 20px;  letter-spacing: 3px;" name="add_product">
     
    </div>
  </form>
  
</div>



<!-- custom js file link  -->
<!-- custom js file link  -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/admin_script.js"></script>
  


</body>
</html>


