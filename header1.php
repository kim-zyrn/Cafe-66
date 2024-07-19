<!DOCTYPE html>
<html lang="en">
<head>

<style>
  .profile1 {
    font-family: 'Urbanist', sans-serif;
    user-select: none;
    background: #fff;
    color: #000;
    border-radius: 10px;
    width: 350px;
    text-align: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    display: none;
    position: fixed;
    margin-top: 250px;
    position: top;
  }
  .profile1.active{
    display:inline-block;
    right: 100px;
  }
  .profile1 button {
    background: #000;
    border: 1px solid transparent;
    padding: 10px 25px;
    border-radius: 15px;
    font-family: 'Urbanist', sans-serif;
    cursor: pointer;
    margin-top: 40px;
    margin-bottom: 40px;
    font-size: 15px;
    font-weight: lighter;
  }
  .signup-btn{
    margin-left: 10px;
    background: #361c01;
  }
  .signup-btn:hover{
    background: #ad6d2f;
    transition: .5s;
  }
  .login-btn:hover{
    background: #ad6d2f;
    transition: .5s;
  }
  @media screen and (max-width: 767px) {
    .profile1.active {
      right: 65px;
    }
  }
</style>

</head>
<body>

<header class="header">
  
  <a href="index.php" class="logo">
    <img src="assets/images/logo.png" alt="">
  </a>

  <nav class="navbar">
    <a href="index.php">home</a>
    <a href="about_page.php">about</a>
    <a href="shop.php">shop</a>
    <a href="" onclick="return confirm('You need to login first!');">contact</a>
  </nav>

  <div class="icons">
    <div class="bi bi-search" title="Search" id="search-btn"></div>
    <a href="" class="bi bi-heart" title="Wishlist" id="wishlist-btn" onclick="return confirm('You need to login first!');"><span></span></a>
    <a href="" class="bi bi-cart" title="Cart" id="cart-btn" onclick="return confirm('You need to login first!');"><span></span></a>
    <a href="" class="bi bi-clipboard" title="Placed Orders" id="orders-btn" onclick="return confirm('You need to login first!');"></a>
    <div class="bi bi-person" title="Account" id="user-btn"></div>
    <div class="bi bi-list" id="menu-btn"></div>
  </div>

  <div class="search-container">
    <div class="close">
      <i class="bi bi-x" id="close"></i>
    </div>

    <h2 class="search-h2">Type anything and hit Enter</h2>

    <section class="search-form">
      <form action="search.php" method="POST">
          <input type="text" class="box" name="keyword" placeholder="Enter at least 2 characters.">
          <button type="submit" name="search_btn"><i class="bi bi-search"></i></button>
      </form>
    </section>
  </div>

  <div class="profile1" style="text-transform: uppercase;">
    <button  class="login-btn"><a href="login.php" style="text-decoration: none; color: #fff;">Login</a></button>
    <button class="signup-btn"><a href="signup.php" style="text-decoration: none; color: #fff;">Signup</a></button>   
  </div>

</header>

<script>
let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
    searchForm.classList.remove('active');
}

let searchForm = document.querySelector('.search-container');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    profile.classList.remove('active');
}

let profile = document.querySelector('.profile1');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
   searchForm.classList.remove('active');
}
let close = document.querySelector('.close');

document.querySelector('#close').onclick = () =>{
    searchForm.classList.remove('active');
}
</script>
</body>
</html>