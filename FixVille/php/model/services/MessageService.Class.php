<?php
class MessageService {
    // Pour récupérer les messages reçus
   // Remplacez "message" par "Message"
    public static function findByDestinataire($id_destinataire) {
        // La casse est vitale pour l'Autoloader !
        return DAO::select(null, "Message", ["id_destinataire" => $id_destinataire], "date_envoi DESC");
    }

    // Pour envoyer un message
    public static function insert($message) {
        $bdd = DbConnect::getConnectBase();
        $requete = $bdd->prepare("INSERT INTO message (id_expediteur, id_destinataire, objet, content) VALUES (:exp, :dest, :obj, :cont)");
        $requete->execute([
            ':exp' => $message->getId_expediteur(),
            ':dest' => $message->getId_destinataire(),
            ':obj' => $message->getObjet(),
            ':cont' => $message->getContent()
        ]);
    }
    // Pour supprimer un message de manière sécurisée
    public static function delete($id_message, $id_utilisateur) {
        $bdd = DbConnect::getConnectBase();
        // On s'assure que seul le destinataire peut supprimer SON message
        $requete = $bdd->prepare("DELETE FROM message WHERE id_message = :id_msg AND id_destinataire = :id_dest");
        $requete->execute([
            ':id_msg' => $id_message,
            ':id_dest' => $id_utilisateur
        ]);
    }
}
