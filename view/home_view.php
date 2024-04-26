<?php 
require_once "../helper/db_connection _copy.php";
require_once "../model/product_model.php";
require '../config.php';

require_once "../model/order_manager.php";



// Display products
function display_in_table($rows) {
  echo <<<HTML
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
  <link rel="stylesheet" href="../styles/home_style.css" />
</head>

<body>
  <!-- ______________________________slider_________________________________-->
  <div class="div1">
    <div class="split-slideshow">
      <div class="slideshow">
        <div class="slider">
          <div class="item">
            <img src="https://niococktails.co.uk/cdn/shop/articles/mocktail.jpg?v=1643106436" />
          </div>
          <div class="item">
            <img src="https://imgeng.jagran.com/images/2023/aug/herbal-drinks-for-health1692251498997.jpg" />
          </div>
          <div class="item">
            <img src="https://www.shutterstock.com/image-photo/flat-lay-composition-bottles-delicious-600nw-1845213580.jpg" />
          </div>
          <div class="item">
            <img src="https://unocasa.com/cdn/shop/articles/types_of_coffee_91a828a5-7ff3-427d-acaa-c8b7289c9e5a_1024x.jpg?v=1621261041" />
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

    <table class="container">
      <tbody>
HTML;

for ($i = 0; $i < count($rows); $i += 2) {
  echo "<tr class='row'>";
  
  $row1 = $rows[$i];
  $name1 = $row1['name'];
  $price1 = $row1['price'];
  $image1 = $row1['image'];
  $productId1 = $row1['id']; 
  
  echo '<td class="col-md-4">
  <form method="GET">
      <input type="hidden" name="product_id" value="' . $productId1 . '">
              <div class="cardcontainer">
                  <div class="photo">
                      <button type="submit" style="border: none; background: none; padding: 0; margin: 0;">
                          <img src="' . $image1 . '" />
                      </button>
                      <div class="type2">Cold</div>
                  </div>
                  <div class="content">
                      <p class="txt4">' . $name1 . '</p>
                  </div>
                  <div class="footer">
                      <p class="txt3 price">Price: <i class="fas fa-dollar-sign"></i>' . $price1 . '</p>
                  </div>
              </div>
          </form>
        </td>';

  if ($i + 1 < count($rows)) {
      $row2 = $rows[$i + 1];
      $name2 = $row2['name'];
      $price2 = $row2['price'];
      $image2 = $row2['image'];

      echo '<td class="col-md-4">
              <div class="cardcontainer">
                <div class="photo">
                <a href="#"><img src="' . $image2 . '" /></a>
                  <div class="type2">Cold</div>
                </div>
                <div class="content">
                  <p class="txt4">' . $name2 . '</p>
                </div>
                <div class="footer">
                  <p class="txt3 price">Price: <i class="fas fa-dollar-sign"></i>' . $price2 . '</p>
                </div>
              </div>
            </td>';
  }

  echo "</tr>";
  echo '<tr class="custom-margin"></tr>'; 

}

echo <<<HTML
      </tbody>
    </table>

    <!-- ______________________________order_________________________________-->
    <table class="container1 mb-5">
      <tbody>
        <!-- Product Information -->
        <tr>
          <td colspan="5" class="p-2 bg-white mt-4 rounded">
            <div class="d-flex flex-row align-items-center">
              <!-- Product Image -->
              <div class="mr-1 product-item">
                <img class="rounded" src="https://i.imgur.com/XiFJkhI.jpg" width="70" />
              </div>
              <!-- Product Details -->
              <div class="d-flex flex-column align-items-center product-details">
                <span class="font-weight-bold product-item">Basic T-shirt</span>
              </div>
              <!-- Quantity -->
              <div class="d-flex flex-row align-items-center qty">
                <i class="product-item fa fa-minus text-danger"></i>
                <h5 class="product-item text-grey mt-1 mr-1 ml-1">2</h5>
                <i class="product-item fa fa-plus text-success"></i>
              </div>
              <!-- Price -->
              <div>
                <h5 class="product-item text-grey">$20.00</h5>
              </div>
              <!-- Remove Button -->
              <div class="d-flex align-items-center">
                <i class="product-item fa fa-trash mb-1 text-danger"></i>
              </div>
            </div>
          </td>
        </tr>
        <!-- Order Notes -->
        <tr>
          <td colspan="5" class="order-notes">
            <label>Notes</label>
            <br />
            <input type="text" placeholder="Add notes..." />
          </td>
        </tr>
        <!-- Order Room Selection -->
        <tr>
          <td colspan="5" class="order-room">
            <label for="rooms">Room:</label>
            <select name="rooms" id="rooms">
              <option value="volvo">Room 1</option>
              <option value="saab">Room 2</option>
              <option value="mercedes">Room 3</option>
              <option value="audi">Room 4</option>
            </select>
          </td>
        </tr>
        <!-- Confirm Button -->
        <tr>
          <td colspan="5" class="text-center">
            <button type="button" class="btn btn-success Success">Confirm</button>
          </td>
        </tr>
      </tbody>
    </table>

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
        .on(
          "beforeChange",
          function (event, slick, currentSlide, nextSlide) {
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
          }
        )
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
HTML;
  }
$db = new Database(host, dbname, username, password, port);
$conn = $db->connectToDatabase(); 

$rows = $db->select("products");
display_in_table($rows); 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["product_id"])) {
  $productId = $_GET["product_id"];
  
  $orderManager = new OrderManager($conn);
    $orderId = $orderManager->addProductToOrder($productId);
  
  if ($orderId !== false) {
      echo "Product added to order. Order ID: " . $orderId;
  } else {
      echo "Failed to add product to order.";
  }
} else {
  echo "Invalid request.";
}
?>