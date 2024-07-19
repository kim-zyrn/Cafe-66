<?php

@include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe 66</title>
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

<?php include 'header1.php'; ?>

<button onclick="topFunction()" class="myBtn" title="Go to top"><i class="bi bi-arrow-up-short"></i></button>

<!-- swiper section starts  -->

<div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide" data-swiper-autoplay="5000">
      <img src="assets/images/cafe3.jpg" alt="Cafe 66" class="slide1">
      <div class="text-content1">
        <span>Better together.</span>
        <h2>Coffee Date <br> Together We Palpitate</h2>
        <a href="shop.php">Order Now</a>
      </div>
    </div>
    <div class="swiper-slide" data-swiper-autoplay="4000">
      <img src="assets/images/cafe4.jpg" alt="Cafe 66" class="slide2">
      <div class="text-content2">
        <span>It's our pleasure to serve you.</span>
        <h2>Happiness is a <br> Small Cozy Cafe</h2>
        <a href="shop.php">Order Now</a>
      </div>
    </div>
  </div>
  <div class="swiper-pagination"></div> 
</div>

<!-- swiper section ends -->

<!-- menu section starts  -->

<section class="menu-product">
  <div class="container">
        
    <div class="box">
      <figure class="product-thumb">
        <img src="assets/images/hot_coffee2.jpg" alt="">
        <div class="action-links">
          <h2 class="menu-price">From ₱130.00</h2>
          <h1 class="menu-name">Hot Latte</h1>
          <button class="menu-btn"><a href="general.php?general_category=Hot Latte">See More <i class="bi bi-arrow-right-circle"></i></a></button>
        </div>
      </figure>
    </div>
    <div class="box">
      <figure class="product-thumb">
        <img src="assets/images/milktea.jpg" alt="">
        <div class="action-links">
          <h2 class="menu-price">From ₱85.00</h2>
          <h1 class="cold-drinks">Milktea</h1>
          <button class="menu-btn"><a href="general.php?general_category=Milktea">See More <i class="bi bi-arrow-right-circle"></i></a></button>
        </div>
      </figure>
    </div>
    <div class="box">
      <figure class="product-thumb">
        <img src="assets/images/iced-coffee.jpg" alt="">
        <div class="action-links">
          <h2 class="menu-price">From ₱105.00</h2>
          <h1 class="cold-drinks">Iced Coffee</h1>
          <button class="menu-btn"><a href="general.php?general_category=Iced Coffee">See More <i class="bi bi-arrow-right-circle"></i></a></button>
        </div>
      </figure>
    </div>
    <div class="box">
      <figure class="product-thumb">
        <img src="assets/images/non-coffee.jpg" alt="">
        <div class="action-links">
          <h2 class="menu-price">From ₱120.00</h2>
          <h1 class="cold-drinks">Non Coffee</h1>
          <button class="menu-btn"><a href="general.php?general_category=Non Coffee">See More <i class="bi bi-arrow-right-circle"></i></a></button>
        </div>
      </figure>
    </div>
    <div class="box">
      <figure class="product-thumb">
        <img src="assets/images/italian-soda.jpg" alt="">
        <div class="action-links">
          <h2 class="menu-price">From ₱100.00</h2>
          <h1 class="cold-drinks">Italian Soda</h1>
          <button class="menu-btn"><a href="general.php?general_category=Italian Soda">See More <i class="bi bi-arrow-right-circle"></i></a></button>
        </div>
      </figure>
    </div>

  </div>
</section>

<!-- menu section ends -->

<section class="special-items" style="background: url(assets/images/bg-cafe.png); background-position:center; background-repeat:no-repeat; background-size: cover;">
	<div class="item-content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text">
          <h2>Cafe Hours</h2>
          <h1>Tuesday to Sunday</h1>
          <p>&nbsp;11:00 AM - 9:00 PM</p>
        </div>
      </div>
    </div>
	</div>
</section>

<!-- best seller section starts -->
<div class="seller-heading">
	<div class="heading-margin">
	  <h1 id="heading">SIGNATURE BEVERAGES</h1>
    <p id="sub-heading">Wake up to our signature drinks - the perfect start to your day!</p>
	</div>
  </div>
  
<div class="best-container">
  <div id="carouselExampleControls" class="carousel best-seller" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php
        $select_products = $conn->prepare("SELECT * FROM `products` where id IN (1,3,20,4,14,9,19,12)");
        $select_products->execute();
        if($select_products->rowCount() > 0){
          while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
      ?>
        <form action="" class="carousel-item active" method="POST">
          <div class="card">
            <div class="img-wrapper">
              <img src="assets/products/<?= $fetch_products['image']; ?>" class="d-block w-100" alt="...">
              <div class="icon-links">
                <a href="view.php?pid=<?= $fetch_products['id']; ?>" class="icon" title="Quickview"><i class="bi bi-eye"></i></a>
                <span class="icon" onclick="return confirm('You need to login first!');"><i class="bi bi-heart"></i></span>
                <span class="icon" onclick="return confirm('You need to login first!');"><i class="bi bi-cart"></i></span>
              </div>   
            </div>
            <div class="card-body">
              <h3 class="name"><a href="view.php?pid=<?= $fetch_products['id']; ?>"><?= $fetch_products['name']; ?></a></h3>
              <h6 class="category"><a href="categoryy.php?category=<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></a></h6>
              <div class="price">₱<?= $fetch_products['price1']; ?>.00 <span>(16oz)</span> &nbsp;<span class="line-divider">|</span> &nbsp;₱<?= $fetch_products['price2']; ?>.00 <span>(22oz)</span></div>
              <div class="selection">
                <select name="p_size">
                  <option value="16oz">Select size &nbsp;&nbsp;</option>
                  <option value="16oz">16oz</option>
                  <option value="22oz">22oz</option>
                </select>
                <input type="number" min="1" value="1" name="p_qty" class="quantity">
              </div>
            </div>
          </div>
        </form>
      <?php
      }
      }
      ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!-- best seller section ends -->

<!-- featured section starts -->

<div class="seller-heading">
  <div class="heading-margin">
    <h1 id="heading">SPECIAL PRODUCTS</h1>
    <p id="sub-heading">Special Flavored Iced Coffee</p>
  </div>
</div>


<section class="seller" id="seller">
  <div class="row">
    <?php
      $select_products = $conn->prepare("SELECT * FROM `products` where id IN (13,14,15,16)");
      $select_products->execute();
      if($select_products->rowCount() > 0){
        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
    ?>
      <form action="" class="col-lg-3 col-sm-6 box" method="POST">
        <div class="item">
          <div class="best-thumb">
            <img src="assets/products/<?= $fetch_products['image']; ?>" class="d-block w-100" alt="...">
            <div class="icon-links">
              <a href="view.php?pid=<?= $fetch_products['id']; ?>" class="icon" title="Quickview"><i class="bi bi-eye"></i></a>
              <span class="icon" onclick="return confirm('You need to login first!');"><i class="bi bi-heart"></i></span>
              <span class="icon" onclick="return confirm('You need to login first!');"><i class="bi bi-cart"></i></span>
            </div>   
          </div>
          <div class="content">
            <h3 class="name"><a href="view.php?pid=<?= $fetch_products['id']; ?>"><?= $fetch_products['name']; ?></a></h3>
            <h6 class="category"><a href="categoryy.php?category=<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></a></h6>
            <div class="price">₱<?= $fetch_products['price1']; ?>.00 <span>(16oz)</span> &nbsp;<span class="line-divider">|</span> &nbsp;₱<?= $fetch_products['price2']; ?>.00 <span>(22oz)</span></div>
            <div class="selection">
              <select name="p_size">
                <option value="16oz">Select size &nbsp;&nbsp;</option>
                <option value="16oz">16oz</option>
                <option value="22oz">22oz</option>
              </select>
              <input type="number" min="1" value="1" name="p_qty" class="quantity">
            </div>
          </div>
        </div>
      </form>
    <?php
    }
    }
    ?>
  </div>
</section>

<!-- featured section ends -->

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

<!-- facebook section starts -->

<div class="heading-margin">
  <h1 class="heading">FOLLOW US</h1>
  <p class="sub-heading">Like and Follow Us On Facebook And Instagram For More Updates.</p>
</div>

<section class="facebook">
  <div class="box-container">

    <div class="box">
      <a href="https://www.facebook.com/112509341341196/posts/138969395361857/?mibextid=Nif5oz"
        target="_blank">
        <img src="assets/images/fb1.jpg" alt="">
        <i class="bi bi-facebook"></i>
        <p>Today’s first customer! 🥤🍃<br>
          Thank you, Ms. Denise Belmonte!<br><br>
          April 14, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.facebook.com/112509341341196/posts/181015097823953/?mibextid=Nif5oz"
        target="_blank">
        <img src="assets/images/fb2.jpg" alt="">
        <i class="bi bi-facebook"></i>
        <p>It's International Coffee Day! 🤎☕<br>
          Avail our promo exclusively for today.<br>
          𝗕𝘂𝘆 2 on all espresso products, 𝘁𝗮𝗸𝗲 1 𝗰𝗮𝗳é 𝗰𝗼𝗻 𝗹𝗲𝗰𝗵𝗲 16oz.<br>
          See you coffee lovers!<br><br>
          October 1, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.facebook.com/112509341341196/posts/134897179102412/?mibextid=Nif5oz"
        target="_blank">
        <img src="assets/images/fb3.jpg" alt="">
        <i class="bi bi-facebook"></i>
        <p>New Additions to our Menu! 🤤😋<br>
          •Pasta Fajita<br>
          •Tuna Egg Sandwich<br> 
          •Café 66 Nachos<br><br>
          March 31, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.facebook.com/112509341341196/posts/139106358681494/?mibextid=Nif5oz"
        target="_blank">
        <img src="assets/images/fb4.jpg" alt="">
        <i class="bi bi-facebook"></i>
        <p>Sold 64+ cups today!🥺🥰 Grabe.<br>
          Maraming maraming salamat po! 🙏🏻❤️<br>
          Thank you din po sa mga nag hintay kahit sobrang daming nakapilang orders. 🥺❤️<br><br>
          April 15, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.instagram.com/p/Cgj0OkVpNcF/?utm_source=ig_web_copy_link" target="_blank">
        <img src="assets/images/insta1.jpg" alt="">
        <i class="bi bi-instagram"></i>
        <p>Laughter is brightest where the food is simply the best✨<br>
          Come and check this food combi with our Iced Coffee Matcha and Chicken Alfredo Pasta!<br>  
          You surely shouldn’t miss to try this out! You can never resist the flavors in every bite!<br>
          ©@earlvincentvista<br><br>
          July 28, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.instagram.com/p/ClYIlE7y6r7/?utm_source=ig_web_copy_link" target="_blank">
        <img src="assets/images/insta2.jpg" alt="">
        <i class="bi bi-instagram"></i>
        <p>𝐇𝐞𝐥𝐥𝐨 𝐅𝐫𝐢𝐝𝐚𝐲.<br>
          𝐖𝐞 𝐦𝐚𝐝𝐞 𝐢𝐭. ☕🤍<br><br>
          November 25, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.instagram.com/p/Cf_O61_Jght/?utm_source=ig_web_copy_link" target="_blank">
        <img src="assets/images/insta3.jpg" alt="">
        <i class="bi bi-instagram"></i>
        <p>Mocha Latte & Matcha Latte 🤎💚<br><br>
          July 14, 2022</p>
      </a>
    </div>
    <div class="box">
      <a href="https://www.instagram.com/p/CcPpufDJl_U/?utm_source=ig_web_copy_link" target="_blank">
        <img src="assets/images/insta4.jpg" alt="">
        <i class="bi bi-instagram"></i>
        <p>Mood on a rainy afternoon.<br><br>
          April 12, 2022</p>
      </a>
    </div>
    
    

  </div>
</section>


<!-- facebook section ends -->

<?php include 'footer1.php'; ?>

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

<!-- Initialize Swiper -->
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

<script>
  const multipleCardCarousel = document.querySelector('#carouselExampleControls');
if (window.matchMedia("(min-width: 300px)").matches) {
  const carousel = new bootstrap.Carousel(multipleCardCarousel, {
    interval: false
  })
   
  var carouselWidth = $('.carousel-inner')[0].scrollWidth;
  var cardWidth = $('.carousel-item').width();

  var scrollPosition = 0;

  $('.carousel-control-next').on("click", function () {
    if (scrollPosition < (carouselWidth - ( cardWidth * 3))) {
      console.log('next');
      scrollPosition = scrollPosition + cardWidth;
      $('.carousel-inner').animate({scrollLeft:
      scrollPosition},600);
    }
  });
  $('.carousel-control-prev').on("click", function () {
    if (scrollPosition > 0) {
      console.log('prev');
      scrollPosition = scrollPosition - cardWidth;
      $('.carousel-inner').animate({scrollLeft:
      scrollPosition},600);
    }
  });

} else {
  $(multipleCardCarousel).addClass("slide");
}
</script>

</body>
</html>