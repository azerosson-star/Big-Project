<?php

class UtilisateurService
{
    // CORRECTION : On réécrit le select pour interroger la table "users" 
    // mais instancier des objets "Utilisateur"
    public static function select(?array $colonnes = null, ?array $conditions = null, ?string $orderBy = null, bool $api = false, bool $debug = false)
    {
        $bdd = DbConnect::getConnectBase();
        
        // Préparation des colonnes
        $listeColonnes = ($colonnes == null) ? "*" : implode(',', $colonnes);
        
        // Requête sur la table "users"
        $reqString = "SELECT " . $listeColonnes . " FROM users";
        
        // Ajout des conditions (grâce à ton helper)
        $reqString .= conditionsSelect($conditions);
        $reqString .= ($orderBy == null) ? "" : " ORDER BY " . $orderBy;
        
        $requete = $bdd->prepare($reqString);
        if ($debug) var_dump($requete);
        $requete->execute();
        
        $liste = [];
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            if ($api) {
                $liste[] = $donnees;
            } else {
                // C'est ICI la magie : on crée bien un "Utilisateur" et non un "users"
                $liste[] = new Utilisateur($donnees);
            }
        }
        return $liste;
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