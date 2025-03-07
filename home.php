<?php  
require "config.php"; 
if(isset($_SESSION["client"])){      
    echo " ".$_SESSION["client"]["nomCl"];      
    $typeCuisine = getKitchenType();  
} else {     
    header("Location:login.php"); 
}  

if(isset($_GET["logout"])){     
    session_destroy();     
    header("Location:login.php"); 
}

$filteredDishes = []; 
$filtering = false;
if(isset($_POST['search'])){     
    $selectedType = $_POST['type_s'];     
    $selectedCategory = $_POST['categorie_s'];          
    $filteredDishes = getFilteredDishes($selectedType, $selectedCategory);
    $filtering = true; 
}       
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 



    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />  
    <title>Squiddo</title>   

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- nice select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
    <!-- slide slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha256-UK1EiopXIL+KVhfbFa8xrmAWPeBjMVdvYMYkTAEv/HI=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css.map" integrity="undefined" crossorigin="anonymous" />






    <link rel="stylesheet" href="css/home.css?v=1">
    <!--v=1 update la page-->    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <link rel="stylesheet" href="css/home.css?v=1">
    <link rel="stylesheet" href="css/responsive.css?v=1">



</head> 
<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand">
            <span>
            squiddo
            </span>
          </a>
          <div class="" id="">
            <div class="User_option">
              <a href="">
                
                
                <div>
                
                <i class="fa fa-user" aria-hidden="true"></i>  
                <span><?php 
                echo($_SESSION["client"]["nomCl"]);
                ?></span>
                <a href="home.php?logout=1"><button>logout</button></a>  
                </div>
              </a>
              
            </div>
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <img src="images/menu.png" alt="">
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="index.html">Home</a>
                <a href="about.html">About</a>
                <a href="blog.html">Blog</a>
                <a href="testimonial.html">Testimonial</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->



    <!-- slider section -->
    <section class="slider_section ">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div class="detail-box">
              <h1>
                Discover Restuarant And Food
              </h1>
              <p>
                when looking at its layout. The point of using Lorem Ipsum
              </p>
            </div>
            <div class="find_container ">
              <div class="container">
                <div class="row">
                  <div class="col">
                  <form method="POST">
                    <div class="form-row">            
            <select name="type_s" id="type_s">                 
                <option value="">Tous les types</option>                 
                <option value="Marocaine" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Marocaine') ? 'selected' : ''; ?>>Marocaine</option>                 
                <option value="Italienne" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Italienne') ? 'selected' : ''; ?>>Italienne</option>                 
                <option value="Chinoise" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Chinoise') ? 'selected' : ''; ?>>Chinoise</option>                 
                <option value="Espagnole" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Espagnole') ? 'selected' : ''; ?>>Espagnole</option>                 
                <option value="Francaise" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Francaise') ? 'selected' : ''; ?>>Francaise</option>             
            </select>             
            <select name="categorie_s" id="categorie_s">                 
                <option value="">Tous les categories</option>                 
                <option value="plat principal" <?php echo (isset($_POST['categorie_s']) && $_POST['categorie_s'] == 'plat principal') ? 'selected' : ''; ?>>plat principal</option>                 
                <option value="dessert" <?php echo (isset($_POST['categorie_s']) && $_POST['categorie_s'] == 'dessert') ? 'selected' : ''; ?>>dessert</option>                 
                <option value="entrée" <?php echo (isset($_POST['categorie_s']) && $_POST['categorie_s'] == 'entrée') ? 'selected' : ''; ?>>entrée</option>            
            </select>            
            <button name="search" type="submit" class="btn ">search</button> 
            </div>         
        </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slider_container">
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img1.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img2.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img3.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img4.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img1.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img2.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img3.png" alt="" />
          </div>
        </div>
        <div class="item">
          <div class="img-box">
            <img src="images/slider-img4.png" alt="" />
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div> 







    <div class="content">
        <?php if($filtering): ?>
            <div class="typeCuisineSection">
                <h2>Résultats de recherche</h2>
                <div class="Cards">
                    <?php foreach($filteredDishes as $dish): ?>
                        <div class='card'>
                            <img src="<?= $dish['image'] ?>">
                            <h3><?= $dish['nomPlat'] ?></h3>
                            <h4><?= $dish['categoriePlat'] ?></h4>
                            <span><?= $dish['prix'] ?>DH</span>
                            <a href=""><button>Add to cart</button></a>
                        </div>
                    <?php endforeach; ?>
                    <?php if(empty($filteredDishes)): ?>
                        <p>Aucun plat trouvé avec ces critères.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <?php foreach($typeCuisine as $type): ?>
                <div class="typeCuisineSection">
                    <h2><?= $type['TypeCuisine'] ?></h2>
                    <div class="Cards">
                        <?php
                        $Dishes = getdishesByType($type['TypeCuisine']);
                        foreach($Dishes as $dish): ?>
                            <div class='card'>
                                <img src="<?= $dish['image'] ?>">
                                <h3><?= $dish['nomPlat'] ?></h3>
                                <h4><?= $dish['categoriePlat'] ?></h4>
                                <span><?= $dish['prix'] ?>DH</span>
                                <a href=""><button>Add to cart</button></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>




    <!-- app section -->

  <section class="app_section">
    <div class="container">
      <div class="col-md-9 mx-auto">
        <div class="row">
          <div class="col-md-7 col-lg-8">
            <div class="detail-box">
              <h2>
                <span> Get the</span> <br>
                Delfood App
              </h2>
              <p>
                long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The poin
              </p>
              <div class="app_btn_box">
                <a href="" class="mr-1">
                  <img src="images/google_play.png" class="box-img" alt="">
                </a>
                <a href="">
                  <img src="images/app_store.png" class="box-img" alt="">
                </a>
              </div>
              <a href="" class="download_btn">
                Download Now
              </a>
            </div>
          </div>
          <div class="col-md-5 col-lg-4">
            <div class="img-box">
              <img src="images/mobile.png" class="box-img" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- end app section -->




    <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="col-md-11 col-lg-10 mx-auto">
        <div class="heading_container heading_center">
          <h2>
            About Us
          </h2>
        </div>
        <div class="box">
          <div class="col-md-7 mx-auto">
            <div class="img-box">
              <img src="images/about-img.jpg" class="box-img" alt="">
            </div>
          </div>
          <div class="detail-box">
            <p>
              Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable
            </p>
            <a href="">
              <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- news section -->

  <section class="news_section">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest News
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="images/n1.jpg" class="box-img" alt="">
            </div>
            <div class="detail-box">
              <h4>
                Tasty Food For you
              </h4>
              <p>
                there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined
              </p>
              <a href="">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="images/n2.jpg" class="box-img" alt="">
            </div>
            <div class="detail-box">
              <h4>
                Breakfast For you
              </h4>
              <p>
                there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined
              </p>
              <a href="">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end news section -->

  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="col-md-11 col-lg-10 mx-auto">
        <div class="heading_container heading_center">
          <h2>
            Testimonial
          </h2>
        </div>
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="detail-box">
                <h4>
                  Virginia
                </h4>
                <p>
                  Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                </p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
            </div>
            <div class="carousel-item">
              <div class="detail-box">
                <h4>
                  Virginia
                </h4>
                <p>
                  Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                </p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
            </div>
            <div class="carousel-item">
              <div class="detail-box">
                <h4>
                  Virginia
                </h4>
                <p>
                  Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and
                </p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev d-none" href="#customCarousel1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>




    
    
    <div class="footer_container">
    <!-- info section -->
    <section class="info_section ">
      <div class="container">
        <div class="contact_box">
          <a href="">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
          </a>
          <a href="">
            <i class="fa fa-phone" aria-hidden="true"></i>
          </a>
          <a href="">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </a>
        </div>
        <div class="info_links">
          <ul>
            <li class="active">
              <a href="index.html">
                Home
              </a>
            </li>
            <li>
              <a href="about.html">
                About
              </a>
            </li>
            <li>
              <a class="" href="blog.html">
                Blog
              </a>
            </li>
            <li>
              <a class="" href="testimonial.html">
                Testimonial
              </a>
            </li>
          </ul>
        </div>
        <div class="social_box">
          <a href="">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a href="">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>
    <!-- end info_section -->


    <!-- footer section -->
    <footer class="footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a><br>
          Distributed By: <a href="https://themewagon.com/">Firdaous</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->

  </div>
  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- slick  slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
</body> 
</html>