<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<?php
	include "header.html";
  ?>
</head>

<body id="body">

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.html">
            <img src="images/logo.png" alt="">
          </a>
          <h2 class="text-center">Create Your Account</h2>
          <p class="mt-20">Do you want to sell?<a href="store-sign-up.php"> Creat store account</a></p>
          <form class="text-left clearfix" action="./php/sign-up.php" method="POST">
            <div class="form-group">
               <input type="text" class="form-control"  placeholder="First Name" name="firstname" id="firstname" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control"  placeholder="Last Name" name="lastname" id="lastname" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control"  placeholder="Email" name="email" id="email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  placeholder="Password" name="password" id="password" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>
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
                  
            ?>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center">Sign Up</button>
            </div>
          </form>
          <p class="mt-20">Already hava an account ?<a href="login.php"> Login</a></p>
        </div>
      </div>
    </div>
  </div>
</section>

  <?php
    include "footer.html";
    session_destroy();
  ?>
  </body>
  </html>