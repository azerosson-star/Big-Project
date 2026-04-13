Drop table if exists formulaire;
CREATE TABLE IF NOT EXISTS formulaire (
    id_form integer not null primary key AUTOINCREMENT,
    date_form varchar(10),
    adresse text,
    importance text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
Drop table if exists message;
CREATE TABLE IF NOT EXISTS message (
    id_message integer not null primary key AUTOINCREMENT,
    contenu text,
    objet text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
Drop table if exists photo;
CREATE TABLE IF NOT EXISTS photo (
    id_photo integer not null primary key AUTOINCREMENT,
    date_photo varchar(10),
    position text,
    taille text,
    source text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
Drop table if exists role;
CREATE TABLE IF NOT EXISTS 'role' ( 
    id_role integer not null primary key AUTOINCREMENT,
    libelle text not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
Drop table if exists utilisateur;
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INTEGER not null primary key AUTOINCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mdp TEXT NOT NULL,
    email TEXT NOT NULL,
    adresse TEXT NOT NULL,
    tel NUMERIC NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
Drop table if exists ville;
CREATE TABLE IF NOT EXISTS ville (
    id_ville integer not null primary key AUTOINCREMENT,
    code_postal NUMERIC,
    nom text,
    email text,
    tel numeric,
    adresse text,
    departement text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

