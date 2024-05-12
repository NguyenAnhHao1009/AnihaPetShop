<?php
require_once __DIR__ . '/../Controllers/testLoginForm.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <link rel="shortcut icon" href="img/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body id="login-body" class="container py-5">
  <div id="login-box" class="row align-self-center justify-content-center">
    <div class="col-11 bg-light col-md-8 col-lg-5 p-5 rounded" style="box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);">
      <div class="row justify-content-center">
        <a class="col-8" href="/"><img width="100%" src="img/header-img.jpg" alt="" /></a>
      </div>
      <?php
      if (isset($_SESSION['signup_success_message'])) {
        echo '<div class="text-center h5 pt-3 text-success fw-bold">' . $_SESSION['signup_success_message'] . '</div>';
        unset($_SESSION['signup_success_message']);
      }
      if (isset($login_fail)) {
        echo '<div class="text-center h5 pt-3 text-danger fw-bold">' . $login_fail . '</div>';
      }

      ?>
      <div class="pt-3">
        <h4 class="h4 text-center text-sm-nowrap">WELLCOME BACK</h4>
      </div>
      <div class="p-3">
        <form id="login-form" action="" method="post" class="">
          <div class="form-group">
            <label for="email"><b>Email address</b></label>
            <input class="form-control" placeholder="Enter your email" value="<?php echo $email ?? '' ?>" id="email" name="email" autofocus />
          </div>
          <span class="form-errors">
            <?php echo $check_login_form['email'] ?? '' ?>
          </span>


          <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" />
          </div>
          <span class="form-errors"><?php echo $check_login_form['password'] ?? ''; ?></span>
          <hr>
          <button id="login-btn" class="my-2 form-control btn text-white">
            <b>Log in</b>
          </button>
          <a class="btn form-control text-center mb-2" href="/signup"><b>Sign up</b></a>
        </form>
        <div class='text-center '><a class='text-primary' style='text-decoration: underline' href="/">Back to home</a></div>

      </div>
    </div>
  </div>
</body>

</html>