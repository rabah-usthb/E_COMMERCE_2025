<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'admin.php';


if (isset($_POST['action'])) {

    switch ($_POST['action']) {
        case 'add':
            $name = $_POST['name'];
            add($name);
            break;

        case 'delete':
            $name = $_POST['name'];
            delete($name);
            break;
        
        case 'edit' :
            $new_name = $_POST['new'];
            $old_name = $_POST['old'];
            edit($old_name,$new_name);
            break;

        default:
            break;
    }

}


function delete ($name) {
    $response = [
       'error' => ''
    ];
    
    try {
        deleteCategorie($name);
    } catch(Exception $e) {
        $response['error'] = 'An Error Has Occured Please Try Later';
    }
        echo json_encode($response);
        exit;
}  



function add ($name) {
    $response = [
       'error' => ''
    ];
    
    if(doesCategorieExist($name)) {
        $response['error'] = 'Invalid This Category Already Exists';
        echo json_encode($response);
        exit;
    }

    else {
        try{
        insertCategorie($name);
        } catch(Exception $e) {
            $response['error'] = 'An Error Has Occured Please Try Later';
        }
        echo json_encode($response);
        exit;
    }  
}


function edit ($old_name,$new_name) {
    $response = [
       'error' => ''
    ];
    
    if(doesCategorieExist($new_name)) {
        $response['error'] = 'Invalid This Category Already Exists';
        echo json_encode($response);
        exit;
    }

    else {
        try{
          updateCategorie($old_name,$new_name);
        } catch(Exception $e) {
            $response['error'] = 'An Error Has Occured Please Try Later';
        }
        echo json_encode($response);
        exit;
    }  
}

?>