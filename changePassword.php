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
    <script type="module" src="change.js" defer></script>

    <title>Change Password</title>
  </head>
  <body>
    <div class="change-pannel">
      <div class="form-header">
        <div class="title-login">Change Password</div>
      </div>

      <!-- LOGIN FORM -->
      <form  class="change-form" id="form" autocomplete="off">
      <div class = "tooltip-error-bd" id='bdError'> <i class='bx bxs-message-error error'></i>  <span>Invalid Login Details. Please Check Credentials And Try Again</span></div>
      <div class="input-box">
          <input type="text" class="input-field" name="password"  placeholder=" " id="register-pass"/>
          <label for="register-pass" class="label">Password</label>
          <i class="bx bx-show icon" id="see_icon"></i>
          <div class = "tooltip-error"  id='passError' > <i class='bx bxs-message-error error'></i> <span>error</span> </div>
        </div>

        <div class="input-box">
          <input type="text" class="input-field"  placeholder=" " id="register-conf"/>
          <label for="register-conf" class="label">Confirm Password</label>
          <i class="bx bx-show icon" id="see_icon_conf" ></i>
          <div class = "tooltip-error"  id='confError' > <i class='bx bxs-message-error error'></i> <span>error</span> </div>
        </div>
          

        <div class="input-box">
          <button class="btn-submit" id="LogInBtn">
            Change Password <i class="bx bx-key key-icon"></i>
          </button>
        </div>

        <div class="switch-form">
          <span>
            Token Expired ?
            <a href="sign.php">Send Another Email</a>
          </span>
        </div>
      </form>
    </div>
  </body>
</html>