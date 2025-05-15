<?php
session_start();
require_once 'form.php';

if (isset($_GET['token'])) {

    $token = $_GET['token'];
    $user_id =  getIDUser_Token($token);
    $_SESSION['id'] = $_GET['id'];;
    

    if($user_id === '') {
        header('Location: resendEmail.php');
        exit;
    }
    else {
        
        switch ($_GET['type']) {
            case 'verify':
                verifyUser($user_id);
                header('Location: verified.php');
                exit;
                break;
            
            case 'password' : 
                header('Location: changePassword.php');
                exit;
                break;
            
            default:
                # code...
                break;
        }
    }




}

?>