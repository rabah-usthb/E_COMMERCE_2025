<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'main.php';


if (isset($_POST['action'])) {

    switch ($_POST['action']) {
        case 'addCart':
            $name = $_POST['name'];
            addCart($name);
            break;

        case 'delete':
            $id = $_POST['id'];
            delete($id);
            break;
        
        case 'edit' :
            $name = $_POST['name'];
            $same = $_POST['same'];
            $id = $_POST['id'];
            $image = file_get_contents($_FILES['image']['tmp_name']);
            $file_name = $_FILES['image']['name'];
            $price = $_POST['price'];
            $qtn = $_POST['qtn'];
            $max = $_POST['max'];
            $tags = $_POST['tags'];
            $sold = $_POST['sold'];
            $brief = $_POST['brief'];
            $detailed = $_POST['detailed'];
            edit($name,$image,$price,$qtn,$max,$tags,$sold,$brief,$detailed,$file_name,$same,$id);
            break;

        default:
            break;
    }

}


function delete ($id) {
    $response = [
       'error' => ''
    ];
    
    try {
        deleteProduct($id);
    } catch(Exception $e) {
        $response['error'] = 'An Error Has Occured Please Try Later';
    }
        echo json_encode($response);
        exit;
}  



function addCart($name) {
    
    $response = [
       'error' => ''
    ];

    $basket_id = getBasketId($_SESSION['id']);
    $prd_id =  getProductID($name);

    if(productExistInBasket($basket_id,$prd_id)) {
        $response['error'] = 'This Product Already In The Basket';
        echo json_encode($response);
        exit;
    }

    else{ 
        try{
            insertProductBasket($basket_id,$prd_id);
        } catch(Exception $e) {
        $response['error'] = 'An Error Has Occured Please Try Later';
        }
    }

          echo json_encode($response);
          exit;
         
    
}




function edit($name,$image,$price,$qtn,$max,$tags,$sold,$brief,$detailed,$file_name,$same,$idProd) {
    
    $response = [
       'error' => ''
    ];
    
    if($same===false) {
    if(doesProductExist($name)) {
        $response['error'] = 'Invalid This Name Already Exists';
        echo json_encode($response);
        exit;
    }
    }
    else{ 
        $result = doesTagsExist($tags);
        if($result!==''){
        $response['error'] = "Invalid The Tags ".implode(', ', $result)." Don't Exists";
        echo json_encode($response);
        exit;
    }
    else {
         try{
            updateProduct($idProd,$name,$image,$price,$qtn,$max,$sold,$brief,$detailed,$file_name);
            $idTags = getTagsId($tags);
            deleteProductTags($idProd);
            insertProductTags($idProd,$idTags);

        } catch(Exception $e) {
            $response['error'] = 'An Error Has Occured Please Try Later';
        }
          echo json_encode($response);
          exit;
         
    }
}

}

?>