<?php

class UtilisateurService
{
    /* @param array $conditions => null par défaut, attendu un tableau associatif 
	 * qui peut prendre plusieurs formes en fonction de la complexité des conditions.
	 *  Exemples : tableau associatif
	 *  [nomColonne => '1'] => "WHERE nomColonne = 1"
	 *  [nomColonne => ''] => "WHERE nomColonne is null "
	 *  [nomColonne => ['1','3']] => "WHERE nomColonne in (1,3)"
	 *  [nomColonne => '%abcd%'] => "WHERE nomColonne like "%abcd%" "
	 *  [nomColonne => '1->5'] => "WHERE nomColonne BETWEEN 1 and 5 "
	 *  Si il y a plusieurs conditions alors :
	 *  [nomColonne1 => '1', nomColonne2 => '%abcd%' ] => "WHERE nomColonne1 = 1 AND nomColonne2 LIKE "%abcd%"
	 * 	[fullTexte]=>'test'=> "WHERE nomColonne1 like "%test%" OR nomColonne2 LIKE "%test%"
	 */
    public static function select(?array $colonnes, ?array $conditions = null, ?string $orderBy = null, bool $api = false, bool $debug=false)
    {
       return DAO::select($colonnes,"Utilisateur",$conditions,$orderBy,$api,$debug);
    }

    public static function findByLogin($login)
    {
        $bdd = DbConnect::getConnectBase();
        $reqString = "select * from utilisateur where login = :login";
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
        $reqString = "select * from utilisateur where idUtilisateur = :id";
        $requete = $bdd->prepare($reqString);
        $requete->bindValue(":id", $id);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            $utilisateur = new Utilisateur($donnees);
        }
        return $utilisateur;
    }

    static function insert($prod)
    {
        $db = DbConnect::getConnectBase();
        $req = "insert into Utilisateur (login, motDePasse,idRole,user_creation) VALUES (:login,:motDePasse,:idRole,:user)";
        $requete = $db->prepare($req);
        $requete->bindValue(':login', $prod->getlogin(), PDO::PARAM_STR);
        $requete->bindValue(':motDePasse', $prod->getMotDePasse(), PDO::PARAM_STR);
        $requete->bindValue(':idRole', $prod->getIdRole(), PDO::PARAM_STR);
        $requete->bindValue(':user', $_SESSION['utilisateur']->getIdUtilisateur(), PDO::PARAM_STR);
        $requete->execute();
        $requete->closeCursor();
    }

    static function update($prod)
    {
        $db = DbConnect::getConnectBase();
        $req = "UPDATE Utilisateur SET login=:login,motDePasse=:motDePasse, idRole=:idRole, user_modification=:user WHERE idUtilisateur=:idUtilisateur";
        $requete = $db->prepare($req);
        $requete->bindValue(':login', $prod->getNom(), PDO::PARAM_STR);
        $requete->bindValue(':motDePasse', $prod->getMotDePasse(), PDO::PARAM_STR);
        $requete->bindValue(':idRole', $prod->getIdRole(), PDO::PARAM_STR);
        $requete->bindValue(':idUtilisateur', $prod->getIdUtilisateur(), PDO::PARAM_STR);
        $requete->bindValue(':user', $_SESSION['utilisateur']->getIdUtilisateur(), PDO::PARAM_STR);
        $requete->execute();
        $requete->closeCursor();
    }

    static function delete($id)
    {
        $db = DbConnect::getConnectBase();
        $req = "DELETE FROM Utilisateur WHERE idUtilisateur=:idUtilisateur";
        $requete = $db->prepare($req);
        $requete->bindValue(':idUtilisateur', $id);
        $requete->execute();
        $requete->closeCursor();
    }
}
