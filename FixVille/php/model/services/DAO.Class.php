<?php

class DAO
{
    public static function select(?array $colonnes, string $table, ?array $conditions = null, ?string $orderBy = null, bool $api = false, bool $debug = false)
    {
        $bdd = DbConnect::getConnectBase();
        $listeColonnes = ($colonnes == null) ? "*" : implode(',', $colonnes);
        
        $reqString = "SELECT " . $listeColonnes . " FROM " . strtolower($table);
        
        // On récupère le SQL ET les paramètres
        $cond = conditionsSelect($conditions);
        $reqString .= $cond['sql'];
        $reqString .= ($orderBy == null) ? "" : " ORDER BY " . $orderBy;

        $requete = $bdd->prepare($reqString);
        if ($debug) var_dump($requete);
        
        // Exécution sécurisée avec les binds
        $requete->execute($cond['params']); 

        $liste = [];
        while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
            if ($api) {
                $liste[] = $donnees;
            } else {
                $liste[] = new $table($donnees);
            }
        }
        return $liste;
    }

    public static function findById($id, $table)
    {
        $pk = "id_" . strtolower($table);
        $resultats = self::select(null, $table, [$pk => $id]);
        return !empty($resultats) ? $resultats[0] : null;
    }
}