INSERT INTO `role` (`libelle`) VALUES 
('Administrateur'),
('Utilisateur Standard'),
('Responsable DST');

-- Insertion des Utilisateurs
INSERT INTO `users` (`username`, `login`, `password`, `adresse`, `tel`) VALUES 
('AdminECF', 'admin@free.fr', 'motdepassehash1', '1 Mairie, 59220 Denain', '0600000001'),
('Jean Dupont', 'jean.dupont@mail.fr', 'motdepassehash2', '15 rue de Paris, 59000 Lille', '0612345678'),
('Marie Curie', 'marie.c@science.fr', 'motdepassehash3', '10 avenue de la Recherche, 75000 Paris', '0698765432');

-- Insertion des Villes
INSERT INTO `ville` (`code_postal`, `nom`, `email`, `tel`, `adresse`, `departement`) VALUES 
(59220, 'Denain', 'contact@ville-denain.fr', '0327235959', '120 Rue de Villars', 'Nord'),
(59000, 'Lille', 'contact@lille.fr', '0320495000', 'Place Augustin Laurent', 'Nord'),
(75000, 'Paris', 'mairie@paris.fr', '0142764040', 'Place de l Hotel de Ville', 'Paris');

-- Insertion des Formulaires de signalement
INSERT INTO `formulaire` (`date_form`, `adresse`, `importance`) VALUES 
('2026-04-20', 'Avenue Jean Jaurès, Denain', 'Haute'),
('2026-04-21', 'Rue Gambetta, Lille', 'Moyenne'),
('2026-04-21', 'Boulevard Haussmann, Paris', 'Basse');

-- Insertion de quelques Messages
INSERT INTO `message` (`contenu`, `objet`) VALUES 
('Le lampadaire de la rue Gambetta clignote depuis 3 jours.', 'Signalement éclairage public'),
('Nid de poule très dangereux apparu après les fortes pluies.', 'Urgence voirie');