<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';
require 'form.php';

$id    = $_SESSION['id'];
$password = $_POST['password'];


if (isset($_POST['action']) && $_POST['action'] === 'modify') {
    change ($id,$password);
}


function change ($id,$password) {
    

    $response = [
       'error' => ''
    ];
    
    try{
        changePassword($id,$password);
    }
        catch(Exception $e) {
            echo "failed: " .$e;
            $response['error'] = "An Error Happened While Trying To Change The Password, Please Try Later";
            echo json_encode($response);
            exit;

        }
    
  
  
    echo json_encode($response);
    exit;
    
}

?>