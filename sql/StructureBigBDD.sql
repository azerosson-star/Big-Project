<<<<<<< HEAD
CREATE DATABASE IF NOT EXISTS FixVille;
USE FixVille;
=======
>>>>>>> 3d0da33088aec7bc5bf5b376b2bd0ca1b685aed1

-- Suppression des tables dans l'ordre inverse des dépendances pour éviter les erreurs
DROP TABLE IF EXISTS favori;
DROP TABLE IF EXISTS gerant;
DROP TABLE IF EXISTS notification;
DROP TABLE IF EXISTS poste;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS travaux;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS ville;

-- --------------------------------------------------------
-- CREATION DES TABLES
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS role ( 
    id_role INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    libelle TEXT NOT NULL,
    date_creation VARCHAR(10) NOT NULL,
    date_modification VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS ville (
    id_ville INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ville VARCHAR(50) NOT NULL,
    code_postal VARCHAR(10) NOT NULL,
    departement VARCHAR(50) NOT NULL,
    region VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pwd TEXT NOT NULL,
    adresse TEXT NOT NULL,
    tel NUMERIC NOT NULL,
    date_naissance VARCHAR(10) NOT NULL,
    date_inscription VARCHAR(10) NOT NULL,
    date_modification VARCHAR(10) NOT NULL,
    id_role INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS travaux (
    id_travaux INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_ville INTEGER NOT NULL,
    cout INTEGER NOT NULL,
    commande VARCHAR(100) NOT NULL,
    date_commande VARCHAR(10) NOT NULL,
    date_validation VARCHAR(10) NOT NULL,
    date_fin VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS poste (
    id_poste INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_ville INTEGER NOT NULL,
    id_utilisateur INTEGER NOT NULL,
    id_travaux INTEGER NOT NULL,
    date_poste VARCHAR(10),
    adresse TEXT,
    contenu TEXT,
    importance TEXT,
    nb_upvote INTEGER,
    source_photo TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS message (
    id_message INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INTEGER NOT NULL, -- Ajout de la colonne pour la clé étrangère
    content TEXT,
    objet TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS notification (
    id_notification INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_message INTEGER NOT NULL,
    id_poste INTEGER NOT NULL,
    date_notification VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS gerant (
    id_gerant INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INTEGER NOT NULL,
    id_ville INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS favori (
    id_favori INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INTEGER NOT NULL,
    id_poste INTEGER NOT NULL
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



>>>>>>> 3d0da33088aec7bc5bf5b376b2bd0ca1b685aed1
