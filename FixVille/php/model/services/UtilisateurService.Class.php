<?php

class UtilisateurService
{
    public static function select(?array $colonnes = null, ?array $conditions = null, ?string $orderBy = null, bool $api = false, bool $debug = false)
    {
        $bdd = DbConnect::getConnectBase();
        $listeColonnes = ($colonnes == null) ? "*" : implode(',', $colonnes);
        $reqString = "SELECT " . $listeColonnes . " FROM utilisateur";
        $reqString .= conditionsSelect($conditions);
        $reqString .= ($orderBy == null) ? "" : " ORDER BY " . $orderBy;
        $requete = $bdd->prepare($reqString);
        if ($debug) var_dump($requete);
        $requete->execute();
        $liste = [];
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = $api ? $donnees : new Utilisateur($donnees);
        }
        return $liste;
    }

    public static function findByLogin($email)
    {
        $bdd = DbConnect::getConnectBase();
        $requete = $bdd->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $requete->bindValue(":email", $email);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        return $donnees ? new Utilisateur($donnees) : null;
    }

    public static function findById($id)
    {
        $bdd = DbConnect::getConnectBase();
        $requete = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
        $requete->bindValue(":id", $id);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        return $donnees ? new Utilisateur($donnees) : null;
    }

    public static function insert($util)
    {
        $bdd = DbConnect::getConnectBase();
        $requete = $bdd->prepare("INSERT INTO utilisateur 
            (nom, prenom, email, mdp, adresse, tel, date_naissance, date_inscription, date_modification, id_role)
            VALUES (:nom, :prenom, :email, :mdp, :adresse, :tel, :date_naissance, :date_inscription, :date_modification, :id_role)");
        $requete->bindValue(':nom',               $util->getNom());
        $requete->bindValue(':prenom',            $util->getPrenom());
        $requete->bindValue(':email',             $util->getEmail());
        $requete->bindValue(':mdp',               $util->getMdp());
        $requete->bindValue(':adresse',           $util->getAdresse());
        $requete->bindValue(':tel',               $util->getTel());
        $requete->bindValue(':date_naissance',    $util->getDateNaissance());
        $requete->bindValue(':date_inscription',  date("Y-m-d"));
        $requete->bindValue(':date_modification', date("Y-m-d"));
        $requete->bindValue(':id_role',           1);
        $requete->execute();
        $requete->closeCursor();
    }

    public static function update($util)
    {
        $bdd = DbConnect::getConnectBase();
        $requete = $bdd->prepare("UPDATE utilisateur 
            SET nom=:nom, prenom=:prenom, email=:email, mdp=:mdp, adresse=:adresse, tel=:tel, date_modification=:date_modification
            WHERE id_utilisateur=:id_utilisateur");
        $requete->bindValue(':nom',               $util->getNom());
        $requete->bindValue(':prenom',            $util->getPrenom());
        $requete->bindValue(':email',             $util->getEmail());
        $requete->bindValue(':mdp',               $util->getMdp());
        $requete->bindValue(':adresse',           $util->getAdresse());
        $requete->bindValue(':tel',               $util->getTel());
        $requete->bindValue(':date_modification', date("Y-m-d"));
        $requete->bindValue(':id_utilisateur',    $util->getId_utilisateur());
        $requete->execute();
        $requete->closeCursor();
    }

    public static function delete($id)
    {
        $bdd = DbConnect::getConnectBase();
        $requete = $bdd->prepare("DELETE FROM utilisateur WHERE id_utilisateur=:id_utilisateur");
        $requete->bindValue(':id_utilisateur', $id);
        $requete->execute();
        $requete->closeCursor();
    }
}