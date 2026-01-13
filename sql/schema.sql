-- Désactiver les vérifications de clés étrangères pour permettre la suppression/recréation
SET FOREIGN_KEY_CHECKS = 0;

-- Supprimer les tables existantes si elles existent
DROP TABLE IF EXISTS inscription;
DROP TABLE IF EXISTS cours;
DROP TABLE IF EXISTS etudiant;
DROP TABLE IF EXISTS professeur;
DROP TABLE IF EXISTS formation; -- Supprimer l'ancienne table si elle traîne

-- 1. Table Professeur
CREATE TABLE professeur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricule VARCHAR(50) NOT NULL UNIQUE,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    specialite VARCHAR(255)
);

-- 2. Table Cours (Formation)
CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    intitule VARCHAR(255) NOT NULL,
    description TEXT,
    dureeHeures INT,
    prix DECIMAL(10, 2),
    professeur_id INT,
    FOREIGN KEY (professeur_id) REFERENCES professeur(id) ON DELETE SET NULL
);

-- 3. Table Etudiant
CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cne VARCHAR(50) NOT NULL UNIQUE,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    dateInscription DATE
);

-- 4. Table Inscription (Association Etudiant - Cours)
CREATE TABLE inscription (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT NOT NULL,
    cours_id INT NOT NULL,
    dateInscription DATE DEFAULT (CURRENT_DATE),
    statut ENUM('INSCRIT', 'ANNULE', 'TERMINE') DEFAULT 'INSCRIT',
    note DECIMAL(5, 2),
    FOREIGN KEY (etudiant_id) REFERENCES etudiant(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS = 1;
