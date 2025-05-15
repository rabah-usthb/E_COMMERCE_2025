<?php
 
session_start();

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
        'type' => 'password'
    ];
    

    $emailExist = doesEmailExist($email);
    
    if(!$emailExist) {
        $response['email_error'] = 'Email Doesn\'t Exist , Please Use A Correct Email';
        echo json_encode($response); 
        exit;
    }
    else if(getStatusFromEmail($email)==='appending') {
        $response['email_error'] = 'Email Not Verified , Please Verify Before Changing Password';
        echo json_encode($response); 
        exit;
    }

    
        echo json_encode($response);
        exit;
    

  
    
}

?>