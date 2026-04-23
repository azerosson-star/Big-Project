<?php

class RoleService
{
# methods ************************
    public static function find_by_id($id_role)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM role WHERE id_role=:id_role ";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_role', $id_role, PDO::PARAM_INT);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        if ($donnees != null) {
            $role = new Role($donnees);
            return $role;
        }
        return null;
    }

    public static function select(?array $conditions = null,bool $debug = false)
    {
        $db      = DbConnect::get_db();
        $req     = "SELECT * FROM role ".select_conditions($conditions);
        $requete = $db->prepare($req);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            if ($donnees != false) {
                $role[] = new Role($donnees);
            }
        }
        $requete->closeCursor();
        $debug?var_dump($requete):'';
        return $role;
    }

    public static function insert($role)
    {
        $db      = DbConnect::get_db();
        $req     = "INSERT INTO role (libelle,utilisateur_creator) VALUES (:libelle,:utilisateur_creator)";
        $requete = $db->prepare($req);
        $requete->bindValue(':libelle', $role->get_libelle(), PDO::PARAM_STR);
        $requete->bindValue(':utilisateur_creator', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function update($role)
    {
        $db      = DbConnect::get_db();
        $req     = "UPDATE role SET nom=:nom,libelle=:libelle,utilisateur_modif=:utilisateur_modif WHERE id_role=:id_role";
        $requete = $db->prepare($req);
        $requete->bindValue(':libelle', $role->get_libelle(), PDO::PARAM_STR);
        $requete->bindValue(':id_role', $role->get_id_role(), PDO::PARAM_INT);
        $requete->bindValue(':utilisateur_modif', isset($_SESSION['utilisateur']) ? $_SESSION['utilisateur']->get_id_utilisateur() : null, PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function delete($id)
    {
        $db      = DbConnect::get_db();
        $req     = "DELETE FROM role WHERE id_role=:id_role";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_role', $id);
        $requete->execute();
        $requete->closeCursor();
    }

#endMethods
}
