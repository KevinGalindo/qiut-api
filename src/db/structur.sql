DROP TABLE IF EXISTS admin;
CREATE TABLE admin
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `date` DATETIME DEFAULT CURRENT_TIMESTAMP(),
    `name` VARCHAR(50),
    `email` VARCHAR(50) UNIQUE,
    `password` VARCHAR(300),
    `token` VARCHAR(50) DEFAULT NULL,
    `tokenExp` DATETIME DEFAULT NULL
);

insert `admin` values( DEFAULT, DEFAULT, 'admin', 'admin@aadmin', '$2y$10$xVqei9Un0NZhndO8Gv5kOezATgvb.YVdTsh9u51OU2o73WKh9jM1W', 'd0f928a79326226fd64ed37a8cda0ddb9687b6d67e7af2378b', null);

DROP TABLE IF EXISTS products;
CREATE TABLE products
(
    `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `date` DATETIME DEFAULT CURRENT_TIMESTAMP(),
    `user` INT(11),
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `description` VARCHAR(50) NOT NULL,
    `price` INT(11) NOT NULL,
    `categories` JSON DEFAULT '[]'
);

DROP TABLE IF EXISTS product_log;
CREATE TABLE product_log
(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
`date` DATETIME DEFAULT CURRENT_TIMESTAMP(),
`user` INT
);

DROP TABLE IF EXISTS product_fil;
CREATE TABLE product_fil
(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
id_produc INT,
id_category INT
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories
(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
`name` VARCHAR(50) UNIQUE
);