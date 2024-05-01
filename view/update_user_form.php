<?php
require('../model/user_model.php');
session_start(); // Start the session
if(isset($_POST['user_id'])){
  $_SESSION['user_id']=$_POST['user_id'];
}
if (isset($_SESSION['errors']) && isset($_SESSION['formData'])) {
  $errors = $_SESSION['errors'];
  $formData = $_SESSION['formData'];

  unset($_SESSION['errors']);
  unset($_SESSION['formData']);
}
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $user = UserModel::get_user_by_id($user_id);

  if ($user) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="../assets/css/register.css">
    </head>

    <body>

      <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" method="POST" action="../controller/user_controller_update.php" enctype="multipart/form-data">
                    <input hidden name="user_id" value="<?php echo $user_id; ?>">

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="name">Your Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="<?php echo $user['name']; ?>" />
                            <span class="error-message" style="color:red;"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="email">Your Email</label>
                            <input type="text" id="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" />
                            <span class="error-message" style="color:red;"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="room">Room No.</label>
                            <input type="text" id="room" name="room" class="form-control" value="<?php echo $user['room_no']; ?>" />
                            <span class="error-message" style="color:red;"><?php echo isset($errors['room']) ? $errors['room'] : ''; ?></span>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label class="form-label" for="ext">Ext.</label>
                            <input type="text" id="ext" name="ext" class="form-control" value="<?php echo $user['ext']; ?>" />
                            <span class="error-message" style="color:red;"><?php echo isset($errors['ext']) ? $errors['ext'] : ''; ?></span>
                          </div>
                        </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <label class="form-label" for="image">Image</label>
                      <input type="file" id="image" name="image" class="form-control" />
                      <span class="error-message" style="color:red;"><?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                    </div>
                  </div>
                  
                  <div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
    <div data-mdb-input-init class="form-outline flex-fill mb-0">
        <label class="form-label" for="role">User Role</label>
        <select id="role" name="role" class="form-select">
            <option value="client" <?php echo ($user['role'] == 'client') ? 'selected' : ''; ?>>Client</option>
            <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        </select>
    </div>
</div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                  </div>

                      </form>

                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                      <img src="../assets/images/register.webp" class="img-fluid" alt="Sample image">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
  } else {
    echo "User not found.";
  }
} else {
  echo "User ID not provided.";
}
?>