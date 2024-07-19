<?php

@include 'config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_contacts.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe 66 - Messages</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/styles.css">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <style type="text/css">
    .msg h6{
      font-size: 15px;
    }
  </style>

</head>
<body>
<!-- header section starts  -->
<?php include 'admin_header.php'; ?>

<!-- admin panel starts  -->

<section class="menu" id="menu">
    <div class="heading1">
          <h1>MESSAGES</h1>
    </div>

   <div class="user-container user-container">

    <?php
      $select_message = $conn->prepare("SELECT * FROM `message`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>

      <div class="user-box" style="background-image: url(assets/images/user-bg3.png);">
        <h2 style="margin-bottom: 30px;"><?= $fetch_message['name']; ?></h2>

        <div class="msg" style="height: 100px;">
         <h6>EMAIL:  <?= $fetch_message['email']; ?></h6>
         <h6>NUMBER: <?= $fetch_message['number']; ?></h6>
         <h6>MESSAGE: <?= $fetch_message['message']; ?></h6>
        </div>

         <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>"  onclick="return confirm('delete this message?');" class="delete-btn" >Delete</a>s
      </div>

      <?php
      }
   }else{
      echo 
      '<div class="popup">
        <div class="popup-content">
          <i class="bi bi-x"></i>
          <h1>No Messages found</h1>
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