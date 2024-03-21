CREATE DATABASE IF NOT EXISTS etutor_database;

USE etutor_database;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type_id INT,
    FOREIGN KEY (user_type_id) REFERENCES user_types(id)
);

