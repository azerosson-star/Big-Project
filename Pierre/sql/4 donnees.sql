--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`libelle`) VALUES
('visiteur'),
('gerant'),
('admin');

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`nom`, `prenom`, `email`, `pwd`, `id_role`) VALUES
('toto','tutu','toto.tutu@gmail.com','toto',3),
('tata','titi','tata.titi@gmail.com','tata',2),
('tati','tita','tati.tita@gmail.com','tati',1),
('tutu','tutu','tutu.tutu@gmail.com','tutu',1);

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`nom`, `description`) VALUES
('stylo', 'un stylo rouge'),
('feutre', 'un feutre bleu'),
('colle', 'une colle goût fraise'),
('ciseaux', 'une paire de ciseaux pour gaucher'),
('feuille', 'une feuille de coloriage'),
('pierre', 'bat les ciseaux');