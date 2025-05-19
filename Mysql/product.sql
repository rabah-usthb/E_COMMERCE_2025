create table products (
 id INT AUTO_INCREMENT PRIMARY KEY,
 product_name VARCHAR(50) NOT NULL,
 price decimal NOT NULL,
 sold decimal DEFAULT 0,
 quantity int DEFAULT 0,
 max int DEFAULT 20,
 check (max >= quantity),
 brief_description VARCHAR(255) NOT NULL,
 detailed_description text NOT NULL,
 image_data LONGBLOB  NOT NULL
);

create table categories (
 id INT AUTO_INCREMENT PRIMARY KEY,
 cat_name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE products_categories (
 id_prod INT ,
 id_cat INT,
 PRIMARY KEY(id_prod,id_cat),
 FOREIGN KEY (id_prod) REFERENCES products(id) ON DELETE CASCADE,
 FOREIGN KEY (id_cat) REFERENCES categories(id) ON DELETE CASCADE
);
