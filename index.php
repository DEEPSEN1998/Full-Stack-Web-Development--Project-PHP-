
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include './admin/db.php';
include 'header.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electroshop</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style-prefix.css">
 

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="./assets/css/style.css">


</head>

<body>


  <div class="overlay" data-overlay></div>

  

  <!--
    - HEADER
  -->

  <header>

    <div class="header-top">

      <div class="container">

        <ul class="header-social-container">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

        <div class="header-alert-news">
          <p>
            <b>Welcome to</b>
            Our Website
          </p>
        </div>

        <div class="header-top-actions">

          <?php
				  if (isset($_SESSION['ecom'])){
					   ?><a href="./?order"><button class="w3-button w3-red"  >Orders</button> </a>
					   <a href="./?logout"><button class="w3-button w3-red"  >Logout</button> </a>
				  <?php }else{
					  ?>
					   <button class="w3-button w3-red" onclick="document.getElementById('authModal').style.display='block'" >Login/Sign up</button>
					  
				  <?php }
				  
				  ?>
		 
        </div>

      </div>

    </div>
	
	
	<div id="authModal" class="w3-modal" style="display:none;z-index:5;">
    <div class="w3-modal-content w3-card-4 w3-round w3-animate-zoom" style="max-width: 400px;">
        <header class="w3-container w3-teal w3-center">
            <span onclick="document.getElementById('authModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;</span>
				  
            <h3 class="w3-strong"> Login / Sign Up</h3>
        </header>

        <div class="w3-container w3-padding">
            <!-- Tabs -->
            <div class="w3-bar w3-light-grey">
                <button class="w3-bar-item w3-button w3-blue tab_btn" onclick="openTab(this, 'Login')">Login</button>
                <button class="w3-bar-item w3-button tab_btn" onclick="openTab(this, 'Signup')">Sign Up</button>
            </div>

            <!-- Login Form -->
			<form action="" method="POST">
            <div id="Login" class="w3-container tab w3-padding">
                <label><b>Email</b></label>
                <input class="w3-input w3-border" type="email" name="email" placeholder="Enter Email">
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" name="password" placeholder="Enter Password">
                <button class="w3-button w3-teal w3-margin-top w3-block" name="login">Login</button>
            </div>
			</form>

            <!-- Sign Up Form -->
			<form action="" method="POST">
            <div id="Signup" class="w3-container tab w3-padding" style="display:none;">
                <label><b>Name</b></label>
                <input class="w3-input w3-border" name ="name" type="text" placeholder="Enter Name">
                <label><b>Email</b></label>
                <input class="w3-input w3-border" name="email" type="email" placeholder="Enter Email">
				<label><b>Phone</b></label>
                <input class="w3-input w3-border" name="phone" type="text" placeholder="Enter Phone">
				<label><b>Address</b></label>
                <textarea class="w3-input w3-border" name="address" rows="1" cols="3" placeholder="Enter address" style="height:80px;"></textarea>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" name="password" type="password" placeholder="Create Password">
                <button class="w3-button w3-green w3-margin-top w3-block" name="signup">Sign Up</button>
            </div>
			</form>
        </div>
    </div>
</div>
	
	

    <div class="header-main">

      <div class="container">

        <a href="#" class="header-logo">
          <img src="./assets/images/icons/electroshop.png" alt="Anon's logo" width="120" height="100">
        </a>

        <div class="header-search-container">
          <form action="./#show_product" method="post">
          <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

          <button class="search-btn" name="q">
            <ion-icon name="search-outline"></ion-icon>
          </button>
         </form>
        </div>

        <div class="header-user-actions">

          


         <a href="./?wishlist"> <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count"><?php echo isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0; ?></span>
          </button></a>

         <a href="./?cart"><button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
          </button>
         </a>
        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu" style="background-color: antiquewhite;margin-bottom: 8px;">

      <div class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="./?home" class="menu-title">Home</a>
          </li>

          <li class="menu-category">
            <a href="./?home#cat" class="menu-title">Categories</a>

            <div class="dropdown-panel">

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="./?home#cat">Electronics</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#cat">Desktop</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#cat">Laptop</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#cat">Camera</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#cat">Tablet</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#cat">Headphone</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#cat">
                    <img src="./assets/images/electronics-banner-1.jpg" alt="headphone collection" width="250"
                      height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">Home appliances</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">Refrigetor</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">Washing machine</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">Fans</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">Air Cooler</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">Mixers</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#ca./?home#cat">
                    <img src="./assets/images/icons/ac2.jpg" alt="appliances" width="250" height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="./?home#ca./?home#ca./?home#cat">IT Accessories</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Printer</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">router</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Projector</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Pendrive</a>
                </li>

                

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">
                    <img src="./assets/images/icons/router.jpg" alt="router" width="250" height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="./?home#ca./?home#ca./?home#cat">Electronics</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Smart Watch</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Smart TV</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Keyboard</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Mouse</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">Microphone</a>
                </li>

                <li class="panel-list-item">
                  <a href="./?home#ca./?home#ca./?home#cat">
                    <img src="./assets/images/electronics-banner-2.jpg" alt="mouse collection" width="250" height="119">
                  </a>
                </li>

              </ul>

            </div>
          </li>

          <li class="menu-category">
            <a href="./?home#cat" class="menu-title">Products</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="./?home#cat">Mobiles</a>
              </li>

              <li class="dropdown-item">
                <a href="./?home#cat">Laptops</a>
              </li>

              <li class="dropdown-item">
                <a href="./?home#cat">IT Accessories</a>
              </li>

              <li class="dropdown-item">
                <a href="./?home#cat">Home Appliances</a>
              </li>

            </ul>
          </li>

          

          <li class="menu-category">
            <a href="./#contact" class="menu-title">Contact Us</a>

            
            
          </li>

          <li class="menu-category">
            <a href="./#contact" class="menu-title">About Us</a>

            
          </li>

          <li class="menu-category">
            <a href="./?home#testim" class="menu-title">Blog</a>
          </li>

          <li class="menu-category">
            <a href="./?home#dd" class="menu-title">Hot Offers</a>
          </li>

        </ul>

      </div>

    </nav>

    

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">
        <li class="menu-category">
          <a href="#" class="menu-title">Blog</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li>

      </ul>

      <div class="menu-bottom">

        <ul class="menu-category-list">

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Espa&ntilde;ol</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Fren&ccedil;h</a>
              </li>

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">USD &dollar;</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">EUR &euro;</a>
              </li>
            </ul>
          </li>

        </ul>

        <ul class="menu-social-container">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </nav>

  </header>

  <!--
    - MAIN
  -->

  <main>
 <?php
 
 include $body;
 
 ?>
  </main>

  <!--
    - FOOTER
  -->

  <footer>

    

    <div class="footer-nav">

      <div class="container">

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Popular Categories</h2>
          </li>

          <li class="footer-nav-item">
            <a href="./?home#cat" class="footer-nav-link">Mobiles</a>
          </li>

          <li class="footer-nav-item">
            <a href="./?home#cat" class="footer-nav-link">Electronic Accessories</a>
          </li>

          <li class="footer-nav-item">
            <a href="./?home#cat" class="footer-nav-link">Laptops</a>
          </li>

          <li class="footer-nav-item">
            <a href="./?home#cat" class="footer-nav-link">Router</a>
          </li>

          <li class="footer-nav-item">
            <a href="./?home#cat" class="footer-nav-link">Watches</a>
          </li>

        </ul>

        

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Our policies</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?terms#Refunds" class="footer-nav-link">Refund</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?terms#pp" class="footer-nav-link">privacy</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?terms#tc" class="footer-nav-link">Terms and conditions</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?home#testim" class="footer-nav-link">About us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Secure payment</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Services</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?home#service" class="footer-nav-link">Prices drop</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?home#service" class="footer-nav-link">New products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?home#service" class="footer-nav-link">Best sales</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?home#service" class="footer-nav-link">Delivery</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="./?home#service" class="footer-nav-link">Sitemap</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list" id="contact">

          <li class="footer-nav-item">
            <h2 class="nav-title">Contact</h2>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="location-outline"></ion-icon>
            </div>

            <address class="content" >
              16/7 ashokenagar, North 24 pgs
            </address>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="call-outline"></ion-icon>
            </div>

            <a href="tel:+607936-8058" class="footer-nav-link">9064094115</a>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="mail-outline"></ion-icon>
            </div>

            <a href="mailto:example@gmail.com" class="footer-nav-link">dsen6072@gmail.com</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item" >
            <h2 class="nav-title">Follow Us</h2>
          </li>

          <li>
            <ul class="social-link">

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-linkedin"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

            </ul>
          </li>

        </ul>

      </div>

    </div>

    <div class="footer-bottom">

      <div class="container">

        <img src="./assets/images/payment.png" alt="payment method" class="payment-img">

        <p class="copyright">
          Copyright &copy; <a href="#">2025</a> all rights reserved.
        </p>

      </div>

    </div>

  </footer>






  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
  window.onload = function () {
    if (window.location.hash === '#login') {
      document.getElementById('authModal').style.display = 'block';
      openTab(document.querySelector("[onclick*='Login']"), 'Login');
    } else if (window.location.hash === '#signup') {
      document.getElementById('authModal').style.display = 'block';
      openTab(document.querySelector("[onclick*='Signup']"), 'Signup');
    }
  };

  function openTab(element, tabName) {
    const tabContainers = document.getElementsByClassName('tab');
    for (let tab of tabContainers) tab.style.display = 'none';

    const tabButtons = document.getElementsByClassName('tab_btn');
    for (let btn of tabButtons) btn.classList.remove('w3-blue');

    document.getElementById(tabName).style.display = 'block';
    element.classList.add('w3-blue');
  }
</script>



</html>


