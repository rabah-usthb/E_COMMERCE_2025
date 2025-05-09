<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0"
    />
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    
    <!-- CSS -->
    <link rel="stylesheet" href="form.css" />
    
    <script type="module" src="form.js" defer></script>
    <script type="module" src="sign.js" defer></script>
    
    <title>SignUp Page</title>
  </head>
  <body>
    <div class="register-pannel">
      <div class="form-header">
        <div class="title-login">Sign Up Form</div>
      </div>

      <!-- Register FORM -->
      <form  class="register-form" id="form" autocomplete="off">
        <div class="input-box">
          <input type="text" class="input-field" name="email"  placeholder=" " id="register-email"/>
          <label for="register-email" class="label">Email</label>
          <i class="bx bx-envelope icon"></i>
          <div class = "tooltip-error" id='emailError'> <i class='bx bxs-message-error error'></i> <span>error</span> </div>
        </div>

        <div class="input-box">
          <input type="text" class="input-field" name="username"  placeholder=" " id="register-name"/>
          <label for="register-name" class="label">Username</label>
          <i class="bx bx-user icon"></i>
          <div class = "tooltip-error" id='nameError'> <i class='bx bxs-message-error error'></i>  <span>error</span> </div>
        </div>
          
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
          <button class="btn-submit" id="SignInBtn">
            Sign Up <i class="bx bx-log-in"></i>
          </button>
        </div>

        <div class="switch-form">
          <span>
            Already have an account?
            <a href="login.php">Login</a>
          </span>
        </div>
      </form>
    </div>
  </body>
</html>