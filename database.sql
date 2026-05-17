CREATE DATABASE IF NOT EXISTS projectdb;
USE projectdb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','moderator') NOT NULL,
    profile_picture VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    file_path VARCHAR(255) NOT NULL,
    category_id INT,
    uploader_id INT,
    download_count INT DEFAULT 0,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS content_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    requester_ip VARCHAR(100),
    content_title VARCHAR(150) NOT NULL,
    category_requested VARCHAR(100) NOT NULL,
    message TEXT,
    status ENUM('pending','fulfilled','rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO users (name, email, password_hash, role)
VALUES
('Demo Admin', 'admin@example.com', 'demo123', 'admin'),

('Demo Moderator', 'moderator@example.com', 'demo123', 'moderator');

INSERT IGNORE INTO categories (name)
VALUES
('Movies'),
('Software'),
('Games'),
('Action'),
('Comedy'),
('Editing'),
('Tools'),
('Racing');

INSERT IGNORE INTO contents
(title, description, file_path, category_id, uploader_id, download_count)
VALUES

('Avengers Demo', 'Marvel Action Movie', 'demo.mp4', 1, 1, 10),

('Mr Bean Comedy', 'Funny Comedy Movie', 'comedy.mp4', 2, 1, 5),

('Photoshop Tool', 'Editing Software', 'ps.exe', 3, 2, 7),

('VS Code', 'Programming Tool', 'vs.exe', 4, 2, 12),

('Need For Speed', 'Racing Game', 'nfs.zip', 5, 1, 9);