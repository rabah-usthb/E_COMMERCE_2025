<?php
require_once 'form.php';

if (isset($_GET['token'])) {

    $token = $_GET['token'];
    $user_id = getIDUser_Token($token);

    if($user_id === '') {
        header('Location: resendEmail.php');
        exit;
    }
    else {
        verifyUser($user_id);
        header('Location: verified.php');
        exit;
    }




}

?>