<?php

class ObjectService
{
# methods ************************

/**
 * @param string $table table de l'atribut (aussi la classe de l'objet renvoyé)
 * @param string $attribute colonne de la table
 * @param string $type de l'attribut
 * @param mixed $value valeur recherchée
 * @return object/null $objet renvoie un objet si trouvé, nul si non
 */
    public static function find_by_attribute($table,$attribute,$type,$value)
    {
        $param_type = constant('PDO::PARAM_'.strtoupper($type));
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM ".$table." WHERE ".$attribute."=:".$attribute;
        $requete = $db->prepare($req);
        $requete->bindValue(":".$attribute, $value, $param_type);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        if ($donnees != null) {
            $objet = new $table($donnees);
            return $objet;
        }
        return null;
    }

/**
 * @param string $table table de l'atribut
 * @return object/null $objet renvoi un objet si trouvé, nul si non
 */
    public static function select($table)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM ".$table;
        $requete = $db->prepare($req);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $objet[] = new $table($donnees);
            }
        }
        $requete->closeCursor();
        return $objet;
    }

    public static function insert($table,$uti)
    {
        $db      = DbConnect::get_db();
        $req     = "INSERT INTO ".$table." (".$table::get_attributes().",utilisateur_creator) VALUES (:nom,:prenom,:email,:pwd,:utilisateur_creator)";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom', $uti->get_nom(), PDO::PARAM_STR);
        $requete->bindValue(':prenom', $uti->get_prenom(), PDO::PARAM_STR);
        $requete->bindValue(':email', $uti->get_email(), PDO::PARAM_STR);
        $requete->bindValue(':pwd', $uti->get_pwd(), PDO::PARAM_STR);
        $requete->bindValue(':utilisateur_creator', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function update($uti)
    {
        $db      = DbConnect::get_db();
        $req     = "UPDATE utilisateur SET nom=:nom,prenom=:prenom,email=:email,pwd=:pwd,utilisateur_modif=:utilisateur_modif WHERE id_utilisateur=:id_utilisateur";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom', $uti->get_nom(), PDO::PARAM_STR);
        $requete->bindValue(':prenom', $uti->get_prenom(), PDO::PARAM_STR);
        $requete->bindValue(':email', $uti->get_email(), PDO::PARAM_STR);
        $requete->bindValue(':pwd', $uti->get_pwd(), PDO::PARAM_STR);
        $requete->bindValue(':id_utilisateur', $uti->get_id_utilisateur(), PDO::PARAM_INT);
        $requete->bindValue(':utilisateur_modif', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
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
