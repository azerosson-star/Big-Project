--PAS FINI
CREATE DATABASE IF NOT EXISTS FixVIlle;

USE FixVIlle;

DROP TABLE IF EXISTS form;

CREATE TABLE
    ville (
        id_ville INT AUTO_INCREMENT,
        code_postal CHAR(5) NOT NULL,
        departement VARCHAR(50) NOT NULL,
        PRIMARY KEY (id_ville)
    );

CREATE TABLE
    travaux (
        id_travaux INT AUTO_INCREMENT,
        cout DECIMAL(9, 2) NOT NULL,
        demande BOOLEAN NOT NULL DEFAULT FALSE,
        valide BOOLEAN NOT NULL DEFAULT FALSE,
        date_demande DATE,
        date_validation DATE,
        id_ville INT NOT NULL,
        PRIMARY KEY (id_travaux),
        FOREIGN KEY (id_ville) REFERENCES ville (id_ville)
    );

CREATE TABLE
    role (
        id_role INT AUTO_INCREMENT,
        libelle VARCHAR(50) NOT NULL,
        PRIMARY KEY (id_role)
    );

CREATE TABLE
    utilisateur (
        id_utilisateur INT AUTO_INCREMENT,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        pwd CHAR(32) NOT NULL,
        email VARCHAR(50) NOT NULL,
        adresse VARCHAR(50) NOT NULL,
        tel CHAR(10) NOT NULL,
        date_naissance DATE NOT NULL,
        date_inscription DATE NOT NULL,
        id_role INT NOT NULL,
        PRIMARY KEY (id_utilisateur),
        FOREIGN KEY (id_role) REFERENCES role (id_role)
    );

CREATE TABLE
    message (
        id_message INT AUTO_INCREMENT,
        contenu TEXT NOT NULL,
        objet VARCHAR(50) NOT NULL,
        PRIMARY KEY (id_message)
    );

CREATE TABLE
    poste (
        id_poste INT AUTO_INCREMENT,
        date_poste DATE NOT NULL,
        adresse VARCHAR(50) NOT NULL,
        importance TINYINT NOT NULL,
        nb_upvote INT NOT NULL DEFAULT 0,
        source_photo VARCHAR(100) NOT NULL,
        id_ville INT NOT NULL,
        id_utilisateur INT NOT NULL,
        id_travaux INT NOT NULL,
        PRIMARY KEY (id_poste),
        FOREIGN KEY (id_ville) REFERENCES ville (id_ville),
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur),
        FOREIGN KEY (id_travaux) REFERENCES travaux (id_travaux)
    );

CREATE TABLE
    notification (
        id_poste INT,
        id_ville INT,
        id_utilisateur INT,
        id_message INT,
        id_travaux INT,
        date_envoi DATE NOT NULL,
        PRIMARY KEY (
            id_poste,
            id_ville,
            id_utilisateur,
            id_message,
            id_travaux
        ),
        FOREIGN KEY (id_poste) REFERENCES poste (id_poste),
        FOREIGN KEY (id_ville) REFERENCES ville (id_ville),
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur),
        FOREIGN KEY (id_message) REFERENCES message (id_message),
        FOREIGN KEY (id_travaux) REFERENCES travaux (id_travaux)
    );

CREATE TABLE
    favoris (
        id_poste INT,
        id_utilisateur INT,
        PRIMARY KEY (id_poste, id_utilisateur),
        FOREIGN KEY (id_poste) REFERENCES poste (id_poste),
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
    );

CREATE TABLE
    gerants (
        id_ville INT,
        id_utilisateur INT,
        PRIMARY KEY (id_ville, id_utilisateur),
        FOREIGN KEY (id_ville) REFERENCES ville (id_ville),
        FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)
    );