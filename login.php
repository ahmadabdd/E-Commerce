<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include "header.html";
 ?>
 <title>Log in</title>
</head>

<body id="body">

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="#">
            <img src="images/logo.png" alt="">
          </a>
          <h2 class="text-center">Welcome Back</h2>
          <form class="text-left clearfix" action="./php/log-in.php" method="POST">
            <div class="form-group">
              <input type="email" class="form-control"  placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
              <label id="select">User Type: </label>
              <select class="form-select" aria-label="Default select example" type="select" name="user_type">
                <option value="1">Customer</option>
                <option value="2">Store</option>
              </select>            
            </div>
            <?php
              if (!empty($_SESSION["email"])) {
                $x = $_SESSION["email"];
                printf('<div class="alert alert-danger" role="alert"> %s </div>', $x);
              }
              if (!empty($_SESSION["password"])) {
                $x = $_SESSION["password"];
                printf('<div class="alert alert-danger" role="alert"> %s </div>', $x);
              }
              if (!empty($_SESSION["user_type"])) {
                $x = $_SESSION["user_type"];
                printf('<div class="alert alert-danger" role="alert"> %s </div>', $x);
              }
            ?>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center" >Login</button>
            </div>
          </form>
          <p class="mt-20">New in this site ?<a href="user-sign-up.php"> Create New Account</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  include "footer.html";
 ?>
  </body>
  </html>

  <?php
    session_destroy();
  ?>