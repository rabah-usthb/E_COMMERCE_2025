CREATE TABLE basket (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id int not null,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE basket_items (
  prod_id INT,
  basket_id int,
  quantity INT default 0,
  PRIMARY KEY(basket_id,prod_id),
  FOREIGN KEY(basket_id) REFERENCES basket(id) ON DELETE CASCADE,
  FOREIGN KEY(prod_id) REFERENCES products(id) ON DELETE CASCADE
);


DELIMITER //

CREATE TRIGGER after_user_inserted
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO basket (user_id) VALUES (NEW.id);
 END//

DELIMITER ;
