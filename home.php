





    <!--
      - BANNER
    -->

    <div class="banner">

      <div class="container ">

       
		
		
		<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner" style="width: 100%; height: 500px;">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="./assets/images/banner.jpg" class="d-block w-100" alt="latest electronics sale" style="height:500px;">
      <div class="carousel-caption d-none d-md-block">
        <p class="banner-subtitle text-danger"><strong>Trending item</strong></p>
        <h2 class="banner-title text-white"><strong>Latest electronics sale</strong></h2>
        <p class="banner-text">starting at &#8377; <b>9999</b>.99</p>
        <a href="#" class="btn btn-danger">Shop now</a>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="./assets/images/banner1.jpg" class="d-block w-100 " alt="latest electronics sale" style="height:500px;">
      <div class="carousel-caption d-none d-md-block">
        <p class="banner-subtitle text-white"><strong>Trending item</strong></p>
        <h2 class="banner-title text-danger"><strong>Latest electronics sale</strong></h2>
        <p class="banner-text">starting at &#8377; <b>9999</b>.99</p>
        <a href="#" class="btn btn-danger">Shop now</a>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="./assets/images/banner2.jpeg" class="d-block w-100 h-60" alt="latest electronics sale" style="height:500px;">
      <div class="carousel-caption d-none d-md-block">
        <p class="banner-subtitle text-danger"><strong>Trending item</strong></p>
        <h2 class="banner-title text-white"><strong>Latest electronics sale</strong></h2>
        <p class="banner-text">starting at &#8377; <b>9999</b>.99</p>
        <a href="#" class="btn btn-danger">Shop now</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


      </div>

    </div>






    





    <!--
      - PRODUCT
    -->

    <div class="product-container">

      <div class="container">


        <!--
          - SIDEBAR
        -->

        <div class="sidebar  has-scrollbar" data-mobile-menu>

          <div class="sidebar-category" id="cat">

            <div class="sidebar-top">
              <h2 class="sidebar-title">Category</h2>

              <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>

            <ul class="sidebar-menu-category-list" >
<?php
$cat = array();
$sql = "SELECT * FROM `product`;";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    if (isset($cat[$row['category']])) {
        $cat[$row['category']] += 1;
    } else {
        $cat[$row['category']] = 1;
    }
}

foreach ($cat as $category => $count) {
    echo '<li class="sidebar-menu-category">
                <p class="menu-title"><a href="./?category=' . htmlspecialchars($category) . '#show_product">' . htmlspecialchars($category) . ' (' . $count . ')</a></p>
				
          </li>';
}

// Optional: Debugging
// var_dump($cat);
?>

             

            </ul>

          </div>

          <div class="product-showcase">

            <h3 class="showcase-heading">best sellers</h3>

            <div class="showcase-wrapper">

              <div class="showcase-container">

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/icons/laptop.jpeg" alt="laptops" width="75" height="75"
                      class="showcase-img">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Laptops</h4>
                    </a>

                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>₹50000.00</del>
                      <p class="price">₹40000.00</p>
                    </div>

                  </div>

                </div>

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/icons/phone.jpeg" alt="phone" class="showcase-img"
                      width="75" height="75">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Mobiles</h4>
                    </a>
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-half-outline"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>₹16999.00</del>
                      <p class="price">₹15999.00</p>
                    </div>

                  </div>

                </div>

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/icons/airpod.jpeg" alt="headphones" class="showcase-img" width="75"
                      height="75">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Headphones</h4>
                    </a>
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-half-outline"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>₹3500.00</del>
                      <p class="price">₹2500.00</p>
                    </div>

                  </div>

                </div>

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/icons/watch.svg" alt="watch" class="showcase-img" width="75"
                      height="75">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">Smart Watches</h4>
                    </a>
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>₹4000.00</del>
                      <p class="price">₹3000.00</p>
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <div class="product-box">

          
		  
		   <!--
            - PRODUCT FEATURED
          -->

<div class="product-featured" id="dd">
  <h2 class="title">Deal of the day</h2>

  <div class="showcase-wrapper has-scrollbar">
    <div class="showcase-container">
      <div id="dealOfDayCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
        <div class="carousel-inner">

          <?php
          $sql = "SELECT * FROM `product` WHERE `product_name` = 'Samsung Galaxy S25' OR `product_name` = 'MACBOOK AIR 1';";
          $result = mysqli_query($con, $sql);
          $active = true;

          while ($row = mysqli_fetch_assoc($result)) {
			  $images = json_decode($row['imgs_link'], true);
               $image_path = $images[0]; 

			  
              echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">
                      <div class="showcase">
                        <div class="showcase-banner">
                          <img src="./assets/images/' .$image_path . '"    alt="' . $row['product_name'] . '" class="showcase-img">
                        </div>
                        <div class="showcase-content">
                          <a href="#">
                            <h3 class="showcase-title">' . $row['product_name'] . '</h3>
                          </a>
                          <div class="showcase-rating">
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star-outline"></ion-icon>
                            <ion-icon name="star-outline"></ion-icon>
                          </div>
                          <p class="showcase-desc">' . base64_decode($row['short_des']) . '</p>
                          <div class="price-box">
                            <p class="price">₹' . $row['product_price'] . '</p>
                            <del>₹' . $row['product_price'] + ($row['product_price'] * $row['discount'])/100 . '</del>
                          </div>
                          <a href="./?a2c='.$row['pid'].'"><button class="add-cart-btn">add to cart</button></a>
                        </div>
                      </div>
                    </div>';
              $active = false; 
          }
          ?>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#dealOfDayCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#dealOfDayCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</div>


<!--
            - PRODUCT GRID
          -->

 <div class="product-main">
  <h2 class="title">Products</h2>
  <div class="product-grid" id="show_product">        
<?php

$sql = "SELECT * FROM `product` ".(isset($_POST['q'])?"WHERE `product_name` LIKE '%".$_POST['search']."%' OR `brand_name` LIKE '%".$_POST['search']."%'": "")."".(isset($_REQUEST['category'])?"WHERE `category` = '".$_REQUEST['category']."'": "").";";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  
  $images = json_decode($row['imgs_link'], true);
  $image_path = $images[0];
  //$image_path1 = $images[1];
  $original_price = $row['product_price'];
  $discount = $row['discount'];
  $discounted_price = $original_price - ($original_price * $discount / 100);

  echo '
    <div class="showcase">
 <a href="./?product&p='.$row['pid'].'">
      <div class="showcase-banner">

       <img src="./assets/images/products/'.$image_path.'" alt="'.$row['product_name'].'" width="300" class="product-img default">
       <img src="./assets/images/products/'.$image_path.'" alt="'.$row['product_name'].'" width="300" class="product-img hover">


        <p class="showcase-badge">'.intval($row['discount']).'% Off</p>

        <div class="showcase-actions">

          <a href="./?wl='.$row['pid'].'"><button class="btn-action">
            <ion-icon name="'.(array_key_exists($row['pid'],$_SESSION['wishlist'])? "heart" : "heart-outline").'"></ion-icon>
          </button></a>

          <a href="./?a2c='.$row['pid'].' "><button class="btn-action">
            <ion-icon name="bag-add-outline"></ion-icon>
          </button>
           </a>
        </div>	

      </div>

      <div class="showcase-content">

       

       
          <h3 class="showcase-title">'.$row['product_name'].'</h3>
        

        <div class="showcase-rating">
          <ion-icon name="star"></ion-icon>
          <ion-icon name="star"></ion-icon>
          <ion-icon name="star"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
          <ion-icon name="star-outline"></ion-icon>
        </div>

        <div class="price-box">
          <p class="price">₹'.number_format($discounted_price, 2).'</p>
          <del>₹'.number_format($original_price, 2).'</del>
        </div>

      </div>
</a>
    </div> 
  ';
}
?>
  </div>
</div>
		  



          




    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

      <div class="container">

        <div class="testimonials-box" id="testim">

          <!--
            - TESTIMONIALS
          -->

          <div class="testimonial">

            <h2 class="title">testimonial</h2>

            <div class="testimonial-card">

              <img src="./assets/images/icons/deep.jpeg" alt="alan doe" class="testimonial-banner" width="80" height="80">

              <p class="testimonial-name"> online Electronic Shop</p>

              <p class="testimonial-title">CEO & Founder </p>

              <img src="./assets/images/icons/quotes.svg" alt="quotation" class="quotation-img" width="26">

              <p class="testimonial-desc">
                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                dolor dolor sit amet.
              </p>

            </div>

          </div>



          <!--
            - CTA
          -->

          <div class="cta-container">

            <img src="./assets/images/icons/summer collection.avif" alt="summer collection" class="cta-banner">

            <a href="#" class="cta-content">

              <p class="discount">25% Discount</p>

              <h2 class="cta-title">Summer collection</h2>

              <p class="cta-text">Starting @ ₹10000</p>

              <button class="cta-btn">Shop now</button>

            </a>

          </div>



          <!--
            - SERVICE
          -->

          <div class="service" id ="service">

            <h2 class="title">Our Services</h2>

            <div class="service-container">

              <a href="#" class="service-item">

                <div class="service-icon">
                  <ion-icon name="boat-outline"></ion-icon>
                </div>

                <div class="service-content">

                  <h3 class="service-title">Worldwide Delivery</h3>
                  <p class="service-desc">For Order Over ₹100000</p>

                </div>

              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="rocket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Next Day delivery</h3>
                  <p class="service-desc">India Orders Only</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Best Online Support</h3>
                  <p class="service-desc">Hours: 8AM - 11PM</p>
              
                </div>
              
              </a>

              <a href="./?home#Refunds" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="arrow-undo-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Return Policy</h3>
                  <p class="service-desc">Easy & Free Return</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="ticket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">30% money back</h3>
                  <p class="service-desc">For Order Over ₹100000</p>
              
                </div>
              
              </a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - BLOG
    -->

    
