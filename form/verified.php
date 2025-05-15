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
    <link rel="stylesheet" href="error.css" />


    <title>ERROR 503 Page</title>
  </head>
  <body>
    <div class="error-pannel">
        <div class="title"> <i class='bx bxs-message-check not-error'></i>  Successfully  <span> Verified </span> </div>
     <p> You have been successfully verified. Please proceed to the <a href="/login">login page</a> to continue.</p>
    </div>
  </body>
</html>