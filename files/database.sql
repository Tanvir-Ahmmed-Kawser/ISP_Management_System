CREATE DATABASE projectdb;
USE projectdb;

CREATE TABLE categories(
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100)
);

CREATE TABLE subcategories(
id INT AUTO_INCREMENT PRIMARY KEY,
category_id INT,
name VARCHAR(100)
);

CREATE TABLE contents(
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100),
description TEXT,
file_path VARCHAR(255),
category_id INT,
subcategory_id INT,
download_count INT DEFAULT 0
);

CREATE TABLE content_requests(
id INT AUTO_INCREMENT PRIMARY KEY,
content_title VARCHAR(100),
category_requested VARCHAR(100),
message TEXT,
requester_ip VARCHAR(100),
status VARCHAR(50) DEFAULT 'pending'
);

INSERT INTO categories(name) VALUES ('Movies'),('Games'),('Software');

INSERT INTO subcategories(category_id,name) VALUES
(1,'Action'),(1,'Comedy'),
(2,'Racing'),(2,'Adventure'),
(3,'Editing'),(3,'Tools');

INSERT INTO contents(title,description,file_path,category_id,subcategory_id) VALUES
('Avengers','Marvel Movie','demo.mp4',1,1),
('GTA V','Open World Game','gta.zip',2,4),
('Photoshop','Editing Tool','ps.exe',3,5);