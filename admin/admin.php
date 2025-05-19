<?php

require_once '../form/db.php';


function getAllProducts() {
    global $pdo;   
    $stmt = $pdo->prepare("Select * from products");
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
/*
function insertProduct($) {
    global $pdo;   
    $stmt = $pdo->prepare(" * from products");
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
*/


function getAllCategories() {
    global $pdo;   
    $stmt = $pdo->prepare("SELECT id , c.cat_name, COUNT(pc.id_cat) FROM categories c LEFT JOIN products_categories pc ON c.id = pc.id_cat GROUP BY c.cat_name");
    $stmt->execute();
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function printCategories() {

    $categories = getAllCategories();

    foreach ($categories as $cat) {
        $nb = nbProductWithCat($cat['id']);
        echo '<div class="category-item">';
            echo "<div class=\"category-name\">";
                echo"<i class='bx bx-category'></i> $cat[cat_name]";
                echo"<span class=\"badge-count\">$nb</span>";
            echo"</div>";
            echo"<div class=\"category-actions\">";
                echo"<button class=\"btn-edit\" title=\"Edit\">";
                echo"<i class='bx bx-edit'></i>";
                echo"</button>";
                echo"<button class=\"btn-delete\" title=\"Delete\">";
                echo"<i class='bx bx-trash'></i>";
                echo"</button>";
            echo"</div>";      
        echo"</div>";     
}

}

function nbProductWithCat($id) {
    global $pdo;   
    $stmt = $pdo->prepare("select count(*) from  products_categories where id_cat = ?");
    $stmt->execute([$id]);
    $nb= $stmt->fetch(PDO::FETCH_ASSOC);
    return $nb['count(*)'];
}

function doesCategorieExist($name) {
    global $pdo;   
    $stmt = $pdo->prepare("select id from categories where cat_name = ?");
    $stmt->execute([$name]);
    $id= $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($id === false){
        return false;
    }
    else {
        return true;
    }

}

function insertCategorie($name) {
    global $pdo;   
    $stmt = $pdo->prepare("INSERT INTO categories (cat_name) VALUES (?)");
    $stmt->execute([$name]);
}


function deleteCategorie($name) {
    global $pdo;   
    $stmt = $pdo->prepare("delete from categories where cat_name = ?");
    $stmt->execute([$name]);
}

function updateCategorie($old_name,$new_name) {
    global $pdo;   
    $stmt_1 = $pdo->prepare("update categories set cat_name = ? where cat_name = ?");
    $stmt_1->execute([$new_name,$old_name]);
}

?>