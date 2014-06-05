CREATE TABLE tb_users
(
use_uid INT PRIMARY KEY AUTO_INCREMENT,
use_username VARCHAR(30) UNIQUE,
use_password VARCHAR(50),
use_name VARCHAR(100),
use_email VARCHAR(70) UNIQUE
);