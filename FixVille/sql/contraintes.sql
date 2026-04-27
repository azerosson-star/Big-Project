USE fixville;

-- ON CRÉE LES NOUVELLES RÈGLES (AVEC CASCADE)
ALTER TABLE utilisateur
    ADD CONSTRAINT fk_utilisateur_role FOREIGN KEY (id_role) REFERENCES role (id_role) ON DELETE RESTRICT;

ALTER TABLE message
    ADD CONSTRAINT fk_message_expediteur FOREIGN KEY (id_expediteur) REFERENCES utilisateur (id_utilisateur) ON DELETE CASCADE,
    ADD CONSTRAINT fk_message_destinataire FOREIGN KEY (id_destinataire) REFERENCES utilisateur (id_utilisateur) ON DELETE CASCADE;

ALTER TABLE notification
    ADD CONSTRAINT fk_notification_message FOREIGN KEY (id_message) REFERENCES message (id_message) ON DELETE CASCADE,
    ADD CONSTRAINT fk_notification_poste FOREIGN KEY (id_poste) REFERENCES poste (id_poste) ON DELETE CASCADE;

ALTER TABLE poste
    ADD CONSTRAINT fk_poste_ville FOREIGN KEY (id_ville) REFERENCES ville (id_ville) ON DELETE RESTRICT,
    ADD CONSTRAINT fk_poste_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur) ON DELETE CASCADE,
    ADD CONSTRAINT fk_poste_travaux FOREIGN KEY (id_travaux) REFERENCES travaux (id_travaux) ON DELETE CASCADE;