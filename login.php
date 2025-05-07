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
    <link rel="stylesheet" href="login.css" />
    
    <script src="login.js" defer></script>

    <title>Login Page</title>
  </head>
  <body>
    <div class="pannel">
      <div class="form-header">
        <div class="title-login">Login Form</div>
      </div>

      <!-- LOGIN FORM -->
      <form  class="login-form" autocomplete="off">
        <div class="input-box">
          <input type="text" class="input-field"  placeholder=" " id="log-email"/>
          <label for="log-email" class="label">Email Or Username</label>
          <i class="bx bx-envelope icon"></i>
          <div class = "tooltip-error" id='nameEmailError'> <i class='bx bxs-message-error error'></i>  <label>error</label></div>
        </div>
          
        <div class="input-box">
          <input type="text" class="input-field"  placeholder=" " id="log-pass"/>
          <label for="log-pass" class="label">Password</label>
          <i class="bx bx-show icon" id="see_icon" onclick="togglePassword()"></i>
          <div class = "tooltip-error"  id='passError' > <i class='bx bxs-message-error error'></i>  <label>error</label></div>
        </div>

        <div class="form-cols">
            <a href="#">Forgot password?</a>
        </div>

        <div class="input-box">
          <button class="btn-submit" id="SignInBtn">
            Login <i class="bx bx-log-in"></i>
          </button>
        </div>

        <div class="switch-form">
          <span>
            Don't have an account?
            <a href="#" onclick="registerFunction()">Register</a>
          </span>
        </div>
      </form>
    </div>
  </body>
</html>