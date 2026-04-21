<?php

class UtilisateurService
{
    public static function select(?array $colonnes, ?array $conditions = null, ?string $orderBy = null, bool $api = false, bool $debug=false)
    {
        return DAO::select($colonnes,"users",$conditions,$orderBy,$api,$debug);
    }

    public static function findByLogin($login)
    {
        $bdd = DbConnect::getConnectBase();
        $reqString = "select * from users where login = :login";
        $requete = $bdd->prepare($reqString);
        $requete->bindValue(":login", $login);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            $utilisateur = new Utilisateur($donnees);
        }
        return $utilisateur;
    }

    public static function findById($id)
    {
        $bdd = DbConnect::getConnectBase();
        $reqString = "select * from users where id_user = :id";
        $requete = $bdd->prepare($reqString);
        $requete->bindValue(":id", $id);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            $utilisateur = new Utilisateur($donnees);
        }
        return $utilisateur;
    }

    // CORRECTION : Adapté aux champs réels de la table `users`
    static function insert($util)
    {
        $db = DbConnect::getConnectBase();
        $req = "insert into users (username, login, password, adresse, tel) VALUES (:username, :login, :password, :adresse, :tel)";
        $requete = $db->prepare($req);
        $requete->bindValue(':username', $util->getUsername(), PDO::PARAM_STR);
        $requete->bindValue(':login', $util->getLogin(), PDO::PARAM_STR);
        $requete->bindValue(':password', $util->getPassword(), PDO::PARAM_STR);
        $requete->bindValue(':adresse', $util->getAdresse(), PDO::PARAM_STR);
        $requete->bindValue(':tel', $util->getTel(), PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    // CORRECTION : Adapté aux champs réels de la table `users`
    static function update($util)
    {
        $db = DbConnect::getConnectBase();
        $req = "UPDATE users SET username=:username, login=:login, password=:password, adresse=:adresse, tel=:tel WHERE id_user=:id_user";
        $requete = $db->prepare($req);
        $requete->bindValue(':username', $util->getUsername(), PDO::PARAM_STR);
        $requete->bindValue(':login', $util->getLogin(), PDO::PARAM_STR);
        $requete->bindValue(':password', $util->getPassword(), PDO::PARAM_STR);
        $requete->bindValue(':adresse', $util->getAdresse(), PDO::PARAM_STR);
        $requete->bindValue(':tel', $util->getTel(), PDO::PARAM_INT);
        $requete->bindValue(':id_user', $util->getIdUser(), PDO::PARAM_INT);
        $requete->execute();
        $requete->closeCursor();
    }

    static function delete($id)
    {
        $db = DbConnect::getConnectBase();
        $req = "DELETE FROM users WHERE id_user=:id_user";
        $requete = $db->prepare($req);
        $requete->bindValue(':id_user', $id);
        $requete->execute();
        $requete->closeCursor();
    }
}