CREATE DATABASE IF NOT EXISTS baza;

USE baza;

CREATE TABLE users (
       id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(30) NOT NULL,
       password VARCHAR(30) NOT NULL
);

INSERT INTO users(username, password)
VALUES ('admin', 'roboday');
