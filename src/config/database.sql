DROP DATABASE IF EXISTS youdemy;
CREATE DATABASE youdemy;
USE youdemy;

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'enseignant', 'etudiant') NOT NULL,
    status ENUM('actif', 'inactif', 'en_attente') NOT NULL DEFAULT 'en_attente'
);

CREATE TABLE categories (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE tags (
    id_tag INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE cours (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    contenu TEXT NOT NULL,
    type_contenu ENUM('video', 'document') NOT NULL,
    id_categorie INT,
    id_enseignant INT NOT NULL,
    statut ENUM('actif', 'inactif', 'brouillon') NOT NULL DEFAULT 'brouillon',
    FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie) ON DELETE SET NULL,
    FOREIGN KEY (id_enseignant) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

CREATE TABLE cours_tags (
    id_cours INT,
    id_tag INT,
    PRIMARY KEY (id_cours, id_tag),
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (id_tag) REFERENCES tags(id_tag) ON DELETE CASCADE
);

CREATE TABLE inscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_etudiant INT NOT NULL,
    id_cours INT NOT NULL,
    date_inscription DATE NOT NULL DEFAULT (CURRENT_DATE),
    FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,
    UNIQUE KEY unique_inscription (id_etudiant, id_cours)
);


CREATE TABLE certificats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_etudiant INT NOT NULL,
    id_cours INT NOT NULL,
    date_obtention DATE NOT NULL DEFAULT (CURRENT_DATE),
    FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,
    UNIQUE KEY unique_certificat (id_etudiant, id_cours)
);
SELECT * from cours ; 

INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES (
    'admin', 
    'admin@youdemy.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- كلمة المرور: "password"
    'admin', 
    'actif'
);
use youdemy;
INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES (
    'etudiant', 
    'etudiant@youdemy.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- كلمة المرور: "password"
    'etudiant', 
    'actif'
);

-- إضافة طالب (etudiant) مع كلمة مرور مختلفة
INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES (
    'John Doe', 
    'john.doe@youdemy.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- كلمة المرور: "student123"
    'etudiant', 
    'actif'
);
ALTER TABLE cours MODIFY statut ENUM('actif', 'inactif', 'en_attente') NOT NULL DEFAULT 'en_attente';
-- إضافة معلم (enseignant) مع كلمة مرور مختلفة
INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES (
    'Jane Smith', 
    'jane.smith@youdemy.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',  -- كلمة المرور: "teacher123"
    'enseignant', 
    'actif'
);

--------------
-- Insert more users
INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES 
('Alice Cooper', 'alice.cooper@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'enseignant', 'actif'), 
('Bob Marley', 'bob.marley@youdemy.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 'actif');

-- Insert categories
INSERT INTO categories (nom) 
VALUES 
('Programming'), 
('Design'), 
('Marketing');
 SELECT * from cours;
-- Insert tags
INSERT INTO tags (nom) 
VALUES 
('C++'), 
('Web Development'), 
('SEO'), 
('Graphic Design');

-- Insert courses
INSERT INTO cours (titre, description, contenu, type_contenu, id_categorie, id_enseignant, statut) 
VALUES 
('Learn C++', 'A comprehensive guide to C++ programming.', 'C++ Course Content', 'video', 1, 3, 'inactif'),
('Web Design Basics', 'Introduction to web design principles.', 'Web Design Course Content', 'document', 2, 4, 'actif'),
('SEO Fundamentals', 'Master SEO strategies for online success.', 'SEO Course Content', 'video', 3, 3, 'brouillon');

-- Associate courses with tags
INSERT INTO cours_tags (id_cours, id_tag) 
VALUES 
(1, 1), -- Learn C++ with C++ tag
(2, 2), -- Web Design Basics with Web Development tag
(3, 3); -- SEO Fundamentals with SEO tag

-- Enroll students in courses
INSERT INTO inscriptions (id_etudiant, id_cours) 
VALUES 
(2, 1), -- John Doe enrolled in Learn C++
(2, 2), -- John Doe enrolled in Web Design Basics
(4, 3); -- Bob Marley enrolled in SEO Fundamentals

-- Issue certificates for completed courses
INSERT INTO certificats (id_etudiant, id_cours) 
VALUES 
(2, 1); -- John Doe receives a certificate for Learn C++
