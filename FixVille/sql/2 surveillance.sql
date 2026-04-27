USE fixville;

-- La table utilisateur possède déjà ses champs de surveillance 
-- (créés directement dans StructureBigBDD.sql). On l'ignore ici.

ALTER TABLE `poste`
ADD `date_crea` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `notification`
ADD `date_crea` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;