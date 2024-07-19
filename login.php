<?php

@include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:dashboard.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'no user found!';

      }

   }else{
      $message[] = 'Incorrect Email or Password!';
   }



}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Cafe 66- Login</title>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <script src="https://kit.fontawesome.com/ee270c86b4.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">
 <link rel="stylesheet" type="text/css" href="assets/css/login.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>

  <div class="container" style="background-image: url(assets/images/bg5.jpg); background-attachment: fixed;">
    <div class="img">
    </div>
    <div class="login-content">
      <form action="" method="POST">


        <h2 class="title">Welcome to Cafe 66</h2>
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
              <input type="submit" class="btn" name="submit" value="Login">
              <p>Don't have an  account? <a href="signup.php">Register now</a></p>
            </form>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>