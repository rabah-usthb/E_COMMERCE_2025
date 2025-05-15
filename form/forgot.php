<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    />
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    
    <!-- CSS -->
    <link rel="stylesheet" href="form.css" />
    
    <script type="module" src="form.js" defer></script>
    <script type="module" src="forgot.js" defer></script>

    <title>Forgot Page</title>
  </head>
  <body>
    <div class="forgot-pannel">
      <div class="form-header">
        <div class="title-login">Forgot Password?</div>
      </div>

      <!-- LOGIN FORM -->
      <form  class="forgot-form" id="form" autocomplete="off">
      <div class = "tooltip-error-bd" id='bdError'> <i class='bx bxs-message-error error'></i>  <span>Invalid Login Details. Please Check Credentials And Try Again</span></div>
        <div class="input-box">
          <input type="text" class="input-field"  placeholder=" " id="log-email"/>
          <label for="log-email" class="label">Email</label>
          <i class="bx bx-envelope icon"></i>
          <div class = "tooltip-error" id='emailError'> <i class='bx bxs-message-error error'></i>  <span>error</span></div>
        </div>
          


        <div class="form-cols">
            <a href="login.php">Remember password?</a>
        </div>

        <div class="input-box">
          <button class="btn-submit" id="ForgotBtn">
            Send Email <i class="bx bx-mail-send" id = "sendIcon"></i>
          </button>
        </div>

        <div class="switch-form">
          <span>
            Don't have an account?
            <a href="sign.php">Register</a>
          </span>
        </div>
      </form>
    </div>
  </body>
</html>