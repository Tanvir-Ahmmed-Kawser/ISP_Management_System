CREATE DATABASE isp_management;

USE isp_management;

CREATE TABLE categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

CREATE TABLE contents(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    file_path VARCHAR(255),
    category_id INT,
    download_count INT DEFAULT 0
);

CREATE TABLE content_requests(
    id INT AUTO_INCREMENT PRIMARY KEY,
    content_title VARCHAR(100),
    category_requested VARCHAR(100),
    message TEXT,
    status VARCHAR(50) DEFAULT 'pending'
);

INSERT INTO categories(name)
VALUES ('Movies'), ('Games'), ('Software');

INSERT INTO contents(title, description, file_path, category_id)
VALUES
('Avengers','Marvel Movie','demo.mp4',1),
('GTA V','Game','gta.zip',2),
('Photoshop','Software','ps.exe',3);