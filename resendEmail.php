<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    />
    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    
    <!-- CSS -->
    <link rel="stylesheet" href="error.css" />


    <title>ERROR 503 Page</title>
  </head>
  <body>
    <div class="error-pannel send">
        <div class="title"> <i class='bx bxs-time-five error'></i>  ERROR TOKEN <span> EXPIRED </span> </div>
        <p> The link you used contains an expired token. Please click the button below to request a new one via email.</p>
       
        <div class="input-box">
          <input type="text" class="input-field" name="email"  placeholder=" " id="register-email"/>
          <label for="register-email" class="label">Email</label>
          <i class="bx bx-envelope icon"></i>
          <div class = "tooltip-error" id='emailError'> <i class='bx bxs-message-error error'></i> <span>error</span> </div>
        </div>
        
        <button class= "btn"> Resend Email <i class='bx bx-mail-send'></i> </button>
    </div>
  </body>
</html>