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

INSERT INTO utilisateurs (nom, email, password, role, status) 
VALUES ('Admin', 'admin@youdemy.com', SHA2('admin123', 256), 'admin', 'actif');


-- Ajout de nouvelles catégories
INSERT INTO categories (nom) VALUES
('Intelligence Artificielle'),
('Musique'),
('Photographie'),
('Gestion de Projet'),
('Finance'),
('Développement Personnel'),
('Santé et Bien-être');

-- Ajout de nouveaux tags
INSERT INTO tags (nom) VALUES
('Machine Learning'),
('Data Science'),
('DevOps'),
('Cloud Computing'),
('UI Design'),
('SEO'),
('Wordpress'),
('iOS'),
('Android'),
('Cybersécurité');

-- Ajout d'utilisateurs enseignants
INSERT INTO utilisateurs (nom, email, password, role, status) VALUES
('mohamed', 'enseignant@youdemy.com', SHA2('prof2024', 256), 'enseignant', 'actif');

-- Ajout d'utilisateurs étudiants
INSERT INTO utilisateurs (nom, email, password, role, status) VALUES
('Thomas Petit', 'thomas.p@youdemy.com', SHA2('etudiant2024', 256), 'etudiant', 'actif'),
('Laura Garcia', 'laura.g@youdemy.com', SHA2('etudiant2024', 256), 'etudiant', 'actif'),
('Nicolas Roux', 'nicolas.r@youdemy.com', SHA2('etudiant2024', 256), 'etudiant', 'actif'),
('Émilie Leroy', 'emilie.l@youdemy.com', SHA2('etudiant2024', 256), 'etudiant', 'actif'),
('Antoine Dupont', 'antoine.d@youdemy.com', SHA2('etudiant2024', 256), 'etudiant', 'actif');

-- Ajout de nouveaux cours
INSERT INTO cours (titre, description, contenu, type_contenu, id_categorie, id_enseignant, statut) VALUES
('Introduction au Machine Learning', 'Découvrez les fondamentaux du ML avec Python', 'Contenu détaillé incluant théorie et pratique...', 'video', 8, 10, 'actif'),
('Photographie Numérique Avancée', 'Maîtrisez votre appareil photo et la post-production', 'Cours complet sur la photo numérique...', 'video', 10, 11, 'actif'),
('Gestion Agile de Projets', 'Méthodologies Scrum et Kanban en pratique', 'Formation complète en gestion de projet...', 'document', 11, 12, 'actif'),
('Développement iOS avec Swift', 'Créez vos premières applications iOS', 'Guide pas à pas du développement iOS...', 'video', 1, 13, 'actif'),
('Marketing sur les Réseaux Sociaux', 'Stratégies efficaces pour 2024', 'Contenu actualisé sur le marketing digital...', 'video', 4, 14, 'actif'),
('Cybersécurité pour Débutants', 'Les bases de la sécurité informatique', 'Formation complète en cybersécurité...', 'video', 5, 10, 'brouillon'),
('Design Thinking', 'Innovation et créativité en entreprise', 'Méthodologie complète du Design Thinking...', 'document', 3, 11, 'actif');

-- Association des tags aux nouveaux cours
INSERT INTO cours_tags (id_cours, id_tag) VALUES
(6, 11), -- Machine Learning
(6, 12), -- Data Science
(7, 5),  -- UI Design
(8, 13), -- DevOps
(9, 18), -- iOS
(10, 6), -- SEO
(11, 20), -- Cybersécurité
(12, 5); -- UI Design

-- Nouvelles inscriptions
INSERT INTO inscriptions (id_etudiant, id_cours) VALUES
(15, 6), -- Thomas - Machine Learning
(15, 7), -- Thomas - Photographie
(16, 8), -- Laura - Gestion de Projet
(16, 9), -- Laura - iOS
(17, 6), -- Nicolas - Machine Learning
(17, 10), -- Nicolas - Marketing
(18, 12), -- Émilie - Design Thinking
(19, 11); -- Antoine - Cybersécurité

-- Nouvelles évaluations
INSERT INTO evaluations (id_cours, id_etudiant, note, commentaire) VALUES
(6, 15, 5, 'Excellente introduction au Machine Learning'),
(7, 15, 4, 'Cours très pratique avec de bons exemples'),
(8, 16, 5, 'Formation complète et bien structurée'),
(9, 16, 4, 'Bon cours pour débuter sur iOS'),
(10, 17, 5, 'Contenu très actuel et pertinent'),
(12, 18, 5, 'Approche innovante du design');

-- Nouvelles notifications
INSERT INTO notifications (id_utilisateur, message, lu) VALUES
(10, 'Nouveaux commentaires sur votre cours de ML', FALSE),
(11, 'Votre cours de photographie est très apprécié', FALSE),
(15, 'Nouveau module disponible en ML', FALSE),
(16, 'Quiz hebdomadaire disponible', TRUE),
(17, 'Nouveau projet à rendre', FALSE),
(18, 'Félicitations pour votre certification!', TRUE);

-- Nouveaux certificats
INSERT INTO certificats (id_etudiant, id_cours) VALUES
(15, 6), -- Thomas - ML Certificate
(16, 8), -- Laura - Projet Management
(17, 6), -- Nicolas - ML Certificate
(18, 12); -- Émilie - Design Thinking

USE  youdemy;

INSERT INTO utilisateurs (nom, email, password, role, status)
VALUES (
    'med', 
    'med@youdemy.com', 
    SHA2('enseignant123', 256), 
    'enseignant', 
    'en_attente'
);
INSERT INTO utilisateurs (nom, email, password, role, status)
VALUES (
    'ahmed', 
    'hmed@youdemy.com', 
    SHA2('enseignant123', 256), 
    'enseignant', 
    'en_attente'
);