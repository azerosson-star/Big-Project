-- Insertion de rôles supplémentaires
INSERT INTO
    role (libelle)
VALUES
    ('Superviseur travaux'),
    ('Agent de maintenance'),
    ('Administrateur'),
    ('Utilisateur standard'),
    ('Modérateur'),
    ('Invité');

-- Insertion de villes supplémentaires
INSERT INTO
    ville (ville, code_postal, departement, region)
VALUES
    ('Rennes', '35000', 'Ille-et-Vilaine', 'Bretagne'),
    (
        'Grenoble',
        '38000',
        'Isère',
        'Auvergne-Rhône-Alpes'
    ),
    (
        'Dijon',
        '21000',
        'Côte-d''Or',
        'Bourgogne-Franche-Comté'
    ),
    (
        'Saint-Étienne',
        '42000',
        'Loire',
        'Auvergne-Rhône-Alpes'
    ),
    (
        'Le Havre',
        '76600',
        'Seine-Maritime',
        'Normandie'
    ),
    ('Paris', '75001', 'Paris', 'Île-de-France'),
    (
        'Marseille',
        '13001',
        'Bouches-du-Rhône',
        "Provence-Alpes-Côte d'Azur"
    ),
    ('Lyon', '69001', 'Rhône', 'Auvergne-Rhône-Alpes'),
    ('Toulouse', '31000', 'Haute-Garonne', 'Occitanie'),
    (
        'Nice',
        '06000',
        'Alpes-Maritimes',
        "Provence-Alpes-Côte d'Azur"
    ),
    (
        'Nantes',
        '44000',
        'Loire-Atlantique',
        'Pays de la Loire'
    ),
    ('Strasbourg', '67000', 'Bas-Rhin', 'Grand Est'),
    ('Montpellier', '34000', 'Hérault', 'Occitanie'),
    (
        'Bordeaux',
        '33000',
        'Gironde',
        'Nouvelle-Aquitaine'
    ),
    ('Lille', '59000', 'Nord', 'Hauts-de-France');

-- Insertion d'utilisateurs supplémentaires
INSERT INTO
    utilisateur (
        nom,
        prenom,
        email,
        mdp,
        adresse,
        tel,
        date_naissance,
        id_role
    )
VALUES
    (
        'Lemoine',
        'Pierre',
        'pierre.lemoine@email.com',
        'pierre2024',
        '3 rue de la Paix, 35000 Rennes',
        '0701234567',
        '1992-01-20',
        2
    ),
    (
        'Roux',
        'Marie',
        'marie.roux@email.com',
        'mariepass456',
        '45 avenue Jean Jaurès, 38000 Grenoble',
        '0712345678',
        '1987-05-14',
        5
    ),
    (
        'Fournier',
        'Hugo',
        'hugo.fournier@email.com',
        'hugo.789pass',
        '12 rue de la Liberté, 21000 Dijon',
        '0723456789',
        '1980-11-30',
        1
    ),
    (
        'Andre',
        'Léa',
        'lea.andre@email.com',
        'lea2024pass',
        '28 rue du Commerce, 42000 Saint-Étienne',
        '0734567890',
        '1996-08-17',
        6
    ),
    (
        'Mercier',
        'Paul',
        'paul.mercier@email.com',
        'paulpass321',
        '5 quai de la Seine, 76600 Le Havre',
        '0745678901',
        '1991-03-25',
        2
    ),
    (
        'Dupont',
        'Jean',
        'jean.dupont@email.com',
        'password123',
        '10 rue de Paris, 75001 Paris',
        '0612345678',
        '1985-03-15',
        2
    ),
    (
        'Martin',
        'Sophie',
        'sophie.martin@email.com',
        'securepass456',
        '25 avenue des Fleurs, 13001 Marseille',
        '0623456789',
        '1990-07-22',
        2
    ),
    (
        'Bernard',
        'Lucas',
        'lucas.bernard@email.com',
        'admin789',
        '5 place Bellecour, 69001 Lyon',
        '0634567890',
        '1978-11-10',
        1
    ),
    (
        'Petit',
        'Emma',
        'emma.petit@email.com',
        'userpass321',
        '15 rue du Taur, 31000 Toulouse',
        '0645678901',
        '1995-02-28',
        2
    ),
    (
        'Robert',
        'Thomas',
        'thomas.robert@email.com',
        'modpass654',
        '8 boulevard Gambetta, 06000 Nice',
        '0656789012',
        '1988-09-05',
        3
    ),
    (
        'Richard',
        'Julie',
        'julie.richard@email.com',
        'guestpass987',
        '42 rue Crébillon, 44000 Nantes',
        '0667890123',
        '2000-12-18',
        4
    ),
    (
        'Dubois',
        'Nicolas',
        'nicolas.dubois@email.com',
        'pass123456',
        '7 rue de la Nuée Bleue, 67000 Strasbourg',
        '0678901234',
        '1982-06-30',
        2
    ),
    (
        'Moreau',
        'Clara',
        'clara.moreau@email.com',
        'secure987654',
        '12 rue de la Loge, 34000 Montpellier',
        '0689012345',
        '1993-04-12',
        2
    ),
    (
        'Simon',
        'Antoine',
        'antoine.simon@email.com',
        'admin2023',
        "18 cours de l'Intendance, 33000 Bordeaux",
        '0690123456',
        '1975-08-25',
        1
    ),
    (
        'Laurent',
        'Camille',
        'camille.laurent@email.com',
        'user2023',
        '30 rue Nationale, 59000 Lille',
        '0601234567',
        '1998-10-03',
        2
    );

-- Insertion de signalements (signalements de problèmes)
INSERT INTO
    signalement (
        id_ville,
        id_utilisateur,
        adresse,
        titre,
        contenu,
        importance,
        nb_upvote,
        source_photo
    )
VALUES
    (
        1,
        1,
        '10 rue de Rivoli, 75001 Paris',
        'Nid-de-poule dangereux',
        'Un nid-de-poule de 30cm de diamètre s''est formé au milieu de la chaussée. Risque d''accident pour les cyclistes.',
        'Haute',
        45,
        'nid_poule_rivoli.jpg'
    ),
    (
        2,
        2,
        '25 rue de la République, 13001 Marseille',
        'Lampadaire défectueux',
        'Le lampadaire situé devant le numéro 25 ne fonctionne plus depuis une semaine. Le quartier est très sombre la nuit.',
        'Moyenne',
        23,
        'lampadaire_marseille.jpg'
    ),
    (
        3,
        4,
        '15 rue Victor Hugo, 69001 Lyon',
        'Trottoir dégradé',
        'Le trottoir est complètement défoncé sur 10 mètres. Impossible de passer en poussette ou en fauteuil roulant.',
        'Haute',
        78,
        'trottoir_lyon.jpg'
    ),
    (
        5,
        5,
        '3 boulevard Wilson, 06000 Nice',
        'Graffitis sur mur public',
        'Des graffitis ont été tagués sur le mur de l''école primaire Jean Jaurès.',
        'Basse',
        12,
        'graffiti_nice.jpg'
    ),
    (
        7,
        7,
        '8 place Kléber, 67000 Strasbourg',
        'Banc public cassé',
        'Un banc public place Kléber est cassé avec des lattes manquantes. Danger pour les personnes âgées.',
        'Moyenne',
        34,
        NULL
    ),
    (
        10,
        8,
        '50 rue de la Monnaie, 59000 Lille',
        'Fuite d''eau sur voie publique',
        'Une fuite d''eau importante est visible au niveau du 50 rue de la Monnaie. Gaspillage d''eau important.',
        'Haute',
        91,
        'fuite_lille.jpg'
    ),
    (
        2,
        11,
        '10 avenue du Prado, 13001 Marseille',
        'Arbre menaçant de tomber',
        'Suite aux vents violents, un arbre est penché dangereusement au-dessus de la voie publique.',
        'Urgente',
        156,
        'arbre_danger_marseille.jpg'
    ),
    (
        4,
        12,
        '5 place du Capitole, 31000 Toulouse',
        'Éclairage public éteint',
        'Tout l''éclairage de la place du Capitole est éteint depuis 3 jours. Problème de sécurité publique.',
        'Haute',
        67,
        NULL
    );

-- Insertion de travaux
INSERT INTO
    travaux (
        id_ville,
        id_signalement,
        cout,
        commande,
        date_commande,
        date_validation,
        date_fin
    )
VALUES
    (
        1,
        1,
        1500,
        'Réparation nid-de-poule rue de Rivoli',
        '2024-01-15',
        '2024-01-16',
        '2024-01-20'
    ),
    (
        2,
        2,
        800,
        'Remplacement ampoule lampadaire rue de la République',
        '2024-01-18',
        '2024-01-19',
        '2024-01-21'
    ),
    (
        3,
        3,
        3500,
        'Réfection trottoir rue Victor Hugo',
        '2024-02-01',
        '2024-02-03',
        '2024-02-15'
    ),
    (
        5,
        4,
        500,
        'Nettoyage graffitis école Jean Jaurès',
        '2024-02-10',
        '2024-02-11',
        '2024-02-12'
    ),
    (
        10,
        6,
        2500,
        'Réparation fuite d''eau rue de la Monnaie',
        '2024-03-05',
        '2024-03-05',
        '2024-03-08'
    ),
    (
        2,
        7,
        4200,
        'Abattage et évacuation arbre dangereux avenue du Prado',
        '2024-04-01',
        '2024-04-01',
        '2024-04-03'
    );

-- Insertion de messages
INSERT INTO
    message (content, objet)
VALUES
    (
        'Vos travaux de réparation du nid-de-poule rue de Rivoli ont été planifiés pour le 20 janvier.',
        'Confirmation de travaux'
    ),
    (
        'Merci pour votre signalement. Un technicien va intervenir dans les 48h.',
        'Signalement pris en compte'
    ),
    (
        'Rappel : maintenance des espaces verts prévue ce vendredi dans votre quartier.',
        'Information maintenance'
    ),
    (
        'Votre demande de réparation a été évaluée et jugée prioritaire.',
        'Statut de votre demande'
    );

-- Insertion de notifications
INSERT INTO
    notification (
        id_message,
        id_signalement,
        id_utilisateur,
        id_ville,
        id_travaux
    )
VALUES
    (1, 1, 1, 1, 1),
    (2, 2, 2, 2, 2),
    (3, NULL, 7, 7, NULL),
    (4, 6, 8, 10, 5),
    (2, 3, 4, 3, 3);

-- Insertion de gérants
INSERT INTO
    gerant (id_utilisateur, id_ville)
VALUES
    (3, 1),
    (9, 2),
    (13, 3),
    (4, 4),
    (5, 5),
    (7, 7),
    (11, 10),
    (12, 8);

-- Insertion de favoris
INSERT INTO
    favori (id_utilisateur, id_signalement)
VALUES
    (1, 2),
    (1, 3),
    (2, 1),
    (4, 5),
    (7, 1),
    (7, 6),
    (8, 7),
    (11, 3),
    (12, 6),
    (12, 8);

-- Insertion de signalements supplémentaires avec différents niveaux d'importance
INSERT INTO
    signalement (
        id_ville,
        id_utilisateur,
        adresse,
        titre,
        contenu,
        importance,
        nb_upvote,
        source_photo
    )
VALUES
    (
        8,
        14,
        '3 rue Foch, 34000 Montpellier',
        'Panneau de signalisation tordu',
        'Le panneau stop à l''intersection est complètement tordu et illisible.',
        'Haute',
        28,
        NULL
    ),
    (
        9,
        15,
        '2 cours Pasteur, 33000 Bordeaux',
        'Poubelle publique débordante',
        'Les poubelles du cours Pasteur débordent depuis 4 jours. Problème d''hygiène publique.',
        'Moyenne',
        15,
        'poubelle_bordeaux.jpg'
    ),
    (
        10,
        15,
        '15 rue Solférino, 59000 Lille',
        'Plaque d''égout manquante',
        'Une plaque d''égout a disparu, laissant un trou béant. Extrêmement dangereux !',
        'Urgente',
        203,
        'plaque_egout_lille.jpg'
    );