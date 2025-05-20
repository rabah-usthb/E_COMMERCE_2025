<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once 'db.php';
require 'form.php';

$nameEmail    = $_POST['nameEmail'];
$password = $_POST['password'];


if (isset($_POST['action']) && $_POST['action'] === 'check') {
    check ($nameEmail,$password);
}


function check ($nameEmail,$password) {
    
    $id = '';

    $response = [
       'error' => '',
       'status' => ''
    ];
    

    $status =  '';

    if(str_contains($nameEmail, '@')) {
        $status = isLoginRightEmail($nameEmail,$password);
        $id =  getIdFromEmail($nameEmail);
    }

    else {
        $status = isLoginRightName($nameEmail,$password);
        $id =  getIdFromEmail($nameEmail);
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
        $_SESSION['id'] = $id;
        lastLogUpdate();
        $response['status'] = $status;
        echo json_encode($response);
        exit;
    }


    
}

?>