<?php

@include 'config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:users.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe 66 - Users</title>
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
          <h1>USERS</h1>
    </div>

   <div class="user-container user-container">

   
   <?php
         $select_users = $conn->prepare("SELECT * FROM `users`WHERE user_type = ? ");
         $select_users->execute(['user']);
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="user-box" style="background-image: url(assets/images/user-bg3.png);<?php if($fetch_users['user_type'] == $admin_id){ echo 'display:none'; }; ?>">
        <img src="assets/uploaded_img/<?= $fetch_users['image']; ?>"  class="user-img" alt="">
         <h2><?= $fetch_users['name']; ?></h2>
         <h4><?= $fetch_users['email']; ?></h4>
         <a href="users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">Delete</a>
      </div>
       <?php
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