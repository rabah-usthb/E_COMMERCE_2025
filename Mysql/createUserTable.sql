CREATE TABLE users (
 id INT AUTO_INCREMENT,
 username VARCHAR(15) UNIQUE NOT NULL,
 email VARCHAR(100) UNIQUE NOT NULL,
 user_status ENUM ('user','appending','admin') DEFAULT 'appending',
 userpassword VARCHAR(255),
 CONSTRAINT user_pk PRIMARY KEY (id)
);


CREATE TABLE token (
 id INT AUTO_INCREMENT,
 created_time DATETIME DEFAULT CURRENT_TIMESTAMP,
 destroy_time DATETIME NOT NULL,
 user_id int NOT NULL,
 token_value VARCHAR(64) NOT NULL,
 token_type ENUM ('verify' , 'password' , 'delete' , 'email') DEFAULT 'verify',
 CONSTRAINT token_user_fk FOREIGN KEY (user_id) REFERENCES users(id) on delete CASCADE,
 CONSTRAINT token_pk PRIMARY KEY (id) 
);
