<?php
  require_once __DIR__ . '/../Controllers/testSignUpForm.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>

  <link rel="shortcut icon" href="./img/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/style.css" />
</head>

<body id="login-body" class="container py-5">
  <div id="login-box" class="row align-self-center justify-content-center">
    <div class="col-11 bg-light col-md-8 col-lg-5 py-5 rounded" style="box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);">
      <div class="row justify-content-center">
        <a class="col-8" href="/"><img width="100%" src="img/header-img.jpg" alt="" /></a>
      </div>
      <div class="p-3">
        <h4 class="h4 text-center text-sm-nowrap">Sign Up Your Account</h4>
      </div>
      <?php
      ?>
      <div class="p-3">
        <form id="sign-up-form" action="" method="post">
          <div class="form-group  row justify-content-center mb-3">
            <label class="col-1 justify-content-center align-self-center text-center" for="user_name"><i class="fa-solid fa-user"></i></label>
            <div class="col-10">
              <input value="<?php echo $user_name ?? '' ?>" class="form-control" id="user_name" name="user_name" type="text" autofocus placeholder="Enter your full name" />
            </div>
            <span class="form-errors">
              <?php echo $check_signup_form['user_name']?? ''?>
            </span>

            
          </div>
          <div class="form-group row justify-content-center mb-3">
            <label class="col-1 justify-content-center align-self-center text-center" for="email"><i class="fa-solid fa-envelope"></i></label>
            <div class="col-10">
              <input value="<?php echo $email ?? '' ?>" class="form-control" id="email" name="email" placeholder="Enter your email" />
            </div>
            <?php
            echo isset($check_signup_form['email']) ? '<span class="form-errors">' . $check_signup_form['email'] . '</span>' : '';
            ?>
          </div>
          <div class="form-group row justify-content-center mb-3">
            <label class="col-1 justify-content-center align-self-center text-center" for="phone_number"><i class="fa-solid fa-phone"></i></label>
            <div class="col-10">
              <input value="<?php echo $phone_number ?? '' ?>" class="form-control" id="phone_number" name="phone_number" type="tel" placeholder="Enter your phone number" />
            </div>
            <?php
            echo isset($check_signup_form['phone_number']) ? '<span class="form-errors">' . $check_signup_form['phone_number'] . '</span>' : '';
            ?>
          </div>
          <div class="form-group row justify-content-center mb-3">
            <label class="col-1 justify-content-center align-self-center text-center" for="password"><i class="fa-solid fa-key"></i></label>
            <div class="col-10">
              <input value="<?php echo $password ?? '' ?>" class="form-control" id="password" name="password" type="password" placeholder="Enter your password" />
            </div>
            <?php
            echo isset($check_signup_form['password']) ? '<span class="form-errors">' . $check_signup_form['password'] . '</span>' : '';
            ?>
          </div>
          <div class="form-group row justify-content-center mb-3">
            <label class="col-1 justify-content-center align-self-center text-center" for="re_password"><i class="fa-solid fa-key"></i></label>
            <div class="col-10">
              <input value="<?php echo $re_password ?? '' ?>" class="form-control" id="re_password" name="re_password" type="password" placeholder="Retype your password" />
            </div>
            <?php
            echo isset($check_signup_form['re_password']) ? '<span class="form-errors">' . $check_signup_form['re_password'] . '</span>' : '';
            ?>
          </div>
          <div class="form-group row justify-content-center mb-3">
            <label class="col-1 justify-content-center align-self-center text-center" for="address"><i class="fa-solid fa-map-pin"></i></label>
            <div class="col-10">
              <input value="<?php echo $address ?? '' ?>" class="form-control" id="address" name="address" type="text" placeholder="Enter your address" />
            </div>
            <?php
            echo isset($check_signup_form['address']) ? '<span class="form-errors">' . $check_signup_form['address'] . '</span>' : '';
            ?>
          </div>
          <hr>
          <div class="form-group" style="position: relative;">
            <input <?php if(isset($check) && $check==='checked') echo 'checked';  ?> class="pt-2" type="checkbox" name="agree_term" id="agree-term" />
            <label for="agree-term" style="position: absolute; bottom: 0.2px;" class=""> &nbsp; Agree with <a target="_blank" style="text-decoration: underline;" href="/term">us terms</a></label>
          </div>
          <?php
            echo isset($check_signup_form['agree_term']) ? '<span class="form-errors">' . $check_signup_form['agree_term'] . '</span>' : '';
            ?>
          <div class="form-group">
            <div class="p-2 mt-2 row justify-content-between">
              <button id="sign-up-btn" class="my-1 order-md-2 col-md-5"><b>Sign Up</b></button>
              <a href="/login" class="cancel-btn my-1 d-flex align-items-center justify-content-center text-center order-md-1 col-md-5 "><b>Cancel</b></a>
            </div>

          </div>
        </form>
        <div class='text-center '><a class='text-primary' style='text-decoration: underline' href="/">Back to home</a></div>

      </div>
    </div>
  </div>
  <script>

  </script>
</body>

</html>