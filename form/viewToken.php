<?php 
session_start();

global $response;
$response = $_POST['message'];
global $icon;
$icon = $_POST['icon'];
global $title;

$title = match($icon) {
    'bx bxs-message-error error' =>  'ERROR 503 Page',
    'bx bxs-message-check not-error' => 'Token Page',
    default    => 'Token Page',
  };
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

    <?php 
    echo "<title> $title </title>";
    ?>
   
  </head>
  <body>
    <div class="error-pannel">
        <?php 
        if($title ==='ERROR 503 Page') {
          echo "<div class = \"title\"> <i class = \"$icon\"></i>  ERROR  <span> 503 </span>  EMAIL SERVICE UNAVAILABLE </div>";
        }
        else {
        echo "<div class = \"title\"> <i class = \"$icon\"></i>  EMAIL <span> SUCCESSFULLY </span>  SENT </div>";
        }
       
        
        echo " <p>$response</p>"
     ?>
     </div>
  </body>
</html>