create table commands(
 id INT AUTO_INCREMENT PRIMARY KEY,
 created_time DATETIME DEFAULT CURRENT_TIMESTAMP,
 cancel_time DATETIME NULL,
 total decimal NOT NULL,
 ship_time DATETIME DEFAULT (CURRENT_TIMESTAMP + INTERVAL 15 MINUTE),
 command_status ENUM('awaiting','shipped','canceled','request') DEFAULT 'awaiting',
 user_id int not null,
 FOREIGN KEY (user_id) REFERENCES users(id) 
);



create table command_items (
  prod_id INT,
  command_id int,
  quantity INT NOT NULL,
  PRIMARY KEY(command_id,prod_id),
  FOREIGN KEY(command_id) REFERENCES commands(id) ON DELETE CASCADE,
  FOREIGN KEY(prod_id) REFERENCES products(id) ON DELETE CASCADE
);