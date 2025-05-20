<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'form.php';

if (isset($_GET['token'])) {

    $token = $_GET['token'];
    $user_id =  getIDUser_Token($token);
    

    if($user_id === '') {
        $message = 'Your Token Has Expired. You Will Proceed To Form To Send Email';
        $dest = 'resendEmail.php';
        if($_GET['type']!=='verify') {
            $dest = 'forgot.php';
        }
         echo "<script>
          alert(". json_encode($message) .");
          window.location.href = ". json_encode($dest).";
        </script>";
        exit;
    }
    else {
        
        switch ($_GET['type']) {
            case 'verify':
                verifyUser($user_id);
                $message = "You have been successfully verified You Will proceed to the login page to continue";
                echo "<script>
                alert(". json_encode($message) .");
                window.location.href = 'login.php';
              </script>";
                exit;
                break;
            
            case 'password' : 
                $id = urlencode($_GET['id']);
                header("Location: changePassword.php?user_id={$id}");
                exit;
                break;
            
            default:
                # code...
                break;
        }
    }




}

?>