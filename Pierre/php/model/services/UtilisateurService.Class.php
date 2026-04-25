<?php

class UtilisateurService
{
# methods ************************
    public static function find_by_id($id_utilisateur)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM utilisateur WHERE id_utilisateur=:id_utilisateur ";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        if ($donnees != null) {
            $utilisateur = new Utilisateur($donnees);
            return $utilisateur;
        }
        return null;
    }
    public static function find_by_email($email)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM utilisateur WHERE email=:email ";
        $requete = $db->prepare($req);
        $requete->bindValue(':email', $email, PDO::PARAM_STR);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        if ($donnees != null) {
            $utilisateur = new Utilisateur($donnees);
            return $utilisateur;
        }
        return null;
    }

    public static function select(?array $conditions = null,bool $debug = false)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM utilisateur ".conditions_select($conditions);
        $requete = $db->prepare($req);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $uti[] = new Utilisateur($donnees);
            }
        }
        $requete->closeCursor();
        $debug?var_dump($requete):'';
        return $uti;
    }

    public static function insert($uti)
    {
        $db      = DbConnect::get_db();
        $req     = "INSERT INTO utilisateur (nom,prenom,email,pwd,id_role,utilisateur_creator) VALUES (:nom,:prenom,:email,:pwd,:id_role,:utilisateur_creator)";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom', $uti->get_nom(), PDO::PARAM_STR);
        $requete->bindValue(':prenom', $uti->get_prenom(), PDO::PARAM_STR);
        $requete->bindValue(':email', $uti->get_email(), PDO::PARAM_STR);
        $requete->bindValue(':pwd', $uti->get_pwd(), PDO::PARAM_STR);
        $requete->bindValue(':id_role', $uti->get_id_role(), PDO::PARAM_INT);
        $requete->bindValue(':utilisateur_creator', (isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null), PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function update($uti)
    {
        $db      = DbConnect::get_db();
        $req     = "UPDATE utilisateur SET nom=:nom,prenom=:prenom,email=:email,pwd=:pwd,id_role=:id_role,utilisateur_modif=:utilisateur_modif WHERE id_utilisateur=:id_utilisateur";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom', $uti->get_nom(), PDO::PARAM_STR);
        $requete->bindValue(':prenom', $uti->get_prenom(), PDO::PARAM_STR);
        $requete->bindValue(':email', $uti->get_email(), PDO::PARAM_STR);
        $requete->bindValue(':pwd', $uti->get_pwd(), PDO::PARAM_STR);
        $requete->bindValue(':id_utilisateur', $uti->get_id_utilisateur(), PDO::PARAM_INT);
        $requete->bindValue(':id_role', $uti->get_id_role(), PDO::PARAM_INT);
        $requete->bindValue(':utilisateur_modif', (isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null), PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function delete($id)
    {
        $db      = DbConnect::get_db();
        $req     = "DELETE FROM utilisateur WHERE id_utilisateur=:id_utilisateur";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_utilisateur', $id);
        $requete->execute();
        $requete->closeCursor();
    }

#endMethods
}
