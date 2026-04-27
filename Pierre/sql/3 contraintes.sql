ALTER TABLE utilisateur
ADD CONSTRAINT fk_utilisateur_role FOREIGN KEY (id_role) REFERENCES role (id_role) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE travaux
ADD CONSTRAINT fk_travaux_ville FOREIGN KEY (id_ville) REFERENCES ville (id_ville) ON DELETE RESTRICT ON UPDATE RESTRICT,

ADD CONSTRAINT fk_travaux_signalement FOREIGN KEY (id_signalement) REFERENCES signalement (id_signalement) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE signalement
ADD CONSTRAINT fk_signalement_ville FOREIGN KEY (id_ville) REFERENCES ville (id_ville) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_signalement_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE notification
ADD CONSTRAINT fk_notification_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_notification_ville FOREIGN KEY (id_ville) REFERENCES ville (id_ville) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_notification_travaux FOREIGN KEY (id_travaux) REFERENCES travaux (id_travaux) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_notification_message FOREIGN KEY (id_message) REFERENCES message (id_message) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_notification_signalement FOREIGN KEY (id_signalement) REFERENCES signalement (id_signalement) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE gerant
ADD CONSTRAINT fk_gerant_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_gerant_ville FOREIGN KEY (id_ville) REFERENCES ville (id_ville) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE favori
ADD CONSTRAINT fk_favori_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT fk_favori_signalement FOREIGN KEY (id_signalement) REFERENCES signalement (id_signalement) ON DELETE RESTRICT ON UPDATE RESTRICT;