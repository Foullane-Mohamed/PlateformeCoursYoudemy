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

CREATE TABLE evaluations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_cours INT NOT NULL,
    id_etudiant INT NOT NULL,
    note INT NOT NULL CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    FOREIGN KEY (id_cours) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    UNIQUE KEY unique_evaluation (id_etudiant, id_cours)
);

CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT NOT NULL,
    message TEXT NOT NULL,
    lu BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE
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

INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES ('Admin', 'admin@youdemy.com', SHA2('admin123', 256), 'admin', 'actif');

INSERT INTO categories (nom) VALUES
('Développement Web'),
('Business'),
('Design'),
('Marketing Digital'),
('Programmation'),
('Langues'),
('Sciences');

INSERT INTO tags (nom) VALUES
('PHP'),
('JavaScript'),
('HTML/CSS'),
('MySQL'),
('Python'),
('Java'),
('React'),
('Angular'),
('Vue.js'),
('NodeJS');