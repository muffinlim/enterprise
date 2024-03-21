-- create_tables.sql

CREATE DATABASE IF NOT EXISTS etutor_database;

USE etutor_database;

-- Table for user types
CREATE TABLE IF NOT EXISTS user_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(50) NOT NULL UNIQUE
);

-- Populate user_types table with initial values
INSERT INTO user_types (type_name) VALUES
    ('student'),
    ('lecturer'),
    ('admin');
