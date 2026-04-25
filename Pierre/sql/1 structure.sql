DROP DATABASE IF EXISTS FixVille ;
CREATE DATABASE IF NOT EXISTS FixVille;
USE FixVille;

-- Suppression des tables dans l'ordre inverse des dépendances pour éviter les erreurs

-- --------------------------------------------------------
-- CREATION DES TABLES
-- --------------------------------------------------------

DROP TABLE IF EXISTS role;
CREATE TABLE IF NOT EXISTS role ( 
    id_role INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS ville;
CREATE TABLE IF NOT EXISTS ville (
    id_ville INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ville VARCHAR(50) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    departement VARCHAR(50) NOT NULL,
    region VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS utilisateur;
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pwd TEXT NOT NULL,
    adresse TEXT NOT NULL,
    tel NUMERIC NOT NULL,
    date_naissance DATE NOT NULL,
    id_role INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS travaux;
CREATE TABLE IF NOT EXISTS travaux (
    id_travaux INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_ville INTEGER NOT NULL,
    id_poste INTEGER NOT NULL,
    cout INTEGER NOT NULL,
    commande VARCHAR(100) NOT NULL,
    date_commande DATE NOT NULL,
    date_validation DATE NOT NULL,
    date_fin DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS poste;
CREATE TABLE IF NOT EXISTS poste (
    id_poste INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_ville INTEGER NOT NULL,
    id_utilisateur INTEGER NOT NULL,
    adresse TEXT,
    contenu TEXT,
    importance TEXT,
    nb_upvote INTEGER,
    source_photo TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS message;
CREATE TABLE IF NOT EXISTS message (
    id_message INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INTEGER NOT NULL, -- Ajout de la colonne pour la clé étrangère
    content TEXT,
    objet TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS notification;
CREATE TABLE IF NOT EXISTS notification (
    id_notification INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_message INTEGER NOT NULL,
    id_poste INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS gerant;
CREATE TABLE IF NOT EXISTS gerant (
    id_gerant INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INTEGER NOT NULL,
    id_ville INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS favori;
CREATE TABLE IF NOT EXISTS favori (
    id_favori INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INTEGER NOT NULL,
    id_poste INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;