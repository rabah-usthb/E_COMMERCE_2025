CREATE TABLE users (
 id INT AUTO_INCREMENT,
 username VARCHAR(15) UNIQUE NOT NULL,
 email VARCHAR(100) UNIQUE NOT NULL,
 user_status ENUM ('user','appending','admin') DEFAULT 'appending',
 userpassword VARCHAR(255),
 added_at date default (CURRENT_DATE),
 last_login date null,
 CONSTRAINT user_pk PRIMARY KEY (id)
);


CREATE TABLE token (
 id INT AUTO_INCREMENT,
 created_time DATETIME DEFAULT CURRENT_TIMESTAMP,
 destroy_time DATETIME DEFAULT (CURRENT_TIMESTAMP + INTERVAL 15 MINUTE),
 user_id int NOT NULL,
 token_value VARCHAR(64) NOT NULL,
 token_type ENUM ('verify' , 'password') DEFAULT 'verify',
 CONSTRAINT token_user_fk FOREIGN KEY (user_id) REFERENCES users(id) on delete CASCADE,
 CONSTRAINT token_pk PRIMARY KEY (id) 
);


CREATE EVENT kill_expired_tokens
  ON SCHEDULE EVERY 15 MINUTE DO
  DELETE FROM token WHERE destroy_time <= NOW();