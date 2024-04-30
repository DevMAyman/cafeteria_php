 
<nav  style=" border-bottom: 1px solid #fff;
      background-color: rgba(0, 0, 0, 0);
      font-family: 'Shadows Into Light', cursive;
      font-size:25px;
      position: absolute;  
      top: 0; 
      left: 0;  
      width: 100%;  
      z-index: 9999;" class="navbar navbar-expand-lg navbar-light">

  <a style ="color: rgb(143, 154, 33) !important;  
      text-transform: uppercase;
      font-size:25px;
      font-family: 'Shadows Into Light', cursive;" class="navbar-brand" href="#"><i class="fas fa-cogs"></i> Admin Panel</a>


<?php
//for navbar
 require_once('../helper/check_admin.php');

   $image = access_image();
    
?>


  <div class="ml-auto">
    <img src="<?php echo $image; ?>" alt="Admin Image" style="width: 50px; height: 50px; border-radius: 50%;">
  </div>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link"  style="color: rgb(143, 154, 33) !important;"  href="./home_view.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  style="color: rgb(143, 154, 33) !important;" href="#">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  style="color: rgb(143, 154, 33) !important;" href="#">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  style="color: rgb(143, 154, 33) !important;" href="#">Manual</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  style="color: rgb(143, 154, 33) !important;" href="order_view.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  style="color: rgb(143, 154, 33) !important;" href="#">Checks</a>
      </li>
    </ul>
  
     
  </div>
</nav>


 
 
