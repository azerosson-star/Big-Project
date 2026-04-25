<?php

class ProduitService
{
    public static function select()
    {
        $bdd = DbConnect::getConnectBase();
        $reqString = "select * from produit";
        $requete = $bdd->prepare($reqString);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeProduits[] = new Produit($donnees);
        }
        return $listeProduits;
    }

    public static function findById($id)
    {
        $bdd = DbConnect::getConnectBase();
        $id = (int)$id;
        $reqString = "select * from produit where idProduit=" . $id;
        $requete = $bdd->prepare($reqString);
        $requete->execute();
        $donnees = $requete->fetch(PDO::FETCH_ASSOC);
        $prod = new Produit($donnees);
        return $prod;
    }
    
    static function insert($prod)
    {
        $db = DbConnect::getConnectBase();
        $req = "insert into produit (nom,description,user_creation) VALUES (:nom,:description,:user)";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom',$prod->getNom(),PDO::PARAM_STR);
        $requete->bindValue(':description',$prod->getDescription(),PDO::PARAM_STR);
        $requete->bindValue(':user',$_SESSION['utilisateur']->getIdUtilisateur(),PDO::PARAM_STR);
        $requete->execute();
        $requete->closeCursor();
    }

    static function update($prod)
    {
        $db = DbConnect::getConnectBase();
        $req = "UPDATE produit SET nom=:nom,description=:description, user_modification=:user WHERE idProduit=:idProduit";
        $requete = $db->prepare($req);
        $requete->bindValue(':nom',$prod->getNom(),PDO::PARAM_STR);
        $requete->bindValue(':description',$prod->getDescription(),PDO::PARAM_STR);
        $requete->bindValue(':idProduit',$prod->getIdProduit(),PDO::PARAM_STR);
        $requete->bindValue(':user',$_SESSION['utilisateur']->getIdUtilisateur(),PDO::PARAM_STR);
        $requete->execute();
        $requete->closeCursor();
    }

    static function delete($id)
    {
        $db = DbConnect::getConnectBase();
        $req = "DELETE FROM produit WHERE idProduit=:idProduit";
        $requete = $db->prepare($req);
        $requete->bindValue(':idProduit',$id);
        $requete->execute();
        $requete->closeCursor();
    }
}
