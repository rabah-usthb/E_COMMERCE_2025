CREATE TABLE basket (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id int null,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE basket_items (
  prod_id INT,
  basket_id int,
  quantity INT not null,
  selected  BOOL DEFAULT TRUE,
  PRIMARY KEY(basket_id,prod_id),
  FOREIGN KEY(basket_id) REFERENCES basket(id) ON DELETE CASCADE,
  FOREIGN KEY(prod_id) REFERENCES products(id) ON DELETE CASCADE
);
