<?php
 
require_once('../helper/check_admin.php');

session_start();
$isAdmin = isAdmin();
 
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
    />
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    ></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
      integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
      crossorigin="anonymous"
    />
<link rel="stylesheet" href="../styles//home_style.css"/>
  </head>

  <body>


  <?php
    
    if ($isAdmin) {
        include('admin_navbar.php');
    } else {
        include('user_navbar.php');
    }
    ?>




    <!-- ______________________________slider_________________________________-->
    <div class="div1">
      <div class="split-slideshow">
        <div class="slideshow">
          <div class="slider">
            <div class="item">
              <img
                src="https://niococktails.co.uk/cdn/shop/articles/mocktail.jpg?v=1643106436"
              />
            </div>
            <div class="item">
              <img
                src="https://imgeng.jagran.com/images/2023/aug/herbal-drinks-for-health1692251498997.jpg"
              />
            </div>
            <div class="item">
              <img
                src="https://www.shutterstock.com/image-photo/flat-lay-composition-bottles-delicious-600nw-1845213580.jpg"
              />
            </div>
            <div class="item">
              <img
                src="https://unocasa.com/cdn/shop/articles/types_of_coffee_91a828a5-7ff3-427d-acaa-c8b7289c9e5a_1024x.jpg?v=1621261041"
              />
            </div>
          </div>
        </div>
        <div class="slideshow-text">
          <div class="item">Special</div>
          <div class="item">Herbs</div>
          <div class="item">Fruits</div>
          <div class="item">Caffien</div>
        </div>
      </div>
    </div>

    <div class="the-most" target="_blank">
      <h1 class="header-of-drinks">Drinks That We Offer</h1>

    <!-- ______________________________drinks cards_________________________________-->
      <div class="container">
    <!-- First Row -->
    <div class="row">
    <div class="col-md-4">
            <div class="cardcontainer">
                <div class="photo">
                    <img src="https://www.lovefoodhatewaste.com/sites/default/files/styles/16_9_two_column/public/2022-08/Fruit-juice-sh1489857866.jpg?h=d975d7c4&itok=X4a-JqOS">
                    <div class="type2">Cold</div>
                </div>
                <div class="content">
                    <p class="txt4">Orange Juice</p>
                </div>
                <div class="footer">
                    <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="cardcontainer">
                <div class="photo">
                    <img src="https://www.barberries.ae/wp-content/uploads/2023/03/Avocado-Juice-.jpg">
                    <div class="type2">Cold</div>
                </div>
                <div class="content">
                    <p class="txt4">Avocado Juice</p>
                </div>
                <div class="footer">
                    <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-margin"></div>
    <!-- Second Row -->
    <div class="row">
    <div class="col-md-4">
            <div class="cardcontainer">
                <div class="photo">
                    <img src="https://d2s742iet3d3t1.cloudfront.net/restaurants/restaurant-145194000000000000/menu/items/3/item-400000035902506543_1699388715.png?size=medium">
                    <div class="type1">Hot</div>
                </div>
                <div class="content">
                    <p class="txt4">Green Tea</p>
                </div>
                <div class="footer">
                    <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="cardcontainer">
                <div class="photo">
                    <img src="https://img.freepik.com/premium-photo/banana-smoothie-with-white-background_741910-11611.jpg">
                    <div class="type2">Cold</div>
                </div>
                <div class="content">
                    <p class="txt4">Banana Juice</p>
                </div>
                <div class="footer">
                    <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                </div>
            </div>
        </div>
    </div>


    <div class="custom-margin"></div>

    
    <!-- Third Row -->
    <div class="row">
    <div class="col-md-4">
            <div class="cardcontainer">
                <div class="photo">
                    <img src="https://somedayilllearn.com/wp-content/uploads/2020/05/cup-of-black-coffee-scaled-720x720.jpeg">
                    <div class="type1">Hot</div>
                </div>
                <div class="content">
                    <p class="txt4">Black Coffee</p>
                </div>
                <div class="footer">
                    <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="cardcontainer">
                <div class="photo">
                    <img src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2015/11/18/2/FNM_120115-Classic-Hot-Chocolate-Recipe_s4x3.jpg.rend.hgtvcom.616.462.suffix/1448314905572.jpeg">
                    <div class="type1">Hot</div>
                </div>
                <div class="content">
                    <p class="txt4">Hot Chocolate</p>
                </div>
                <div class="footer">
                    <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ______________________________order_________________________________-->
    <div class="container1  mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="d-flex flex-column">
                    <div class="p-2 bg-white mt-4 rounded ">
                        <div class="d-flex flex-row align-items-center">
                            <div class="mr-1 product-item"><img class="rounded" src="https://i.imgur.com/XiFJkhI.jpg" width="70"></div>
                            <div class="d-flex flex-column align-items-center product-details">
                                <span class="font-weight-bold product-item">Basic T-shirt</span>
                            </div>
                            <div class=" d-flex flex-row align-items-center qty">
                                <i class="product-item fa fa-minus text-danger"></i>
                                <h5 class="product-item text-grey mt-1 mr-1 ml-1">2</h5>
                                <i class="product-item fa fa-plus text-success"></i>
                            </div>
                            <div>
                                <h5 class="product-item text-grey">$20.00</h5>
                            </div>
                            <div class=" d-flex align-items-center">
                                <i class="product-item fa fa-trash mb-1 text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <div class="order-notes">
                      <label>Notes</label>
                      <br>
                      <input></input>
      </div>
      <div class="order-room">
      <label for="rooms">Room:</label>

<select name="rooms" id="cars">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option><!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Document</title>
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
      />
      <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        crossorigin="anonymous"
      ></script>
      <link
        rel="stylesheet"
        type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
      />
      <link
        rel="stylesheet"
        type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
      />
      <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
      ></script>
      <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
        crossorigin="anonymous"
      />
  
     <link rel="stylesheet" href="../styles/home_style.css" />
    </head>
  
    <body>
      <!-- ______________________________slider_________________________________-->
      <div class="div1">
        <div class="split-slideshow">
          <div class="slideshow">
            <div class="slider">
              <div class="item">
                <img
                  src="https://niococktails.co.uk/cdn/shop/articles/mocktail.jpg?v=1643106436"
                />
              </div>
              <div class="item">
                <img
                  src="https://imgeng.jagran.com/images/2023/aug/herbal-drinks-for-health1692251498997.jpg"
                />
              </div>
              <div class="item">
                <img
                  src="https://www.shutterstock.com/image-photo/flat-lay-composition-bottles-delicious-600nw-1845213580.jpg"
                />
              </div>
              <div class="item">
                <img
                  src="https://unocasa.com/cdn/shop/articles/types_of_coffee_91a828a5-7ff3-427d-acaa-c8b7289c9e5a_1024x.jpg?v=1621261041"
                />
              </div>
            </div>
          </div>
          <div class="slideshow-text">
            <div class="item">Special</div>
            <div class="item">Herbs</div>
            <div class="item">Fruits</div>
            <div class="item">Caffien</div>
          </div>
        </div>
      </div>
  
      <div class="the-most" target="_blank">
        <h1 class="header-of-drinks">Drinks That We Offer</h1>
  
      <!-- ______________________________drinks cards_________________________________-->
        <div class="container">
      <!-- First Row -->
      <div class="row">
      <div class="col-md-4">
              <div class="cardcontainer">
                  <div class="photo">
                      <img src="https://www.lovefoodhatewaste.com/sites/default/files/styles/16_9_two_column/public/2022-08/Fruit-juice-sh1489857866.jpg?h=d975d7c4&itok=X4a-JqOS">
                      <div class="type2">Cold</div>
                  </div>
                  <div class="content">
                      <p class="txt4">Orange Juice</p>
                  </div>
                  <div class="footer">
                      <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="cardcontainer">
                  <div class="photo">
                      <img src="https://www.barberries.ae/wp-content/uploads/2023/03/Avocado-Juice-.jpg">
                      <div class="type2">Cold</div>
                  </div>
                  <div class="content">
                      <p class="txt4">Avocado Juice</p>
                  </div>
                  <div class="footer">
                      <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="custom-margin"></div>
      <!-- Second Row -->
      <div class="row">
      <div class="col-md-4">
              <div class="cardcontainer">
                  <div class="photo">
                      <img src="https://d2s742iet3d3t1.cloudfront.net/restaurants/restaurant-145194000000000000/menu/items/3/item-400000035902506543_1699388715.png?size=medium">
                      <div class="type1">Hot</div>
                  </div>
                  <div class="content">
                      <p class="txt4">Green Tea</p>
                  </div>
                  <div class="footer">
                      <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="cardcontainer">
                  <div class="photo">
                      <img src="https://img.freepik.com/premium-photo/banana-smoothie-with-white-background_741910-11611.jpg">
                      <div class="type2">Cold</div>
                  </div>
                  <div class="content">
                      <p class="txt4">Banana Juice</p>
                  </div>
                  <div class="footer">
                      <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                  </div>
              </div>
          </div>
      </div>
  
  
      <div class="custom-margin"></div>
  
      
      <!-- Third Row -->
      <div class="row">
      <div class="col-md-4">
              <div class="cardcontainer">
                  <div class="photo">
                      <img src="https://somedayilllearn.com/wp-content/uploads/2020/05/cup-of-black-coffee-scaled-720x720.jpeg">
                      <div class="type1">Hot</div>
                  </div>
                  <div class="content">
                      <p class="txt4">Black Coffee</p>
                  </div>
                  <div class="footer">
                      <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="cardcontainer">
                  <div class="photo">
                      <img src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2015/11/18/2/FNM_120115-Classic-Hot-Chocolate-Recipe_s4x3.jpg.rend.hgtvcom.616.462.suffix/1448314905572.jpeg">
                      <div class="type1">Hot</div>
                  </div>
                  <div class="content">
                      <p class="txt4">Hot Chocolate</p>
                  </div>
                  <div class="footer">
                      <p class="txt3">Price: <i class="fas fa-dollar-sign"></i>10</p>
                  </div>
              </div>
          </div>
      </div>
      <!-- ______________________________order_________________________________-->
      <div class="container1  mb-5">
          <div class="d-flex justify-content-center row">
              <div class="col-md-8">
                  <div class="d-flex flex-column">
                      <div class="p-2 bg-white mt-4 rounded ">
                          <div class="d-flex flex-row align-items-center">
                              <div class="mr-1 product-item"><img class="rounded" src="https://i.imgur.com/XiFJkhI.jpg" width="70"></div>
                              <div class="d-flex flex-column align-items-center product-details">
                                  <span class="font-weight-bold product-item">Basic T-shirt</span>
                              </div>
                              <div class=" d-flex flex-row align-items-center qty">
                                  <i class="product-item fa fa-minus text-danger"></i>
                                  <h5 class="product-item text-grey mt-1 mr-1 ml-1">2</h5>
                                  <i class="product-item fa fa-plus text-success"></i>
                              </div>
                              <div>
                                  <h5 class="product-item text-grey">$20.00</h5>
                              </div>
                              <div class=" d-flex align-items-center">
                                  <i class="product-item fa fa-trash mb-1 text-danger"></i>
                              </div>
                          </div>
                      </div>

        <div class="order-room">
        <label for="rooms">Room:</label>
  
  <select name="rooms" id="cars">
    <option value="volvo"></option>
    <option value="saab"></option>
    <option value="mercedes"></option>
    <option value="audi"></option>
  </select>
        </div>
                      <button type="button" class="btn btn-success Success">Confirm</button>
                    </div>
                  </div>
                </div>
  
  </div>
  
</select>

                </div>
              </div>

</div>

    <script>
      $(document).ready(function () {
        var $slider = $(".slideshow .slider"),
          maxItems = $(".item", $slider).length,
          dragging = false,
          tracking,
          rightTracking;

        $sliderRight = $(".slideshow")
          .clone()
          .addClass("slideshow-right")
          .appendTo($(".split-slideshow"));

        rightItems = $(".item", $sliderRight).toArray();
        reverseItems = rightItems.reverse();
        $(".slider", $sliderRight).html("");
        for (i = 0; i < maxItems; i++) {
          $(reverseItems[i]).appendTo($(".slider", $sliderRight));
        }

        $slider.addClass("slideshow-left");
        $(".slideshow-left")
          .slick({
            vertical: true,
            verticalSwiping: true,
            arrows: false,
            infinite: true,
            dots: true,
            speed: 1000,
            cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
          })
          .on("beforeChange", function (event, slick, currentSlide, nextSlide) {
            if (
              currentSlide > nextSlide &&
              nextSlide == 0 &&
              currentSlide == maxItems - 1
            ) {
              $(".slideshow-right .slider").slick("slickGoTo", -1);
              $(".slideshow-text").slick("slickGoTo", maxItems);
            } else if (
              currentSlide < nextSlide &&
              currentSlide == 0 &&
              nextSlide == maxItems - 1
            ) {
              $(".slideshow-right .slider").slick("slickGoTo", maxItems);
              $(".slideshow-text").slick("slickGoTo", -1);
            } else {
              $(".slideshow-right .slider").slick(
                "slickGoTo",
                maxItems - 1 - nextSlide
              );
              $(".slideshow-text").slick("slickGoTo", nextSlide);
            }
          })
          .on("mousewheel", function (event) {
            event.preventDefault();
            if (event.deltaX > 0 || event.deltaY < 0) {
              $(this).slick("slickNext");
            } else if (event.deltaX < 0 || event.deltaY > 0) {
              $(this).slick("slickPrev");
            }
          })
          .on("mousedown touchstart", function () {
            dragging = true;
            tracking = $(".slick-track", $slider).css("transform");
            tracking = parseInt(tracking.split(",")[5]);
            rightTracking = $(".slideshow-right .slick-track").css("transform");
            rightTracking = parseInt(rightTracking.split(",")[5]);
          })
          .on("mousemove touchmove", function () {
            if (dragging) {
              newTracking = $(".slideshow-left .slick-track").css("transform");
              newTracking = parseInt(newTracking.split(",")[5]);
              diffTracking = newTracking - tracking;
              $(".slideshow-right .slick-track").css({
                transform:
                  "matrix(1, 0, 0, 1, 0, " +
                  (rightTracking - diffTracking) +
                  ")",
              });
            }
          })
          .on("mouseleave touchend mouseup", function () {
            dragging = false;
          });

        $(".slideshow-right .slider").slick({
          swipe: false,
          vertical: true,
          arrows: false,
          infinite: true,
          speed: 950,
          cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
          initialSlide: maxItems - 1,
        });
        $(".slideshow-text").slick({
          swipe: false,
          vertical: true,
          arrows: false,
          infinite: true,
          speed: 900,
          cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
        });
      });
    </script>
  </body>
</html>
