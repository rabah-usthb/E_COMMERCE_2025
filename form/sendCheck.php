<?php
 
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';
require_once 'form.php';

$email    = $_POST['email'];


if (isset($_POST['action']) && $_POST['action'] === 'check') {
    check ($email);
}


function check ($email) {
    
    $response = [
        'email_error'  => '',
        'email' => $email,
        'action' => 'sendToken',
        'type' => 'verify'
    ];
    

    $emailExist = doesEmailExist($email);
    
    if(!$emailExist) {
        $response['email_error'] = 'Email Doesn\'t Exist , Please Use A Correct Email';
        echo json_encode($response); 
        exit;
    }
    
    else{
        echo json_encode($response);
        exit;
    }

  
    
}

?>