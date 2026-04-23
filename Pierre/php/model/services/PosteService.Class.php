<?php

class PosteService
{
# methods ************************
    public static function find_by_id($id_poste)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM poste WHERE id_poste=:id_poste";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_poste', $id_poste, PDO::PARAM_INT);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        if ($donnees != null) {
            $poste = new Poste($donnees);
            return $poste;
        }
        return null;
    }

    public static function select(?array $conditions = null,bool $debug = false)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM poste ".select_conditions($conditions);
        $requete = $db->prepare($req);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $prod[] = new Poste($donnees);
            }
        }
        $requete->closeCursor();
        $debug?var_dump($requete):'';
        return $prod;
    }

    public static function insert($prod)
    {
        $db      = DbConnect::get_db();
        $req     = "INSERT INTO poste (nom,contenu,date_poste,adresse,importance,nb_upvote,source_phot,id_ville,id_utilisateur,id_travaux,utilisateur_creator) VALUES (:nom,:contenu,:date_poste,:adresse,:importance,:nb_upvote,:source_phot,:id_ville,:id_utilisateur,:id_travaux,:utilisateur_creator)";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom', $prod->get_nom(), PDO::PARAM_STR);
        $requete->bindValue(':contenu', $prod->get_contenu(), PDO::PARAM_STR);
        $requete->bindValue(':date_poste', $prod->get_date_poste(), PDO::PARAM_STR);
        $requete->bindValue(':adresse', $prod->get_adresse(), PDO::PARAM_STR);
        $requete->bindValue(':importance', $prod->get_importance(), PDO::PARAM_INT);
        $requete->bindValue(':nb_upvote', $prod->get_nb_upvote(), PDO::PARAM_INT);
        $requete->bindValue(':source_photo', $prod->get_source_photo(), PDO::PARAM_STR);
        $requete->bindValue(':id_ville', $prod->get_id_ville(), PDO::PARAM_INT);
        $requete->bindValue(':id_utilisateur', $prod->get_id_utilisateur(), PDO::PARAM_INT);
        $requete->bindValue(':id_travaux', $prod->get_id_travaux(), PDO::PARAM_INT);
        $requete->bindValue(':utilisateur_creator', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function update($prod)
    {
        $db      = DbConnect::get_db();
        $req     = "UPDATE poste SET nom=:nom,contenu=:contenu,date_poste=:date_poste,adresse=:adresse,importance=:importance,nb_upvote=:nb_upvote,source_photo=:source_photo,id_ville=:id_ville,id_utilisateur=:id_utilisateur,id_travaux=:id_travaux,utilisateur_modif=:utilisateur_modif WHERE id_poste=:id_poste";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom', $prod->get_nom(), PDO::PARAM_STR);
        $requete->bindValue(':contenu', $prod->get_contenu(), PDO::PARAM_STR);
        $requete->bindValue(':date_poste', $prod->get_date_poste(), PDO::PARAM_STR);
        $requete->bindValue(':adresse', $prod->get_adresse(), PDO::PARAM_STR);
        $requete->bindValue(':importance', $prod->get_importance(), PDO::PARAM_INT);
        $requete->bindValue(':nb_upvote', $prod->get_nb_upvote(), PDO::PARAM_INT);
        $requete->bindValue(':source_photo', $prod->get_source_photo(), PDO::PARAM_STR);
        $requete->bindValue(':id_ville', $prod->get_id_ville(), PDO::PARAM_INT);
        $requete->bindValue(':id_utilisateur', $prod->get_id_utilisateur(), PDO::PARAM_INT);
        $requete->bindValue(':id_travaux', $prod->get_id_travaux(), PDO::PARAM_INT);
        $requete->bindValue(':id_poste', $prod->get_id_poste(), PDO::PARAM_INT);
        $requete->bindValue(':utilisateur_modif', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function delete($id)
    {
        $db      = DbConnect::get_db();
        $req     = "DELETE FROM poste WHERE id_poste=:id_poste";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_poste', $id, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

#endMethods
}
