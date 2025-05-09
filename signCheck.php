<?php
require_once 'db.php';
require 'form.php';

$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];


if (isset($_POST['action']) && $_POST['action'] === 'check') {
    check ($username,$email,$password);
}


function check ($username,$email,$password) {
    
    $response = [
        'name_error' => '',
        'email_error'  => ''
    ];
    
    $quit = false;

    $nameExist =  doesUserNameExist($username);
    $emailExist = doesEmailExist($email);
    
    if($nameExist) {
        $quit = true;
        $response['name_error'] = 'Name Already Used';
    }

    if($emailExist) {
        $quit = true;
        $response['email_error'] = 'Email Already Used';
    }

    if($quit) {  echo json_encode($response); exit;}
    else {
        insertUser($username,$email,hash('sha256', $password));
    }

    echo json_encode($response);
    
}

?>