<?php

include 'config.php';



if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $user_type = $_POST['user_type'];
   $user_type = filter_var($user_type, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'assets/uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'User email already exist!';
   }  else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, user_type, image) VALUES(?,?,?,?,?)");
         $insert->execute([$name, $email, $pass, $user_type, $image]);

         if($insert){
            if($image_size > 5000000){
               $message[] = 'Image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'Registered Successfully!';
               header('location:login.php');
            }
         }

      }
   }

?>


<!DOCTYPE html>
<html>
<head>
  <title>Cafe 66- Signup</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/signup.css">
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
   <script src="https://kit.fontawesome.com/ee270c86b4.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>


  <div class="container" style="background-image: url(assets/images/bg5.jpg);">
    <div class="img">
    </div>


    <div class="login-content">
       <form action="" enctype="multipart/form-data" method="POST">

         <?php
    
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="popup">
        <div class="popup-content">
          <i class="bi bi-x"></i>
          <h1>'.$message.'</h1>
        </div>
    </div>
      
      ';
    }
  }
?>

   
        <h2 class="title" style="font-size: 40px; margin-bottom: 50px;">Create Account</h2>
              <div class="input-div one" >
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <div class="div">
                    <h5>Name</h5>
                    <input type="text"  name="name" class="input" required="">
                 </div>
              </div>
              <div class="input-div one">
                 <div class="i">
                   <i class="fa-solid fa-envelope"></i>
                 </div>
                 <div class="div">
                    <h5>Email</h5>
                    <input type="Email" name="email" class="input" required="">
                 </div>
              </div>
              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fas fa-lock"></i>
                 </div>
                 <div class="div">
                    <h5>Password</h5>
                    <input type="password" name="pass" class="input" required="">
                 </div>
              </div>
              <!---user type-->
              <input type="hidden" name="user_type" class="input" value="user">

              <div class="input-div pass">
                 <div class="i"> 
                    <i class="fa-solid fa-upload"></i>
                 </div>
                 <div class="div">
                    
                    <input type="file" name="image" class="input" required="">
                 </div>
              </div>
              <input type="submit" class="btn" value="Register" name="submit">
              <p>Already have an  account? <a href="login.php">Login now</a></p>
            </form>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>