<?php


if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>


<header class="header">
  <a href="index.html" class="logo">
    <img src="assets/images/logo.png" alt="">
  </a>

  <nav class="navbar">
    <a href="dashboard.php">home</a>
    <a href="products.php">products</a>
    <a href="admin_orders.php">orders</a>
    <a href="users.php">users</a>
    <a href="admin_contacts.php">messages</a>
  </nav>


  <div class="icons">
    
    <div class="bi bi-person" title="Account" id="user-btn"></div>
    <a href="addproduct.php"><div class="bi bi-plus-square" title="Add Product" id="product-btn" style="font-size:23px; margin-top: 5px; margin-left: 10px;"></div></a> 
    <div class="bi bi-list" id="menu-btn"></div>
  </div>

  <div class="profile" style="right: 100px; text-transform: uppercase;">

      
       <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
      <div class="cover-photo">
      <img src="assets/uploaded_img/<?= $fetch_profile['image']; ?>"  class="profile-img" alt="">
      </div>
      <div class="profile-name"> <?= $fetch_profile['name']; ?></div>
      <button  class="update-btn"><a href="admin_update.php" style="text-decoration: none; color: #fff;">Update Profile</a></button>
      <button class="logout-btn"><a href="admin_logout.php" style="text-decoration: none; color: #000;">Logout</a></button>
     
    </div>

  

</header>
