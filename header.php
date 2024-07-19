<?php

  if(isset($message)){
    foreach($message as $message){
    echo '
      <div class="message">
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        <div class="msg">'.$message.'</div> 
      </div>
    ';
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<head>

<style>
.user-profile{
  font-family: 'Urbanist', sans-serif;
  user-select: none;
  background: #fff;
  color: #000;
  border-radius: 20px;
  width: 350px;
  text-align: center;
  display: none;
  position: fixed;
  margin-top: 480px;
  position: top;
}
.user-profile.active{
   display:inline-block;
   right: 100px;
}
.cover-photo{
  background: url(https://img.freepik.com/free-vector/espresso-coffee-cup-coffee-beans_79603-1038.jpg?w=900&t=st=1669471362~exp=1669471962~hmac=58184de235d90bd2cbe090ca59bae35ca53028ad35eed341618ecc4ca9dc4823);
  background-size: cover;
  background-repeat: no-repeat;
  height: 160px;
  width: 100%;
  border-radius: 5px 5px 0 0;
}
.profile-img{
  height: 120px;
  width: 120px;
  border-radius: 50%;
  margin: 93px 0 0 -175px;
  border: 1px solid #fff;
  padding: 7px;
  background: #fff;
}
.profile-name {
  font-size: 25px;
  font-weight: lighter;
  margin: 27px 0 0 120px;
  text-transform: uppercase;
}
@media screen and (max-width: 767px) {
  .user-profile.active {
    right: 20px;
  }
  .user-profile {
    width: 300px;
  }
}

.search-container {
    width: 100%;
    height: 0%;
    opacity: 0;
    visibility: hidden;
    transition: height 1s ease;
    overflow: hidden;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    transition: transform .35s cubic-bezier(.46, .01, .32, 1),opacity .4s ease-out;
    z-index: 2;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}
.search-container.active {
    height: auto;
    opacity: 1;
    visibility: visible;
    transition: all .5s;
    z-index: 101;
    padding-bottom: 50px;
}
.search-form {
    display: block;
    width: 80%;
    margin: 30px auto 30px;
    align-items: center;
}
.search-h2 {
    text-align: center;
    margin:5% 0 0 0;
}
.search-form form {
    gap:1.5rem;
    width: 100%;
    padding: .5rem;
    margin: auto;
    border-bottom: 1.5px solid #ccc;
    display: block; 
}
.search-form form .box{
    width: 90%;
    background-color: transparent;
    font-size: 1.7rem;
    color: var(--black);
}
.search-form form button {
    background-color: transparent;
    display: inline;
    float: right;
    margin-bottom: 10px;
 }
.search-form form button i {
   font-size: 2.1rem;
   line-height: 1;
}
.close {
    margin: 1.5% 2% 0 0;
}
.close i {
    font-size: 35px;
    line-height: 35px;
    width: 35px;
    height: 35px;
    text-align: center;
    display: inline-block;
    float: right;
    color: #000;
}
.close i:hover {
    color: var(--dark-brown);
}
.search-page .search-caption {
    margin: 13% 2% 3%;
    text-transform: uppercase;
    text-align: center;
}
.search-page .search-caption span {
    color: var(--hover-color);
}

@media screen and (max-width:767px) {
    .search-h2 {
        margin-top: 15%;
    }
    .close i {
        font-size: 25px;
    }
    .search-form form {
        width: 90%;
    }
    .search-page .search-caption {
        margin-top: 30%;
    }
}
</style>

</head>
<body>

<header class="header">
  
  <a href="home.php" class="logo">
    <img src="assets/images/logo.png" alt="">
  </a>

  <nav class="navbar">
    <a href="home.php">home</a>
    <a href="about.php">about</a>
    <a href="_shop.php">shop</a>  
    <a href="contact.php">contact</a>
  </nav>

  <div class="icons">
    <div class="bi bi-search" title="Search" id="search-bttn"></div>
    <?php
      $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $count_cart_items->execute([$user_id]);
      $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
      $count_wishlist_items->execute([$user_id]);
    ?>
    <a href="wishlist.php" class="bi bi-heart" title="Wishlist" id="wishlist-btn"><span class="badge rounded-pill badge-notification"><?= $count_wishlist_items->rowCount(); ?></span></a>
    <a href="cart.php" class="bi bi-cart" title="Cart" id="cart-btn"><span class="badge rounded-pill badge-notification"><?= $count_cart_items->rowCount(); ?></span></a>
    <a href="orders.php" class="bi bi-clipboard" title="Placed Orders" id="orders-btn"></a>
    <div class="bi bi-person" title="Account" id="user-btn"></div>
    <div class="bi bi-list" id="menu-btn"></div>
  </div>

  <div class="user-profile" style="text-transform: uppercase;box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);">
    <?php
      $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="cover-photo">
      <img src="assets/uploaded_img/<?= $fetch_profile['image']; ?>"  class="profile-img" alt="">
    </div>
    <div class="profile-name"> <?= $fetch_profile['name']; ?></div>
    <button  class="update-btn"><a href="user_update.php" style="text-decoration: none; color: #fff;">Update Profile</a></button>
    <button class="logout-btn"><a href="logout.php" style="text-decoration: none; color: #000;">Logout</a></button>   
  </div>

  <div class="search-container">
    <div class="close">
      <i class="bi bi-x" id="close"></i>
    </div>

    <h2 class="search-h2">Type anything and hit Enter</h2>

    <section class="search-form">
      <form action="search.php" method="POST">
          <input type="text" class="box" name="keyword" placeholder="Enter at least two (2) characters.">
          <button type="submit" name="search_btn"><i class="bi bi-search"></i></button>
      </form>
    </section>
  </div>

</header>

<script>
let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
    search.classList.remove('active');
}

let searchForm = document.querySelector('.search-container');

document.querySelector('#search-bttn').onclick = () =>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

let profile = document.querySelector('.user-profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
   search.classList.remove('active');
}

let close = document.querySelector('.close');

document.querySelector('#close').onclick = () =>{
    searchForm.classList.remove('active');
}
</script>

</body>
</html>