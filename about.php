<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - Cafe 66</title>
  <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    
<button onclick="topFunction()" class="myBtn" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>

<!-- header section starts  -->

<?php include 'header.php'; ?>

<!-- header section ends -->
<div class="page-bc" id="page-bc">
            <h1>About</h1>
            <ul class="breadcrumb" style="background-color:#000;">
                <li><a href="home.php">Home</a></li>
                <li>About</li>
            </ul>
        </div>

<!-- about section starts  -->

<section class="about" id="about">

    <div class="row">

        <div class="image">
            <img src="assets/images/p3.jpg" alt="">
        </div>

        <div class="content">
            <h1 class="about-heading">Welcome to our Cafe!</h1>
            <h3>Discover your special cup of drinks here at Cafe 66.</h3>
            <p>We are a cozy cafe located at Donsol, Sorsogon. Our cafe is a great place to unwind and enjoy a delicious cup of coffee or tea while catching up with friends or taking a break from the day. We also offer a variety of snacks and meals, as well as specialty coffees, non-coffees, and teas.</p>
            <p>Our cafe is dedicated to providing the best quality and service to our customers. We strive to make every visit a memorable one, with a warm and inviting atmosphere and friendly staff. We believe in making every guest feel welcome and at home in our cafe.</p>
            <p>We look forward to seeing you soon!</p>
        </div>
    </div>

</section>

<!-- facebook section starts -->

<div class="heading-margin">
    <h1 class="heading">GALLERY</h1>
    <p class="sub-heading">Some snaps in our Cafe. #instagrammable</p>
  </div>
  
  <section class="facebook" id="facebook" style="margin-bottom: 50px;">
    <div class="box-container">
  
      <div class="box">
          <img src="assets/images/gallery1.jpg" alt="">
      </div>
      <div class="box">
          <img src="assets/images/gallery2.jpg" alt="">
      </div>
      <div class="box">
          <img src="assets/images/gallery3.jpg" alt="">
      </div>
      <div class="box">
          <img src="assets/images/gallery4.jpg" alt="">
      </div>
  
    </div>
  </section>
  
<!-- facebook section ends -->

<!-- review section starts  -->

<section class="testimonial text-center" style="background: url(assets/images/rbg1.jpg); background-size:cover;">
  <div class="container">

    <div class="heading-review white-heading">Reviews</div>
    <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel">
       
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <div class="testimonial4_slide">
            <img src="assets/images/review1-pic.jpg" class="img-circle img-responsive" />
            <p>"Every Cup of Tea and Drinks are prepared with love and extra care that you can taste and feel it in ur drinks."</p>
            <h4>Arturo Daquiz Alafriz Jr.</h4>
          </div>
        </div>
        <div class="carousel-item">
          <div class="testimonial4_slide">
            <img src="assets/images/review2-pic.jpg" class="img-circle img-responsive" />
            <p>"🥰🥰🥰 the best taste <br> Tea with a Twist🥰🥰🥰"</p>
            <h4>Momo Worx</h4>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#testimonial4" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#testimonial4" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  </div>
</section>

<!-- review section ends -->

<!-- footer section starts  -->

<?php include 'footer.php'; ?>

<!-- footer section ends -->

<script>
  var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 8000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
  });
</script>

<script>
  const mybutton = document.querySelector(".myBtn");

  window.onscroll = function() {scrollFunction()};
  
  function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	  mybutton.style.display = "block";
	} else {
	  mybutton.style.display = "none";
	}
  }
  
  function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
  }
</script>

<!-- custom js file link  -->
<script src="assets/js/script.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>