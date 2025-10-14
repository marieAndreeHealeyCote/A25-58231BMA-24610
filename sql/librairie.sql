CREATE DATABASE IF NOT EXISTS librairie CHARACTER SET utf8mb4;

USE librairie;

CREATE TABLE IF NOT EXISTS librairie.livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    annee_publication INT NOT NULL,
    genre VARCHAR(100) NOT NULL
);
CREATE TABLE IF NOT EXISTS librairie.categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

DROP TABLE IF EXISTS librairie.livres;

CREATE TABLE librairie.livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    annee_publication INT NOT NULL,
    genre VARCHAR(100) NOT NULL,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);

INSERT INTO librairie.categories (nom) VALUES
('Roman'),
('Science-Fiction'),
('Essai'),
('Biographie'),
('Jeunesse');

CREATE TABLE IF NOT EXISTS librairie.editeurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

ALTER TABLE librairie.livres
ADD COLUMN editeur_id INT NULL,
ADD CONSTRAINT fk_editeur FOREIGN KEY (editeur_id) REFERENCES editeurs(id) ON DELETE SET NULL;

INSERT INTO librarie.editeurs (nom) VALUES 
('Gallimard'),
('Flammarion'),
('Actes Sud'),
('Hachette'),
('Albin Michel');

CREATE TABLE auteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

ALTER TABLE livres
DROP COLUMN auteur,
ADD COLUMN auteur_id INT,
ADD CONSTRAINT fk_auteur FOREIGN KEY (auteur_id) REFERENCES auteurs(id) ON DELETE SET NULL;

INSERT INTO auteurs (nom) VALUES
('Victor Hugo'),
('Jules Verne'),
('Marguerite Duras'),
('Albert Camus'),
('George Orwell');