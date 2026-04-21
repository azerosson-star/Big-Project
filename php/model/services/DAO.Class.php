<?php

class DAO
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
    public static function select(?array $colonnes, string $table, ?array $conditions = null, ?string $orderBy = null, bool $api = false, bool $debug = false)
    {
        $str = json_encode($colonnes) . $table . json_encode($conditions) . $orderBy;
        if (!str_contains($str, ";")) { // si pas de ; on continue
            $bdd = DbConnect::getConnectBase();
            if ($colonnes == null)
                $listeColonnes = "*";
            else
                $listeColonnes = implode(',', $colonnes);
            $reqString = "select " . $listeColonnes . " from " . ucFirst($table);
            $wher = conditionsSelect($conditions);
            $reqString .= $wher;
            $reqString .= $orderBy == null ? "" : " order by " . $orderBy;
            $requete = $bdd->prepare($reqString);
            if ($debug) var_dump($requete);
            $requete->execute();
            $liste = [];
            while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
                if ($api)
                    $liste[] = $donnees;
                else
                    $liste[] = new $table($donnees);
            }
            return $liste;
        }
    }

    public static function findById($id,$table)
    {
        return DAO::select(null,$table,["id".ucFirst($table)=>$id]);
    }
}
