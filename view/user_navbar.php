<?php
 
require_once('../helper/check_admin.php');

session_start();
$image = access_image();
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transparent Navbar</title>
  
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
  <style>
   
    
    
    .navbar {
      border-bottom: 1px solid #fff;
      background-color: rgba(0, 0, 0);
      font-family: 'Shadows Into Light', cursive;
      position: fixed;  
      top: 0; 
      left: 0;  
      width: 100%;  
      z-index: 9999;
      
    }
    .navbar-brand {
      color: #fff !important;  
      text-transform: uppercase;
      font-family: 'Shadows Into Light', cursive;
    }
    .navbar-nav .nav-link.active {
        color: #28a745 !important; 
      }
    .navbar-nav .nav-link {
      color: #fff !important; 
    }
     
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#"><i class="fas fa-coffee"></i>Your Cafe</a>
  <div class="ml-auto">
    <img src="<?php echo $image; ?>" alt="User Image" style="width: 30px; height: 30px; border-radius: 50%;">
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./home_view.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./order_view.php">My Orders</a>
      </li>
    </ul>
   
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    </form>
  
  </div>
</nav>

 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
