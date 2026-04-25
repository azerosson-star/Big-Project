<?php

class RoleService
{
    public static function select()
    {
        $bdd = DbConnect::getConnectBase();
        $reqString = "select * from role";
        $requete = $bdd->prepare($reqString);
        $requete->execute();
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeRoles[] = new Role($donnees);
        }
        return $listeRoles;
    }
}
