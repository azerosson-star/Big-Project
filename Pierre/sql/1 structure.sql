DROP DATABASE IF EXISTS FixVille;

CREATE DATABASE IF NOT EXISTS FixVille;

USE FixVille;

DROP TABLE IF EXISTS role;

CREATE TABLE
    IF NOT EXISTS role (
        id_role INTEGER NOT NULL AUTO_INCREMENT,
        libelle TEXT NOT NULL,
        niveau_perm INTEGER NOT NULL,
        PRIMARY KEY (id_role)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS ville;

CREATE TABLE
    IF NOT EXISTS ville (
        id_ville INTEGER NOT NULL AUTO_INCREMENT,
        ville VARCHAR(50) NOT NULL,
        code_postal VARCHAR(5) NOT NULL,
        departement VARCHAR(50) NOT NULL,
        region VARCHAR(50) NOT NULL,
        PRIMARY KEY (id_ville)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS utilisateur;

CREATE TABLE
    IF NOT EXISTS utilisateur (
        id_utilisateur INTEGER NOT NULL AUTO_INCREMENT,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        mdp TEXT NOT NULL,
        adresse TEXT NOT NULL,
        tel VARCHAR(10) NOT NULL,
        date_naissance DATE NOT NULL,
        id_role INTEGER NOT NULL,
        PRIMARY KEY (id_utilisateur),
        KEY fk_utilisateur_role (id_role)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS travaux;

CREATE TABLE
    IF NOT EXISTS travaux (
        id_travaux INTEGER NOT NULL AUTO_INCREMENT,
        id_ville INTEGER NOT NULL,
        id_signalement INTEGER NOT NULL,
        cout INTEGER NOT NULL,
        commande VARCHAR(100) NOT NULL,
        date_commande DATE NOT NULL,
        date_validation DATE NOT NULL,
        date_fin DATE NOT NULL,
        PRIMARY KEY (id_travaux),
        KEY fk_travaux_ville (id_ville),
        KEY fk_travaux_signalement (id_signalement)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS signalement;

CREATE TABLE
    IF NOT EXISTS signalement (
        id_signalement INTEGER NOT NULL AUTO_INCREMENT,
        id_ville INTEGER NOT NULL,
        id_utilisateur INTEGER NOT NULL,
        adresse TEXT NOT NULL,
        titre TEXT NOT NULL,
        contenu TEXT NOT NULL,
        importance TEXT NOT NULL,
        nb_upvote INTEGER DEFAULT 0,
        date_publication DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        source_photo TEXT,
        PRIMARY KEY (id_signalement),
        KEY fk_signalement_ville (id_ville),
        KEY fk_signalement_utilisateur (id_utilisateur)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS message;

CREATE TABLE
    IF NOT EXISTS message (
        id_message INTEGER NOT NULL AUTO_INCREMENT,
        content TEXT NOT NULL,
        objet TEXT NOT NULL,
        PRIMARY KEY (id_message)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS notification;

CREATE TABLE
    IF NOT EXISTS notification (
        id_notification INTEGER NOT NULL AUTO_INCREMENT,
        id_message INTEGER NOT NULL,
        id_signalement INTEGER,
        id_utilisateur INTEGER,
        id_ville INTEGER,
        id_travaux INTEGER,
        date_envoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id_notification),
        KEY fk_notification_message (id_message),
        KEY fk_notification_signalement (id_signalement),
        KEY fk_notification_utilisateur (id_utilisateur),
        KEY fk_notification_ville (id_ville),
        KEY fk_notification_travaux (id_travaux)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS gerant;

CREATE TABLE
    IF NOT EXISTS gerant (
        id_gerant INTEGER NOT NULL AUTO_INCREMENT,
        id_utilisateur INTEGER NOT NULL,
        id_ville INTEGER NOT NULL,
        PRIMARY KEY (id_gerant),
        KEY fk_gerant_utilisateur (id_utilisateur),
        KEY fk_gerant_ville (id_ville)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS favori;

CREATE TABLE
    IF NOT EXISTS favori (
        id_favori INTEGER NOT NULL AUTO_INCREMENT,
        id_utilisateur INTEGER NOT NULL,
        id_signalement INTEGER NOT NULL,
        date_ajout DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id_favori),
        KEY fk_favoris_utilisateur (id_utilisateur),
        KEY fk_favoris_signalement (id_signalement)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;