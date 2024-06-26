<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['user'])) {
  // Redirect to the login page
  header("Location: login_view.php");
  exit; // Stop further execution of the script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/home_style.css">


</head>


<body style="overflow-x:hidden">

  <?php
  //for navbar
  require_once('../helper/check_admin.php');


  $isAdmin = isAdmin();

  $image = access_image();
  $user = $_SESSION["user"];


  if ($user["role"] == 'admin') {
    include('admin_navbar.php');
  } else {
    include('user_navbar.php');
  }
  ?>

  <div class="div1">
    <div class="split-slideshow">
      <div class="slideshow">
        <div class="slider">
          <div class="item">
            <img src="https://muffinbreak.com.au/wp-content/uploads/2018/01/Drinks-1600x800.jpg" />

          </div>
          <div class="item">
            <img src="https://food-images.files.bbci.co.uk/food/recipes/iced_coffee_01204_16x9.jpg" />
          </div>
          <div class="item">
            <img src="https://insanelygoodrecipes.com/wp-content/uploads/2021/10/Smoothies-with-Fresh-Fruits-and-Berries.jpg" />
          </div>
          <div class="item">
            <img style="width:1800px" src="https://www.mashed.com/img/gallery/more-than-25-of-people-agree-this-chain-restaurant-has-the-worst-drink-menu/l-intro-1618229724.jpg" />
          </div>
        </div>
      </div>
      <div class="slideshow-text">
        <div class="item">All You Need</div>
        <div class="item">Caffien</div>
        <div class="item">Fruits</div>
        <div class="item">Special</div>
      </div>
    </div>
  </div>





  <div class="the-most " target="_blank">

    <div style="height:120px"></div>
    <form class="form header-of-drinks d-flex" method="GET">
      <input class="form-control mr-2" type="text" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-outline-light " type="submit"><i class="fas fa-search" style="color: rgb(143, 154, 33)"></i></button>
    </form>


    <h1 class="header-of-drinks">Drinks That We Offer</h1>
    <div class="products-div">
      <table class="container">
        <tbody>
          <?php
          require_once "../helper/db_connection.php";
          require_once "../model/product_model.php";
          require_once "../model/room_model.php";
          require_once '../config.php';

          function display_in_table($rows, $conn)
          {

            // Handle search///////////////////////////
            if (isset($_GET['search'])) {

              $search_query = $_GET['search'];


              $filtered_rows = array_filter($rows, function ($row) use ($search_query) {
                return stripos($row['name'], $search_query) !== false;
              });

              foreach ($filtered_rows as $row) {
                $name = $row['name'];
                $price = $row['price'];
                $image = $row['image'];
                $isAvailable = $row['isAvailable'];
                echo '<td class="col-md-4">
              <div class="cardcontainer">
                <div class="photo">
                  <a href="#"><img src="' . $image . '" /></a>
                  <div class="type2 ' . ($isAvailable == 1 ? 'green-background' : 'red-background') . '">' . ($isAvailable == 1 ? 'Available' : 'Not Available') . '</div>
                  </div>
                <div class="content">
                  <p class="txt4">' . $name . '</p>
                </div>
                <div class="footer">
                  <p class="txt3 price">Price: <i class="fas fa-dollar-sign"></i>' . $price . '</p>
                </div>
              </div>
            </td>';
              }
            } else {
              for ($i = 0; $i < count($rows); $i += 2) {
                echo "<tr class='row'>";

                $row1 = $rows[$i];
                $name1 = $row1['name'];
                $price1 = $row1['price'];
                $image1 = $row1['image'];
                $isAvailable1 = $row1['isAvailable'];
                // Assuming `id` is the unique identifier for the product
                echo '<td class="col-md-4">
                <div class="cardcontainer" data-product-id="' . $row1['id'] . '"> <!-- Set product_id -->
                  <div class="photo">
                    <a href="#"><img src="' . $image1 . '" /></a>
                    <div class="type2 ' . ($isAvailable1 == 1 ? 'green-background' : 'red-background') . '">' . ($isAvailable1 == 1 ? 'Available' : 'Not Available') . '</div>
                  </div>
                  <div class="content">
                    <p class="txt4">' . $name1 . '</p>
                  </div>
                  <div class="footer">
                    <p class="txt3 price">Price: <i class="fas fa-dollar-sign"></i>' . $price1 . '</p>
                  </div>
                </div>
                </td>';


                if ($i + 1 < count($rows)) {
                  $row2 = $rows[$i + 1];
                  $name2 = $row2['name'];
                  $price2 = $row2['price'];
                  $image2 = $row2['image'];
                  $isAvailable2 = $row2['isAvailable'];

                  // Assuming `id` is the unique identifier for the product
                  echo '<td class="col-md-4">
                <div class="cardcontainer" data-product-id="' . $row2['id'] . '"> <!-- Set product_id -->
                  <div class="photo">
                    <a href="#"><img src="' . $image2 . '" /></a>
                    <div class="type2 ' . ($isAvailable2 == 1 ? 'green-background' : 'red-background') . '">' . ($isAvailable2 == 1 ? 'Available' : 'Not Available') . '</div>
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
            }
          }

          try {
            $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
            $conn->connectToDatabase();
            $rows = Product::get_all_Products($conn->getPdo());
            display_in_table($rows, $conn);
          } catch (Exception $e) {
            var_dump($e->getMessage());
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="order-div">
      <table class="container1 mb-5">
        <tbody>
          <tr>
            <td colspan="5" class="order-notes">
              <label>Notes</label>
              <br />
              <input type="text" id="customer_notes" placeholder="Add notes..." />
            </td>
          </tr>
          <!-- Order Room Selection -->
          <tr>
            <td colspan="5" class="order-room">
              <label for="rooms">Room:</label>
              <select name="rooms" id="rooms">
                <?php
                $Rooms = Room::get_all_rooms($conn->getPdo());
                for ($i = 0; $i < count($Rooms); $i++) : ?>
                  <option value="<?php echo $Rooms[$i]['id']; ?>"><?php echo $Rooms[$i]['room_name']; ?></option>
                <?php endfor; ?>
              </select>
            </td>
          </tr>
          <!-- Order Room Selection -->
          <tr>
            <td colspan="5" class="text-center">
              <button type="button" id="placeOrder" class="btn btn-success Success">Confirm</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <script src='../controller/quantity.js'></script>
    <script src='../controller/confirmation.js'></script>
    <script src='../controller/helper.js'></script>
    <script>
      $(document).ready(function() {
        // var contentHeight = $('.the-most').height() + $('.header-of-drinks').height()-2300;
        // $('.container1').css('margin-top', contentHeight + 'px');

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
            function(event, slick, currentSlide, nextSlide) {
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
          .on("mousewheel", function(event) {
            event.preventDefault();
            if (event.deltaX > 0 || event.deltaY < 0) {
              $(this).slick("slickNext");
            } else if (event.deltaX < 0 || event.deltaY > 0) {
              $(this).slick("slickPrev");
            }
          })
          .on("mousedown touchstart", function() {
            dragging = true;
            tracking = $(".slick-track", $slider).css("transform");
            tracking = parseInt(tracking.split(",")[5]);
            rightTracking = $(".slideshow-right .slick-track").css("transform");
            rightTracking = parseInt(rightTracking.split(",")[5]);
          })
          .on("mousemove touchmove", function() {
            if (dragging) {
              newTracking = $(".slideshow-left .slick-track").css("transform");
              newTracking = parseInt(newTracking.split(",")[5]);
              diffTracking = newTracking - tracking;
              $(".slideshow-right .slick-track").css({
                transform: "matrix(1, 0, 0, 1, 0, " +
                  (rightTracking - diffTracking) +
                  ")",
              });
            }
          })
          .on("mouseleave touchend mouseup", function() {
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