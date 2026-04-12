BEGIN TRANSACTION;

CREATE TABLE IF NOT EXISTS formulaire (
    id_form integer primary key AUTOINCREMENT,
    date_form varchar(10),
    adresse text,
    importance text
);

CREATE TABLE IF NOT EXISTS message (
    id_message integer primary key AUTOINCREMENT,
    contenu text,
    objet text
);

CREATE TABLE IF NOT EXISTS photo (
    id_photo integer primary key autoincrement,
    date_photo varchar(10),
    position text,
    taille text,
    source text
);

CREATE TABLE IF NOT EXISTS role ( 
    id_role integer primary key AUTOINCREMENT
);

CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mdp TEXT NOT NULL,
    email TEXT NOT NULL,
    adresse TEXT NOT NULL,
    tel NUMERIC NOT NULL
);

CREATE TABLE IF NOT EXISTS ville (
    id_ville integer primary key AUTOINCREMENT,
    code_postal NUMERIC,
    nom text,
    email text,
    tel numeric,
    adresse text,
    departement text
);

COMMIT;