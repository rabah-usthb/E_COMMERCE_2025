<?php
require_once 'db.php';
require 'form.php';

$nameEmail    = $_POST['nameEmail'];
$password = $_POST['password'];


if (isset($_POST['action']) && $_POST['action'] === 'check') {
    check ($nameEmail,$password);
}


function check ($nameEmail,$password) {
    

    $response = [
       'error' => ''
    ];
    

    $status =  '';

    if(str_contains($nameEmail, '@')) {
        $status = isLoginRightEmail($nameEmail,$password);
    }

    else {
        $status = isLoginRightName($nameEmail,$password);
    }
    
    if($status === '') {
        $response['error'] = 'Invalid Login Details. Please Check Credentials And Try Again';
        echo json_encode($response);
        exit;
    }

    else if($status === 'appending'){
        $response['error'] = 'Please Check Your Email And Verify Before Logging In';
        echo json_encode($response);
        exit;
    }

    else {
        echo json_encode($response);
    }


    
}

?>