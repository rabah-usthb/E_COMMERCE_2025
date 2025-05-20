<?php
require_once '../form/db.php';


    function productExistInBasket($basket_id,$prd_id) {
        global $pdo;   
        $stmt = $pdo->prepare("select * from basket_items where prod_id = ? and basket_id  = ? ");
        $stmt->execute([$prd_id,$basket_id]);
        $row= $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false){
            return false;
        }
        else {
            return true;
        }
        
    }

    function insertProductBasket($basket_id,$prd_id) {
        global $pdo;   
        $stmt = $pdo->prepare("INSERT INTO basket_items (prod_id,basket_id) VALUES (?,?)");
        $stmt->execute([$prd_id,$basket_id]);
    }

    function getBasketId($id) {
        global $pdo;   
        $stmt = $pdo->prepare("select id from basket where user_id = ?");
        $stmt->execute([$id]);
        $id= $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }

    function getProductID($name) {
        global $pdo;   
        $stmt = $pdo->prepare("select id from products where product_name = ?");
        $stmt->execute([$name]);
        $id= $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }

    function getProductTags($id) {
        global $pdo;   
        $stmt = $pdo->prepare("Select cat_name from categories where id in (select id_cat from products_categories where id_prod = ?)");
        $stmt->execute([$id]);
        $tags= $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

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

    function printAllProducts($products) {

        echo"<section class=\"container featured-products\">";
        echo"<h2 class=\"section-title\">Featured Products</h2>";
        echo"<div class=\"products-grid\">";
            foreach ($products as $product) {
                $soldValue = $product['price'] * $product['sold'] /100;
                $priceAfterSold = $product['price'] - $soldValue;
                echo"<div class=\"product-card\" data-product= \"$product[product_name] \">";
                    echo"<div class=\"product-img\">";
                        echo"<img src=\" $product[image_data] \" alt=\"$product[product_name]\">";
                        echo"<div class=\"product-actions\">";
                            echo"<div class=\"action-btn favorite-btn\"><i class='bx bx-heart'></i></div>";
                            echo"<div class=\"action-btn zoom-btn\"";
                                echo"data-product=\"$product[product_name]\">";
                                echo"<i class='bx bx-fullscreen'></i>";
                            echo"</div>";
                        echo"</div>";
                        if ($product['sold'] > 0) {
                        echo"<div class=\"product-tag\">-$product[sold]%</div>";
                        }
                    echo"</div>";
                    echo"<div class=\"product-info\">";
                        echo"<div class=\"product-price\">";
                        echo '<div class="price">';
                        if( $product['sold'] > 0 ) {
                            // show original price struck through
                            echo '<span class="old-price">$'
                                 . number_format($product['price'], 2)
                                 . '</span> ';
                            // show the “sold” price after discount
                            echo '<span class="new-price">$'
                                 . number_format($priceAfterSold, 2)
                                 . '</span>';
                        } else {
                            // no discount, just show regular price
                            echo '<span class="current-price">$'
                                 . number_format($product['price'], 2)
                                 . '</span>';
                        }
                        echo '</div>';
                            echo"<div class=\"add-cart\" data-product=\"$product[product_name]\"><i class='bx bx-cart-add'></i></div>";
                        echo"</div>";
                    echo"</div>";
                echo"</div>";
            }
            echo "</div>";
        echo "</section>";
    }
?>