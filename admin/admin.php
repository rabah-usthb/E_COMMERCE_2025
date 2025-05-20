<?php

require_once '../form/db.php';


function getAllProducts() {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $all = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($all as &$prod) {
        $tagsAssoc = getProductTags($prod['id']);
        $prod['tags'] = array_column($tagsAssoc, 'cat_name');
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->buffer($prod['image_data']);
        $prod['image_data'] = "data:{$mime};base64,".base64_encode($prod['image_data']);
    }

    unset($prod);

    return $all;
}


function getProductTags($id) {
    global $pdo;   
    $stmt = $pdo->prepare("Select cat_name from categories where id in (select id_cat from products_categories where id_prod = ?)");
    $stmt->execute([$id]);
    $tags= $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $tags;
}

function printProducts($products) {
    $stockClass = '';
      
    foreach ($products as $prd) {

        $quarter = $prd['max'] * 25 / 100;
        $half = $prd['max'] * 50 / 100;
        $qtn = $prd['quantity'] * 100 / $prd['max'];
        $soldValue = $prd['price'] * $prd['sold'] /100;
        $priceAfterSold = $prd['price'] - $soldValue;

        if ($qtn < $quarter) {
            $stockClass = 'stock-low';
          } else if ($qtn < $half) {
            $stockClass = 'stock-medium';
          } else {
            $stockClass = 'stock-high';
          }

          echo "<div class=\"product-item\">";

          echo "<div class=\"product-info\">";
        
            // image
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime  = $finfo->buffer($prd['image_data']);
            echo "<img src=\"$prd[image_data]\" class=\"product-image\">";
        
            echo "<div class=\"product-details\">";
        
              // header: name, original + discounted price, sold%
              echo "<div class=\"product-header\">";
        
                echo "<div class=\"product-name\">{$prd['product_name']}</div>";
        
                echo "<div class=\"product-price\">";
                if( $prd['sold'] == 0 ) {
                    // no sale: single green price
                    echo '<span class="no-sale-price">$'. number_format($prd['price'], 2). '</span>';
                } else {
                    // sale: show original crossed out + discounted
                    echo '<span class="original-price">$'. number_format($prd['price'], 2). '</span> ';
                    echo '<span class="discounted-price">$'. number_format($priceAfterSold, 2). '</span>';
                }
                echo "</div>";
        
                echo "<div class=\"product-sold\">Sold: ".number_format($prd['sold'],2)."%</div>";
        
              echo "</div>"; // .product-header
        
              // tags
              echo "<div class=\"product-tags\">";
                foreach ($prd['tags'] as $tag) {
                  echo "<span class=\"product-tag\">{$tag}</span>";
                }
              echo "</div>";
        
              // brief
              echo "<div class=\"product-brief\">{$prd['brief_description']}</div>";
        
              // hidden detailed (for later edit)
              echo "<div class=\"product-detailed\" style=\"display:none;\">"
                   . $prd['detailed_description'] .
                   "</div>";
        
              // metrics
              echo "<div class=\"product-metrics\">";
                echo "<div class=\"product-metric $stockClass\">";
                  echo "<i class='bx bx-box'></i> Available: {$prd['quantity']}";
                echo "</div>";
                echo "<div class=\"product-metric\">";
                  echo "<i class='bx bx-chart'></i> Max Stock: {$prd['max']}";
                echo "</div>";
              echo "</div>"; // .product-metrics
        
            echo "</div>"; // .product-details
        
          echo "</div>"; // .product-info
        
          // actions
          echo "<div class=\"product-actions\">";
            echo "<button class=\"action-btn btn-edit\" data-id=\"$prd[product_name]\" title=\"Edit\">";
              echo "<i class='bx bx-edit'></i>";
            echo "</button>";
            echo "<button class=\"action-btn btn-delete\" data-id=\"$prd[product_name]\" title=\"Delete\">";
              echo "<i class='bx bx-trash'></i>";
            echo "</button>";
          echo "</div>"; // .product-actions
        
        echo "</div>"; // .product-item
        
}

}

function doesProductExist($name) {
    global $pdo;   
    $stmt = $pdo->prepare("select id from products where product_name = ?");
    $stmt->execute([$name]);
    $id= $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($id === false){
        return false;
    }
    else {
        return true;
    }

}

function doesTagsExist($tags) {

    $result = [];

    foreach($tags as $tag) {
        $id=doesCategorieExist($tag);
        if ($id===false) {
            $result[] = $tag;
              
        }
    }

    if( count($result) == 0 ){
        return '';
    }
    else {
    return $result;
    }

}

function getTagsId($tags) {
    
    $ids = [];

    foreach($tags as $tag) {
        $id=doesCategorieExist($tag);
        $ids[] =  $id;
    }

    return $ids;
}

function insertProductTags($idProd,$idTags) {

    foreach ($idTags as $idTag) {
        insertProductTag($idProd,$idTag);
    }

}

function deleteProductTags($idProd) {
    global $pdo;   
    $stmt = $pdo->prepare("delete from products_categories where id_prod = ?");
    $stmt->execute([$idProd]);
}

function insertProductTag($idProd,$idTag) {
    global $pdo;   
    $stmt = $pdo->prepare("insert into products_categories (id_prod,id_cat) values (?,?)");
    $stmt->execute([$idProd,$idTag]);
}


function getProductId($name) {
    global $pdo;   
    $stmt = $pdo->prepare("Select id from products where product_name = ?");
    $stmt->execute([$name]);
    $id= $stmt->fetch(PDO::FETCH_ASSOC);
    return $id['id'];
}

function deleteProduct($id) {
    global $pdo;   
    $stmt = $pdo->prepare("delete from products where id = ?");
    $stmt->execute([$id]);
}

function insertProduct($name,$image,$price,$qtn,$max,$sold,$brief,$detailed,$file_name) {
    global $pdo;   
    $stmt = $pdo->prepare("INSERT INTO products (product_name,price,sold,quantity,max,brief_description,detailed_description,image_data,image_name) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $price);
    $stmt->bindValue(3, $sold);
    $stmt->bindValue(4, $qtn);
    $stmt->bindValue(5, $max);
    $stmt->bindValue(6, $brief);
    $stmt->bindValue(7, $detailed);
    $stmt->bindValue(8, $image, PDO::PARAM_LOB);
    $stmt->bindValue(9, $file_name);
    $stmt->execute([$name,$price,$sold,$qtn,$max,$brief,$detailed,$image,$file_name]);
}


function updateProduct($id,$name,$image,$price,$qtn,$max,$sold,$brief,$detailed,$file_name) {
    global $pdo;   
    $stmt = $pdo->prepare("update products set product_name =?,price=?,sold=?,quantity=?,max=?,brief_description=?,detailed_description=?,image_data=?,image_name=? where id = ?");
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $price);
    $stmt->bindValue(3, $sold);
    $stmt->bindValue(4, $qtn);
    $stmt->bindValue(5, $max);
    $stmt->bindValue(6, $brief);
    $stmt->bindValue(7, $detailed);
    $stmt->bindValue(8, $image, PDO::PARAM_LOB);
    $stmt->bindValue(9, $file_name);
    $stmt->bindValue(10,$id);
    $stmt->execute([$name,$price,$sold,$qtn,$max,$brief,$detailed,$image,$file_name,$id]);
}



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
        return $id['id'];
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